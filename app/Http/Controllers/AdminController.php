<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Driver;
use App\Car;
use App\User;

class AdminController extends Controller {

     public function __construct() {

        $this->middleware('auth');
    }
    
    public function index() {
        $this->showDrivers() ;
    }
    
    public function scheduled() {
        
    }


    public function delete($id) {
          if($this->verifyAdmin()){     
            Driver::destroy($id);
            Car::destroy($id);
            return back()->with('success', 'Update successful!');
        }
    }

    public function update($id) {
         if($this->verifyAdmin()){
        $data = DB::table('drivers')
                    ->join('cars', 'drivers.driving_license_no', '=', 'cars.driving_license_no')
                    ->join('users', 'drivers.userID', '=', 'users.userID')
                    ->where('drivers.driving_license_no', $id)
                     ->first();
        
        if(count($data)>0){
            $driver=Driver::find($id);
            $user=User::find($driver->userID);
            if($driver->status=="Pending" || $driver->status=="Disabled"){
                $driver->status="Active";
                $user->is_driver=1;
            }else{
                $driver->status="Disabled";
                $user->is_driver=0;
            }
            $driver->save();
            $user->save();
            return back()->with('success', 'Update successful!');
        }
        return back()->with('Failure', 'Sorry! Booking Fails!');
         }
         
    }

    // Show new drivers' registration 
    public function showDrivers() {
        if($this->verifyAdmin()){
             $results = DB::table('drivers')
                    ->join('cars', 'drivers.driving_license_no', '=', 'cars.driving_license_no')
                    ->join('users', 'drivers.userID', '=', 'users.userID')
                    ->select()
                    ->get();

             return view('admin.drivers',compact('results'));
        }
       
    }
    
 public function view($id) {
        $data = DB::table('drivers')
                    ->join('cars', 'drivers.driving_license_no', '=', 'cars.driving_license_no')
                    ->join('users', 'drivers.userID', '=', 'users.userID')
                    ->where('drivers.driving_license_no', $id)
                     ->first();

        $result = array();
        if ($data) {
            $result['data'] = $data;
            $result['userID'] = $data->userID;
            $result['name'] = $data->first_name . " " . $data->last_name;
            $result['contactno'] = $data->contactNO;
            $result['email'] = $data->email;
            $result['gender'] = $data->gender;
            $result['driving_license_no'] = $data->driving_license_no;
            $result['driving_license_valid'] = $data->driving_license_valid_till;
            $result['carModel'] = $data->model;
            $result['plate_no'] = $data->plate_no;
            $result['capacity'] = $data->capacity;
            $result['driver_register_date'] = $data->driver_register_date;
            $result['manufacture_year'] = $data->manufacture_year;       
        }
        if ($result) {
            return response()->json(['response' => 'Success', 'data' => $result]);
        }
        return response()->json(['response' => 'Fail', 'data' => $result]);
    }
    
      public function verifyAdmin() {
        if (Auth::user()->is_admin) {
           request()->session()->put('admin', true);
            return true;
        } else {
           return false;
        }
    }
}
