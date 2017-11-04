<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use DB;
use App\Route;
use App\Driver;

class RouteController extends Controller {

    public function __construct() {

        $this->middleware('auth');
    }
    
    public function index() {
        
        return view('driver.route');
    }
    

    /**
     * Store a newly created route
     *
     */

    public function store(Request $request) {

        $driver = Driver::where('User_userID', Auth::user()->userID)->get();
        
       $licenseNo = $driver[0]->driving_license_no;
  
         $route= Route::create([
                        'seats' => $request->input('seats'), // Need to valid if seats no over capacity
                        'route_datetime' => date('Y-m-d', strtotime(str_replace('-', '/', $request->input('dateTime')))),
                        'comment' => "testing",  // add comment.
                         'status' => "Open",  // add comment.
                        'pick_up_point'=>$request->input('pickup'),
                        'destination_point'=>$request->input('destination'),
                        'drivers_driving_license_no'=>$driver[0]->driving_license_no,
        ]);
        
        $route->save();
        
         return back();
    }

    public function show() {
        $driver = Driver::where('User_userID', Auth::user()->userID)->get();
   
        $routes = Route::where('drivers_driving_license_no', $driver[0]->driving_license_no)
                ->get();  
        return view('driver.route', compact ('routes'));
    }

    public function update($id) {
        
    } 
    
    public function cancel($id) {

       $route  = Route::find($id);
       $route->delete();
       
       return back();
    } 
}
