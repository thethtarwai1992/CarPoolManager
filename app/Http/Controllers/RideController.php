<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller;
use App\Booking;

class RideController extends Controller {

    public function index() {
        
        return view('rides.rides');
    }
    
    public function scheduled() {
        
        return view('rides.scheduled');
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