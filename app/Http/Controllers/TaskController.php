<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use App\Route;
use App\Driver;
use App\Booking;
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
        $driver = Driver::driver(Auth::user()->userID)->get();

        $tasks=DB::table('bookings')
            ->join('users', 'passenger_id', '=', 'users.userID')
            ->join('routes', 'bookings.route_id', '=', 'routes.route_id')
            ->select('booking_id','pick_up_point','destination_point','first_name','last_name','contactNO','route_datetime','bookings.status as b_status','price')
            ->where('bookings.drivers_driving_license_no', $driver[0]->driving_license_no)
            ->get();
      
        return view('driver.task', compact ('tasks'));
    }

    // Show the scheduled tasks
     public function showScheduled() {
        $driver = Driver::driver(Auth::user()->userID)->get();

        $tasks=DB::table('bookings')
            ->join('users', 'passenger_id', '=', 'users.userID')
            ->join('routes', 'bookings.route_id', '=', 'routes.route_id')
            ->select('booking_id','pick_up_point','destination_point','first_name','last_name','contactNO','route_datetime','bookings.status as b_status','price')
            ->where('bookings.drivers_driving_license_no', $driver[0]->driving_license_no)
            ->where('bookings.status','scheduled')
            ->get();
        
        return view('driver.scheduled_booking', compact ('tasks'));
    }
    
    public function newRequest(){
        
        
         return view('driver.new_request');
    }
    
    public function edit($id) {
        
    } 
    
    public function cancel($id) {
      date_default_timezone_set('Asia/Singapore');

       $now= date("Y-m-d H:i:s");
     
       $booking = Booking::find($id);
       
       $route  = Route::find($booking->route_id);
       
       if($route->route_datetime > $now){
           $route->status = 'Open'; // reopen for other passenger to book
       }else{
           $route->status = 'Closed';
       }
       
       $booking->status = 'canceled';

       $route->save();
       $booking->save();
       
       return back();
    } 
}
