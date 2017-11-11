<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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

        $driver = Driver::where('userID', Auth::user()->userID)->first();

        $route = Route::create([
                    'seats' => $request->input('seats'), // Need to valid if seats no over capacity
                    'start' => date('Y-m-d', strtotime(str_replace('-', '/', $request->input('dateTime')))),
                    'comment' => "testing", // add comment.
                    'status' => "Open", // add comment.
                    'pickup' => $request->input('pickup'),
                    'destination' => $request->input('destination'),
                    'drivers_driving_license_no' => $driver->driving_license_no,
        ]);

        $route->save();

        return back();
    }

    public function show() {
        $driver = Driver::where('userID', Auth::user()->userID)->first();
        $routes = array();
        if (count($driver) > 0) {
            $routes = Route::where('drivers_driving_license_no', $driver->driving_license_no)->get();
        }
        return view('driver.route', compact('routes'));
    }

    public function update($id) {
        
    }

    public function cancel($id) {

        $route = Route::find($id);
        $route->delete();

        return back();
    }

    public function view($route_id) {
        $data = Route::with('driver', 'driver.driver.car')
                ->where('posted_type', 'Driver')
                ->where('status', 'Open')
                ->find($route_id);
        $routes = array();
        if ($data) { 
            $routes['data'] = $data;
            $routes['name'] = $data->driver->first_name . " " . $data->driver->last_name;
            $routes['contactno'] = $data->driver->contactNO;
            $routes['car'] = $data->driver->driver->car->model. " ".$data->driver->driver->car->plate_no;
            $routes['price'] = $data->price;
            $routes['seats'] = $data->available_seats;
            $routes['pickup'] = $data->pickup;
            $routes['destination'] = $data->destination;
        }
        if ($routes) {
            return response()->json(['response' => 'Success', 'data' => $routes]);
        }
        return response()->json(['response' => 'Fail', 'data' => $data]);
    }

}
