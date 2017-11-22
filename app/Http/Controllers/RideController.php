<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Booking;
use App\Route;

class RideController extends Controller {

    public function __construct() {
        //$this->middleware('auth'); 
    }

    public function index() {
        
        if(Auth::check() && (request()->session()->exists('driverFound'))){ 
            return redirect('bookings/ongoing'); 
        }
        $booked = false;
        $driverposts = array();
        //Need to check if current rides is ongoing..cannot book another rides!!
        if (Auth::check() && request()->session()->exists('booked')) {
            if (BookingController::bookingUpdate()) {
                return redirect('bookings/ongoing')->with("success", "Driver Found!");
            } else {
                BookingController::checkBookingTime();
                $booked = true;
            }

            if (request()->session()->exists('driverNotFound')) {
                request()->session()->flash('success', 'No drivers available. Please try again later.');
                request()->session()->forget('driverNotFound');
                $booked = false;
            }
        }
 
        $driverposts = Route::with('bookings')
                ->whereDate('created_at', date('Y-m-d'))
                ->where('status','Open')
                ->where('posted_type', 'Driver')
                ->where('available_seats', '!=', 0)
                ->orderBy('created_at', 'desc')
                ->get();

        return view('rides.rides', compact('driverposts', 'booked'));
    }

    public function scheduled() {
 
        if(Auth::check() && request()->session()->exists('OngoingRide')){ 
            return redirect('bookings/ongoing'); 
        } 
 
        $driverposts = Route::with('bookings') 
                ->where('status','Open')
                ->where('route_datetime',">", now())
                ->where('posted_type', 'Driver')
                ->where('available_seats', '!=', 0)
                ->orderBy('created_at', 'desc')
                ->get();
 
        return view('rides.scheduled', compact('driverposts'));
    }

    public function create() {
        
    }

    public function store(Request $request) {
        
    }

    public function show() {
        if (Auth::check()) {
            $rides = Booking::with('route')
                            ->where('passenger_id', Auth::user()->userID)
                            ->where(function ($query) {
                                $query->where('status', '=', 'Cancelled')
                                ->orWhere('status', '=', 'Closed');
                            })->get();

            //return response()->json(['data' => $rides]);
            return view('rides.myrides', compact('rides'));
        } else {
            return redirect('home');
        }
    }

    public function edit($id) {
        
    }

    public function locationUpdate($currentLocation) {

        $driverposts = Route::whereDate('created_at', date('Y-m-d'))->where('status', 'Open')
                ->where('start', 'LIKE', '%' . $currentLocation . '%')
                ->orderBy('created_at', 'desc')
                ->get();

        return $driverposts;
    }

}
