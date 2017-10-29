<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DriverController extends Controller {
/*
    public function __construct() {

        $this->middleware('auth');
    }
 * 
 */

    public function index(Request $request) { 
        return view('driver.mydriveinfo');
    }

    public function create() {

        $name = Input::get('Time');
        if ($name == "test") {
            $notification = array(
                'message' => 'New Route is posted successfully',
                'alert-type' => 'success'
            );
            //echo "New Route is posted sucessfully";
        } else {
            $notification = array(
                'message' => 'Invalid Route. Please try again',
                'alert-type' => 'warning'
            );
        }

        return back()->with($notification);
    }

    public function store(Request $request) {
        
    }

    public function show() {
        
    }

    public function register() {

        return view('driver.register');
    }
     

}
