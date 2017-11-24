<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\UploadRequest;
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
        if (Auth::user()->is_driver) {
            $tasks = DB::table('bookings')
                    ->join('users', 'passenger_id', '=', 'users.userID')
                    ->join('routes', 'bookings.route_id', '=', 'routes.route_id')
                    ->select('booking_id', 'pickup', 'destination', 'first_name', 'last_name', 'contactNO', 'route_datetime', 'bookings.status as b_status', 'bookings.price')
                    ->where('bookings.driver_id', Auth::user()->userID)
                    ->get();

            return view('driver.task', compact('tasks'));
        }
        return view('driver.register');
    }

    // Show the scheduled tasks
    public function showScheduled() {
        if (Auth::user()->is_driver) {
            $tasks = DB::table('bookings')
                    ->join('users', 'passenger_id', '=', 'users.userID')
                    ->join('routes', 'bookings.route_id', '=', 'routes.route_id')
                    ->select('booking_id', 'pickup', 'destination', 'first_name', 'last_name', 'contactNO', 'route_datetime', 'bookings.status as b_status', 'bookings.price')
                    ->where('bookings.driver_id', Auth::user()->userID)
                    ->where(function ($query) {
                        $query->where('bookings.status', 'Scheduled')
                        ->orWhere('bookings.status', 'PickedUp');
                    })
                    ->orderBy('route_datetime', 'asc')
                    ->get();

            return view('driver.scheduled_booking', compact('tasks'));
        }
        return view('driver.register');
    }

    // Show all the new ride request posted by passenger
    public function newRequest() {
        if (Auth::user()->is_driver) {
            $tasks = DB::table('bookings')
                    ->join('users', 'passenger_id', '=', 'users.userID')
                    ->join('routes', 'bookings.route_id', '=', 'routes.route_id')
                    ->select('booking_id', 'pickup', 'destination', 'first_name', 'last_name', 'contactNO', 'route_datetime', 'bookings.status as b_status', 'price')
                    ->where('routes.posted_by', '!=', Auth::user()->userID)
                    ->where('routes.posted_type', 'Passenger')
                    ->whereDate('routes.route_datetime', '>=', date("Y-m-d"))
                    ->where('bookings.status', 'Open')
                    ->orderBy('route_datetime', 'asc')
                    ->get();

            return view('driver.new_request', compact('tasks'));
        }
        return view('driver.register');
    }

    // Driver cancel booking
    public function cancel(UploadRequest $request) {
        date_default_timezone_set('Asia/Singapore');
        $now = date("Y-m-d H:i:s");

        if ($request->isMethod('post')) {
            $booking_id = $request->input('booking');
            $reason = $request->input('reasons');
            $docName = $request->supportDoc->store('supportDoc');

            // Update status of booking & route   
            $booking = Booking::find($booking_id);
            $route = Route::find($booking->route_id);

            //Posted by Driver
            if ($route->posted_type == 'Driver' && $route->posted_by == Auth::user()->userID) {
                if ($route->route_datetime > $now) {
                    $route->status = 'Open'; // reopen for other passenger to book
                    $route->available_seats = $booking->seats + $route->available_seats;
                } else {
                    $route->status = 'Canceled';
                }
            } else {
                $route->status = 'Canceled';
            }

            $booking->status = 'Canceled';
            $route->save();
            $booking->save();

            // Store cancel reason and support doc
            $cancel = new Cancellations;
            $cancel->reason = $reason;
            $cancel->support_doc = $docName;
            $cancel->booking_id = $booking_id;
            $cancel->cancel_by = Auth::user()->userID;
            $cancel->cancel_type = "Driver";

            $cancel->save();

            return back();
        }

        return back()->with('failure', 'Sorry! Cancellation Fails!');
    }

    public function view($booking_id) {
        $data = DB::table('bookings')
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
            $tasks['email'] = $data->email;
            $tasks['gender'] = $data->gender;
             $tasks['route_datetime'] = $data->route_datetime;
            $tasks['price'] = $data->price;
            $tasks['seats'] = $data->seats;
            $tasks['pickup'] = $data->pickup;
            $tasks['destination'] = $data->destination;
            //$tasks['notes'] = "Pls call when reach soon. Wait at bus station ";
        }
        if ($tasks) {
            return response()->json(['response' => 'Success', 'data' => $tasks]);
        }
        return response()->json(['response' => 'Fail', 'data' => $tasks]);
    }

    // Accept new ride request
    public function accept($booking_id) {
        $booking = Booking::find($booking_id);
        if (count($booking) > 0) {
            $booking->status = "Scheduled";
            $booking->driver_id = Auth::user()->userID;

            $driver = Driver::where('userID', Auth::user()->userID)->first();
            $route = Route::find($booking->route_id);
            if (count($route) > 0) {
                $route->drivers_driving_license_no = $driver->driving_license_no;
                $route->status = "Scheduled";
                $route->available_seats = $route->available_seats - $booking->seats;
                if ($route->available_seats == 0) {
                    $route->status = 'Closed';
                }
                $booking->save();
                $route->save();
                return response()->json(['msg' => "Accept booking successfully!"]);
            }
        }

        return response()->json(['msg' => 'Fail']);
    }

    public function update(Request $request) {
        if ($this->updateStatus($request)) {
            return back()->with('success', 'Update successful!');
        }
        return back()->with('Failure', 'Sorry! Booking Fails!');
    }

    public function updateStatus($request) {
        date_default_timezone_set('Asia/Singapore');
        $now = date("Y-m-d H:i:s");

        $booking = Booking::find($request->session()->get('booking_id'));

        if ($booking) {
            $route = Route::find($booking->route_id);
            if ($booking->status == "Scheduled") {
                $booking->status = 'PickedUp';
                $booking->start = date("Y-m-d H:i:s");

                if ($route->available_seats == 0 || $route->route_datetime <= $now) {
                    $route->status = "Closed";
                }
                $route->save();
                // Send Msg to Passenger       
            } else if ($booking->status == "PickedUp") {
                $booking->status = 'Closed';
                $booking->end = date("Y-m-d H:i:s");
                // Send invoice to Passenger
            }
            $booking->save();
            $request->session()->forget('booking_id');
            return true;
        }

        return false;
    }

    public function storeSessionData($id) {
        if(request()->session()->has('booking_id')){
            request()->session()->forget('booking_id');
        }
        request()->session()->put('booking_id', $id);
        $booking = Booking::find($id);
        $data = array();
        if($booking){
            if($booking->status == "Scheduled"){
                $data['title'] = "Mark as Picked Up";
                $data['msg1'] = "If you picked up the passenger, mark this booking as picked up.";
            }
             if($booking->status == "PickedUp"){
                $data['title'] = "Mark as Completed";
                $data['msg1'] = "If you completed the ride, mark this booking as completed after you received the correct fare.";
                $data['msg2'] = "Total Price: S$ $booking->price";
             }
            $data['status'] = $booking->status;
            return response()->json(['response' => 'Success','data' => $data]);
        }
        return response()->json(['response' => 'Fail', 'data' => $data]);   
    }

    public function check() {
        $booking = Booking::with(['route' => function($query) {
                                $query->where('posted_type', 'Passenger');
                            }])->where('status', 'Open')
                        ->whereDate('request_time', date('Y-m-d'))->get();
        if ($booking) {
            return response()->json(['response' => 'Success', 'data' => $booking]);
        }
        return response()->json(['response' => 'Fail', 'data' => $booking]);
    }

}
