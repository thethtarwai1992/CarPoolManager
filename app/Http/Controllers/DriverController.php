<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Driver;
use App\Booking;
use App\Car;

class DriverController extends Controller {

    public function __construct() {

        $this->middleware('auth');
    }

    public function index() {
        $driver = Driver::where('userID', Auth::user()->userID)->first();

        $driverData = Driver::join('cars', 'drivers.driving_license_no', '=', 'cars.driving_license_no')
                ->where('drivers.driving_license_no', $driver->driving_license_no)
                ->first();

        return view('driver.mydriveinfo', compact('driverData'));
    }

    public function store(Request $request) {

        $driver = Driver::firstOrCreate([
                    'driving_license_no' => $request->input('licenseNo'),
                    'driving_license_valid_till' => date('Y-m-d', strtotime(str_replace('-', '/', $request->input('expiryDate')))),
                    'userID' => Auth::user()->userID,
        ]);

        $driver->save();

        $car = Car::firstOrCreate([
                    'plate_no' => $request->input('plateNo'),
                    'model' => $request->input('model'),
                    'manufacture_year' => $request->input('manufactureYear'),
                    'capacity' => $request->input('maxPass'),
                    'driving_license_no' => $request->input('licenseNo'),
        ]);

        $car->save();

        return redirect()->route('/home')
                        ->with('success', 'Driver Registration is submited successfully');
    }

    public function update() {
        
    }

    public function register() {

        return view('driver.register');
    }

    public function switchToDriver(Request $request) {
        if (Auth::user()->is_driver) {
            $request->session()->put('driverView', true);

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
    
    public static function getRating($driver_id){
        $results = Booking::where('driver_id', $driver_id)->where('rating', '!=', 0);
        $rating = $results->count();
        $total = $results->sum('rating');
        if($rating == 0 || $total==0){
            return 0;
        }else{
            return round($total/$rating);
        }
        
    }

}
