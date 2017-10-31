<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

use DB;
use App\Driver;
use App\Car;

class DriverController extends Controller {

    public function __construct() {

        $this->middleware('auth');
    }

    public function index(Request $request) {

        return view('driver.mydriveinfo');
    }

    public function create() {

    }

    public function store(Request $request) {
   
        $driver= Driver::firstOrCreate([
                        'driving_license_no' => $request->input('licenseNo'),
                        'driving_license_valid_till' => date('Y-m-d', strtotime(str_replace('-', '/', $request->input('expiryDate')))),
                        'status' => "Pending",
                        'User_userID'=>Auth::user()->userID,  
        ]);
        
        $driver->save();
        
        $car= Car::firstOrCreate([
                        'plate_no' => $request->input('plateNo'),
                        'model' => $request->input('model'),
                        'manufacture_year' => $request->input('manufactureYear'),
                        'capacity'=>$request->input('maxPass'), 
                        'driving_license_no'=>$request->input('licenseNo'),
        ]);
        
        $car->save();

        return back();
    }

    public function show() {
        
    }

    public function register() {

        return view('driver.register');
    }

    public function switchToDriver(Request $request) {
        if (Auth::user()->is_driver) {
            $request->session('driverView', true);

            return redirect()->route('driver.index')
                            ->with('driver', 'You are now using app as Driver!');
        } else {
            return redirect()->route('driver.register');
        }
    }

    public function switchToPassenger(Request $request) {
        if (request()->session()->exists('driverView')) {
            $request->session()->forget('driverView');
        }
        return redirect()->route('home')
                        ->with('success', 'Back to Passenger!');
    }

}
