<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class TaskController extends Controller {

    public function index() {
        
        return view('driver.task');
    }
    
    public function manage() {
        
        return view('driver.manage');
    }


    public function create() {
        
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
