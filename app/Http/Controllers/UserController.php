<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class UserController extends Controller {

    public function index() {
        
        return view('users.profile');
    } 

    public function create() {
        
    }

    public function store(Request $request) {
        
    }

    public function show() {
        
    }

    public function edit($id) {
        
    } 
}
