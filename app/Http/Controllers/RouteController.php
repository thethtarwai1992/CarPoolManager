<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
# use Input;
use Illuminate\Http\Request;
use DB;
use App\Route;

class RouteController extends Controller {

   /* 
    public function __construct() {

        $this->middleware('auth');
    }
    */
    
    public function index() {
        
        return view('driver.route');
    }
    
    public function manage() {
        
        
    }

    /**
     * Store a newly created route
     *
     */

    public function store(Request $request) {
        $pickup=$request->input('pickup');
        $destination=$request->input('destination');
        $dateTime=date('Y-m-d', strtotime(str_replace('-', '/', $request->input('dateTime'))));
        $licenseNo="xs123456"; // testing
        $plateNo="1234"; // testing
        
        //Store location    
        $data=array('seats'=>3,"route_start_datetime"=>$dateTime,"comment"=>"testing","driver_car_driver_driving_license_no"=>$licenseNo,"driver_car_car_plate_no"=>$plateNo,"pick_up_point"=>$pickup,"destination_point"=>$destination);
        
        if(DB::table('routes')->insert($data)){
           $notification = array(
                'message'=>'New Route is posted successfully',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message'=>'New Route is posted unsuccessfully',
                'alert-type' => 'fail'
            );
        }
        
         return back()->with($notification);
    }

    public function show() {
        $licenseNo="xs123456";
        $routes = Route::where('driver_car_driver_driving_license_no', $licenseNo)
                ->get();  
        return view('driver.route', compact ('routes'));
    }

    public function edit($id) {
        
    } 
    
    public function cancel($id) {
        
    } 
}
