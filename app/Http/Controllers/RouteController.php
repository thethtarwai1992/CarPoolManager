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

        return view('driver.route', compact('routes'));
    }

    /**
     * Store a newly created route
     *
     */
    public function store(Request $request) {
        $driver = Driver::where('userID', Auth::user()->userID)->first();

        $route = Route::create([
                    'available_seats' => $request->input('seats'), // Need to valid if seats no over capacity
                    'route_datetime' => date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $request->input('dateTime')))),
                    //'comment' => $request->input('comments'), // add comment.         
                    'pickup' => $request->input('pickup'),
                    'destination' => $request->input('destination'),
                    'drivers_driving_license_no' => $driver->driving_license_no,
                    'posted_by' => Auth::user()->userID,
                    'posted_type' => 'Driver'
        ]);

        $route->save();

        return back();
    }

    public function show() {
        if (Auth::user()->is_driver) {
            $driver = Driver::where('userID', Auth::user()->userID)->first();
            $routes = array();
            if (count($driver) > 0) {
                $data = Route::where('drivers_driving_license_no', $driver->driving_license_no)->orderBy('route_datetime', 'asc')->get();
                $routes = array();
                foreach ($data as $d) {
                    $this->update($d->route_id);
                    $routes[] = $d;
                }
            }
            return view('driver.route', compact('routes'));
        }
        return view('driver.register');
    }

    public function update($id) {
        date_default_timezone_set('Asia/Singapore');
        $now = date("Y-m-d H:i:s");

        $route = Route::find($id);

        if ($route->route_datetime <= $now || $route->available_seats == 0) {
            $route->status = 'Closed';
            $route->save();
        }
    }

    public function cancel(Request $request) {
        if ($request->ajax()) {
            $id = $request['id'];
            $route = Route::find($id);

            if (count($route) > 0) {
                $route->delete();
                return response()->json(['msg' => 'Route canceled successfully']);
            } else {
                return response()->json(['msg' => 'Something Wrong']);
            }
        }
    }

    public static function calculate($pickup, $dest) {
        $pickup .= $pickup . " Singapore";
        $dest .= $dest . " Singapore";

        $details = "http://maps.googleapis.com/maps/api/distancematrix/json?origins=" . urlencode($pickup) . "&destinations=" . urlencode($dest) . "&mode=driving&sensor=false&components=country:SG";

        $json = file_get_contents($details);
        $route = array();
        $details = json_decode($json, TRUE);
        if ($details) {
            $route['results'] = $details['rows'][0]['elements'][0];
            $route['distance'] = $details['rows'][0]['elements'][0]['distance']['value'];
            $route['duration'] = $details['rows'][0]['elements'][0]['duration']['value'];
        }

        if ($route) {
            $km = $route['distance'] / 1000;
            $min = $route['duration'] / 60;
            $price = (($km + $min) / 3.5) + 2;
            $route['price'] = round($price, 1);

            //return response()->json(['response' => 'Success', 'data' => $route]);
        }
        return $route;
        //return response()->json(['response' => 'Fail', 'data' => $route]);
    }

    public static function getPrice($pickup, $dest) {
        $price = 0;
        $data = self::calculate($pickup, $dest);
        if ($data) {
            $price = $data["price"];
        }
        return $price;
    }

    public function view($route_id) {
        $data = Route::with('driver', 'driver.driver.car')
                ->where('posted_type', 'Driver')
                ->where('status', 'Open')
                ->find($route_id);
        $routes = array();
        if ($data) {
            //$routes['data'] = $data;
            $routes['name'] = $data->driver->first_name . " " . $data->driver->last_name;
            $routes['contactno'] = $data->driver->contactNO;
            $routes['car'] = $data->driver->driver->car->model . " " . $data->driver->driver->car->plate_no;
            $routes['seats'] = $data->available_seats;
            $routes['price'] = self::getPrice($data->pickup, $data->destination);
            $routes['pickup'] = $data->pickup;
            $routes['destination'] = $data->destination;
            $routes['datetime'] = date("d-m-Y H:iA", strtotime($data->route_datetime));
            $routes['star'] = DriverController::getRating($data->driver->userID);
            $routes['empty'] = 5 - $routes['star'];
        }
        if ($routes) {
            return response()->json(['response' => 'Success', 'data' => $routes]);
        }
        return response()->json(['response' => 'Fail', 'data' => $data]);
    }

}
