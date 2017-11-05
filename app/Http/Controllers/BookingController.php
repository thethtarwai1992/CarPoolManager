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

    //Passenger raise request and store it
    public function store(Request $request) {

        if ($request->isMethod('post')) {
            $route = new Route;
            $route->seats = $request->seats;
            $route->pickup = $request->pick;
            $route->destination = $request->dest;
            $route->posted_by = Auth::user()->userID;
            $route->posted_type = "Passenger";
            $route->save();

            $booking = new Booking;
            $booking->request_time = date("Y-m-d H:i:s");
            $booking->status = "Open";
            $booking->price = $request->price;
            $booking->passenger_id = Auth::user()->userID;
            $booking->driver_id = 0;
            $booking->route_id = $route->route_id;
            $booking->save();

            return response()->json(['response' => 'Success']);
        }

        return response()->json(['response' => 'There is something wrong.']);
    }

    public function show() {
        
    }

    public function edit($id) {
        
    }

    public function cancel($id) {
        
    }

}
