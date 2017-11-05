<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller;
use App\Booking;
use App\Route;

class RideController extends Controller {

    public function __construct() {
        //$this->middleware('auth');
    }
    public function index() { 
        $driverposts = Route::with('bookings')
                ->whereDate('created_at', date('Y-m-d'))->where('status','Open')
               // ->where('posted_type','Driver')
                ->orderBy('created_at', 'desc')
                ->get();
        $route = array();
        return view('rides.rides', compact('driverposts','route'));
    }
    
    public function scheduled() {
        
        $driverposts = Route::where('status','Open')->get();
        return view('rides.scheduled', compact ('driverposts')); 
    }


    public function create() {
        
    }

    public function store(Request $request) {
        
    }

    public function show() {
        $rides = Booking::where('passenger_id', Auth::user()->id)
                ->with('route')
                ->get();  
        return view('rides.myrides', compact ('rides'));
    }

    public function edit($id) {
        
    } 
    
    public function locationUpdate($currentLocation){
        
        $driverposts = Route::whereDate('created_at', date('Y-m-d'))->where('status','Open')
                ->where('start', 'LIKE', '%' . $currentLocation . '%')
                ->orderBy('created_at', 'desc')
                ->get();
        
        return $driverposts;
    }
    
}