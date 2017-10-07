<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class UserController extends Controller {

    public function __construct() {
//        $this->middleware('auth');
//
//        $this->middleware('log')->only('index');
//
//        $this->middleware('subscribed')->except('store');
    }

    public function index() {

        return view('users.profile');
    }

    public function create() {
        
    }

    public function store(Request $request) {
        
    }

    public function show() {
        return view('users.profile');
    }

    public function edit() {

        return view('users.edit');
    }

    public function update() {
//        $user = Auth::user();
//
//        Flash::message('Your account has been updated!');
//        return Redirect::to('/account');
    }
    
    public function changePassword(){
        return view('users.change_pw');
    } 

}
