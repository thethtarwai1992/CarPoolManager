<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Input;
class RouteController extends Controller {

    public function index() {
        
        return view('driver.route');
    }
    
    public function manage() {
        
        return view('driver.manage');
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

    public function edit($id) {
        
    } 
    
    public function cancel($id) {
        
    } 
}
