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
            $booking->status = "Booked";
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

    public function show() {
        
    }

    public function edit($id) {
        
    }

    public function cancel($id) {
        
    }

}
