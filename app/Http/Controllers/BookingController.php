<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

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

    public function store(Request $request) {
        
    }

    public function show() {
        
    }

    public function edit($id) {
        
    } 
    
    public function cancel($id) {
        
    } 
}
