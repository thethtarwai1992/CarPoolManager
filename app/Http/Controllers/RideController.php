<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

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
        
        return view('rides.myrides');
    }

    public function edit($id) {
        
    } 
}
