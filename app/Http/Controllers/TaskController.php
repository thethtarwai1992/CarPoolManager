<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use App\Route;
use App\Driver;
use App\Booking;
use App\Cancellations;
use DB;

class TaskController extends Controller {

     public function __construct() {

        $this->middleware('auth');
    }
    
    
    public function index() {
        
        return view('driver.task');
    }

    public function store(Request $request) {
        
    }
    
    // Show all the driver's tasks - scheduled, ongoing, canceled, closed
    public function show() {
        //$driver = Driver::driver(Auth::user()->userID)->get();

        $tasks=DB::table('bookings')
            ->join('users', 'passenger_id', '=', 'users.userID')
            ->join('routes', 'bookings.route_id', '=', 'routes.route_id')
            ->select('booking_id','pickup','destination','first_name','last_name','contactNO','route_datetime','bookings.status as b_status','bookings.price')
            ->where('bookings.driver_id', Auth::user()->userID)
            ->get();
      
        return view('driver.task', compact ('tasks'));
    }

    // Show the scheduled tasks
     public function showScheduled() {
        //$driver = Driver::driver(Auth::user()->userID)->get();

        $tasks=DB::table('bookings')
            ->join('users', 'passenger_id', '=', 'users.userID')
            ->join('routes', 'bookings.route_id', '=', 'routes.route_id')
            ->select('booking_id','pickup','destination','first_name','last_name','contactNO','route_datetime','bookings.status as b_status','bookings.price')
            ->where('bookings.driver_id', Auth::user()->userID)
            ->where('bookings.status','scheduled')
            ->get();
        
        return view('driver.scheduled_booking', compact ('tasks'));
    }
    
    public function newRequest(){
        
        
         return view('driver.new_request');
    }
    
    
    public function cancel(Request $request) {

      date_default_timezone_set('Asia/Singapore');
       
     $now= date("Y-m-d H:i:s");
       
      if ($request->isMethod('post')){
           $booking_id = $request->input('booking');
           $reason = $request->input('reasons');
           $doc = $request->input('supportDoc');
           
           // Update status of booking & route
           $booking = Booking::find($booking_id);
            $route = Route::find($booking->route_id);

            if ($route->route_datetime > $now) {
                $route->status = 'Open'; // reopen for other passenger to book
            } else {
                $route->status = 'Closed';
            }

            $booking->status = 'Canceled';
            $route->save();
            $booking->save();
            
             // Store cancel reason and support doc
            $cancel = new Cancellations;
            $cancel->reason = $reason;
            $cancel->support_doc = $doc;
             $cancel->booking_id = $booking_id;
           $cancel->save();
           
           return back();
        }
        
        return back()->with('failure', 'Sorry! Cancellation Fails!');
  /*   
     if($request->ajax()){
       $id=$request['id'];
       
        
         return response()->json(['msg' => 'Booking canceled successfully']);
    }

    return response()->json(['msg' => 'Fail']);
   * 
   */
    } 
    
     public function view($booking_id) {
       $data=DB::table('bookings')
            ->join('users', 'passenger_id', '=', 'users.userID')
            ->join('routes', 'bookings.route_id', '=', 'routes.route_id')
            ->where('booking_id', $booking_id)
            ->first();
   
        $tasks = array();
        if ($data) { 
            $tasks['data'] = $data;
           $tasks['booking_id'] = $data->booking_id;
            $tasks['name'] = $data->first_name . " " . $data->last_name;
            $tasks['contactno'] = $data->contactNO;
            $tasks['price'] = $data->price;
            $tasks['seats'] = $data->seats;
            $tasks['pickup'] = $data->pickup;
            $tasks['destination'] = $data->destination;
            $tasks['notes'] = "Pls call when reach soon. Wait at bus station ";
        }
        if ($tasks) {
            return response()->json(['response' => 'Success', 'data' => $tasks]);
        }
        return response()->json(['response' => 'Fail', 'data' => $tasks]);
  
    }
}
