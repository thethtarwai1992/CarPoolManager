<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Booking;
use App\Route;

class BookingController extends Controller {

    public function index() {

        return view('driver.booking_now');
    }

    public function booknow() {

        return view('driver.booking_now');
    }

    public function newrequest() {
        return view('driver.new_request');
    }

    //Passenger raise request
    public function store(Request $request) {

        if ($request->isMethod('post')) {
            $route = new Route;
            $route->status="Open";
            $route->route_datetime=date("Y-m-d H:i:s");
            $route->available_seats = $request->seats;
            $route->pickup = $request->pick;
            $route->destination = $request->dest;
            $route->price = $request->price;
            $route->posted_by = Auth::user()->userID;
            $route->posted_type = "Passenger";
            $route->save();

            $booking = new Booking;
            $booking->request_time = date("Y-m-d H:i:s");
            $booking->status = "Open";
            $booking->seats = $request->seats;
            $booking->passenger_id = Auth::user()->userID;
            $booking->driver_id = 0;
            $booking->route_id = $route->route_id;
            $booking->save();

            return response()->json(['response' => 'Success']);
        }

        return response()->json(['response' => 'There is something wrong.']);
    }

    //Passenger book from driver's post
    public function book(Request $request) {

        if ($request->isMethod('post') && $this->booking($request)) {
            return back()->with('success', 'Booking successful! Sit back and relax, we will notify you!');
        }
        return back()->with('failure', 'Sorry! Booking Fails!');
    }

    public function booking($request) {
        $route = Route::find($request->route);
        if ($route) {
            $booking = new Booking;
            $booking->request_time = date("Y-m-d H:i:s");
            $booking->status = "Scheduled"; // Status change to "Scheduled". 
            $booking->seats = $request->booking_seats;
            $booking->passenger_id = Auth::user()->userID;
            $booking->driver_id = $route->posted_by;
            $booking->route_id = $route->route_id;
            $booking->save();

            $route->available_seats = $route->available_seats - $request->booking_seats;
            if ($route->available_seats == 0) {
                $route->status = 'Closed';
            }
            $route->save();
            return true;
        }

        return false;
    } 
    // View details for my rides
    public function view($booking_id) {
        $data = Booking::with('route', 'driver', 'driver.driver.car')
                        //->where('status', '!=', 'Open')
                        ->where('passenger_id', Auth::user()->userID)
                        ->where('booking_id', $booking_id)->first();
        $routes = array();
        if ($data) {
            //$routes['data'] = $data;
            $startend = '';
            if ($data->start) {
                $startend = date('d-m-Y H:i A', strtotime($data->start));
            }
            if ($data->end) {
                $startend .= " - " . date('d-m-Y H:i A', strtotime($data->end));
            }

            $routes['name'] = $data->driver->first_name . " " . $data->driver->last_name;
            $routes['contactno'] = $data->driver->contactNO;
            $routes['car'] = $data->driver->driver->car->model . " " . $data->driver->driver->car->plate_no;
            $routes['price'] = $data->route->price;
            $routes['seats'] = $data->seats;
            $routes['pickup'] = $data->route->pickup;
            $routes['destination'] = $data->route->destination;
            $routes['photo'] = $data->driver->photo;
            $routes['startend'] = $startend;
        }
        if ($routes) {
            return response()->json(['response' => 'Success', 'data' => $routes]);
        }
        return response()->json(['response' => 'Fail', 'data' => null]);
    } 

    public function edit($id) {
        
    }

    public function cancel($id) {
        
    }

}
