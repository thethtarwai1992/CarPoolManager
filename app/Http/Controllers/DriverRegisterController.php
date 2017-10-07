<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class DriverRegisterController extends Controller {

    public function index() {
      
        return view('driver.register');
    }


    public function create() {
        
        $name=Input::get('Time');
        if($name=="test"){
            $notification = array(
                'message'=>'New Route is posted successfully',
                'alert-type' => 'success'
            );
            //echo "New Route is posted sucessfully";
        }else{
            $notification = array(
                'message'=>'Invalid Route. Please try again',
                'alert-type' => 'warning'
            );
        }
        
        return back()->with($notification);
    }

    public function store(Request $request) {
        
    }

    public function show() {
        
    }

}
