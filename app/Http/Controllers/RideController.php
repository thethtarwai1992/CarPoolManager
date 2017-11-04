<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller;
use App\Booking;
use App\Route;

class RideController extends Controller {

    public function index() {
        $driverposts = Route::whereDate('created_at', date('Y-m-d'))->where('status','Open')->get();
        return view('rides.rides', compact ('driverposts'));
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
}