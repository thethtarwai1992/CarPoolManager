<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;

class DriverController extends Controller {
/*
    public function __construct() {

        $this->middleware('auth');
    }
*/
    public function index(Request $request) { 
        return view('driver.register');
    }

    public function store(Request $request) {
        $plateNo=$request->input('plateNo');
        $model=$request->input('model');
        $maxPass=$request->input('maxPass');
        $manufactureYear=$request->input('manufactureYear');
        $licenseNo= $request->input('licenseNo');
        $expiryDate= date('Y-m-d', strtotime(str_replace('-', '/', $request->input('expiryDate'))));
        //Store driver info    
        $driverData=array('driving_license_no'=>$licenseNo,"driving_license_valid_till"=>$expiryDate,"status"=>"pending","User_userID"=>1);
        DB::table('drivers')->insert($driverData);
        
         //Store car info    
        $carData=array('plate_no'=>$plateNo,"model"=>$model,"manufacture_year"=>$manufactureYear,"capacity"=>$maxPass);
        DB::table('cars')->insert($carData);
   
         //Store driver_car info    
        $data=array('driver_driving_license_no'=>$licenseNo,"car_plate_no"=>$plateNo);
        DB::table('driver_cars')->insert($data);
        
         return back();
    }

    public function show() {
        
    }

}
