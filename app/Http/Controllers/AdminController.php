<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class AdminController extends Controller {

    public function index() {
        
        return view('rides.rides');
    }
    
    public function scheduled() {
        
        return view('admin.admin');
    }


    public function create() {
        
    }

    public function store(Request $request) {
        
    }

    public function show() {
        return view('admin.details');
    }

    public function edit($id) {
        
    } 
}
