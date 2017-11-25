<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DateTime;
use App\Booking;
use App\Route;
use App\Cancellations;

//use App\User;
//use App\Notifications\BookingNotification;

class BookingController extends Controller {

    public function index() {

        return view('driver.booking_now');
    }

    public function booknow() {

        return view('driver.booking_now');
    }

    public function newrequest() {
        return view('driver.new_request');
    }

    //Passenger raise request
    public function store(Request $request) {

        if ($request->isMethod('post')) {
            $route = new Route;
            $route->status = "Open";
            $route->route_datetime = date("Y-m-d H:i:s");
            $route->available_seats = $request->seats;
            $route->pickup = $request->pick;
            $route->destination = $request->dest;
            $route->posted_by = Auth::user()->userID;
            $route->posted_type = "Passenger";
            $route->save();

            $booking = new Booking;
            $booking->request_time = date("Y-m-d H:i:s");
            $booking->status = "Open";
            $booking->seats = $request->seats;
            $booking->price = round($request->price, 1);
            $booking->passenger_id = Auth::user()->userID;
            //$booking->driver_id = 0;
            $booking->route_id = $route->route_id;
            $booking->save();
            //TESTING PUSH NOTIFICATION
            //$user = User::find(4);             
            //$user->notify(new BookingNotification($user));

            $request->session()->put('booked', true);
            $request->session()->put('booking_id', $booking->booking_id);
            return response()->json(['response' => 'Success']);
        }

        return response()->json(['response' => 'There is something wrong.']);
    }   

    //Passenger book from driver's post (now and scheduled)
    public function book(Request $request) {

        if ($request->isMethod('post')) {
            $a = $this->booking($request);
         
            if (count($a) == 0) {
                return back()->with('failure', 'Sorry! Booking Fails');                
            } elseif(count($a) > 0 && $a['status'] == 'exist') {
                return back()->with('failure', 'You have already booked this');
            } else {
                //Email
               //MailController::sendToDriver($a);                
                return back()->with('success', 'Booking successful!');
               
            }
        }
        return back()->with('failure', 'Sorry! Booking Fails!');
    }

    public static function checkBooking($route_id){
        $booking = Booking::where('route_id',$route_id)->where('passenger_id', Auth::user()->userID)->first();
        if($booking){
            return true;
        }
        return false;
    }

    public function booking($request) {
        $route = Route::with('driver')->find($request->route);
        $result = array();
        if ($route) {

            if (self::checkBooking($route->route_id)) {
                $result['status'] = 'exist';
            } else {
                $booking = new Booking;
                $booking->request_time = date("Y-m-d H:i:s");
                $booking->status = "Scheduled";
                $booking->price = $request->price;
                $booking->seats = $request->booking_seats;
                $booking->passenger_id = Auth::user()->userID;
                $booking->driver_id = $route->posted_by;
                $booking->route_id = $route->route_id;
                $booking->save();  
                $route->available_seats = $route->available_seats - $booking->seats;
                if ($route->available_seats == 0) {
                    $route->status = 'Closed';
                }
                $route->save();
                
                $route['price'] = $request->price;
                $route['status'] = 'ok';
                 $result = $route;
            } 
        }

        return $result;
    }

    //Check every min after book
    public static function checkBookingTime() {

        if (request()->session()->exists('booking_id')) {
            $booking_id = request()->session()->get('booking_id');
            $booking = Booking::find($booking_id);

            $request_time = new DateTime($booking->request_time);
            $now = new DateTime();
            $interval = $request_time->diff($now);
            if ($interval->format('%I') > 1) {
                //After 3min stop finding driver//set 1min for testing
                self::delete($booking_id);
                request()->session()->forget('booking_id');
                request()->session()->forget('booked');
                //request()->session()->forget('bookedFromPost');
                request()->session()->put('driverNotFound', true);
            }
        }
    }

    public static function bookingUpdate() {
        if (request()->session()->exists('booking_id')) {
            $booking_id = request()->session()->get('booking_id');
            $booking = Booking::find($booking_id);
            if ($booking->status == "Scheduled") {
                request()->session()->forget('booked');
                //request()->session()->forget('bookedFromPost');
                request()->session()->put('driverFound', true);
                return true;
            }
        }
        return false;
    }

    public function ongoing() {
        $booking = array();
        if (Auth::check() && request()->session()->exists('driverFound')) {
            $booking = Booking::with('driver', 'route.driverInfo.car', 'route')
                    ->find(request()->session()->get('booking_id'));
            //->find(17);
            $star = DriverController::getRating($booking->driver_id);
            $empty = 5 - $star;
        }
        return view('rides.ongoing_booking', compact('booking', 'star', 'empty'));
    }

    // View details for my rides
    public function view($booking_id) {
        $data = Booking::with('route', 'driver', 'driver.driver.car')
                        ->where('status', '!=', 'Open')
                        ->where('passenger_id', Auth::user()->userID)
                        ->where('booking_id', $booking_id)->first();
        $routes = array();
        if ($data) {
            //$routes['data'] = $data;
            $startend = '';
            if ($data->start && $data->end) {
                $startend = date('d-m-Y H:i A', strtotime($data->start));
                $startend .= " - " . date('d-m-Y H:i A', strtotime($data->end));
            } else {
                $startend = date('d-m-Y H:i A', strtotime($data->request_time));
            }

            $routes['name'] = $data->driver->first_name . " " . $data->driver->last_name;
            $routes['contactno'] = $data->driver->contactNO;
            $routes['car'] = $data->driver->driver->car->model . " " . $data->driver->driver->car->plate_no;
            $routes['price'] = RouteController::getPrice($data->route->pickup, $data->route->destination);
            $routes['seats'] = $data->seats;
            $routes['pickup'] = $data->route->pickup;
            $routes['destination'] = $data->route->destination;
            $routes['photo'] = $data->driver->photo;
            $routes['startend'] = $startend;
            $routes['star'] = DriverController::getRating($data->driver->userID);
            $routes['empty'] = 5 - $routes['star'];
        }
        if ($routes) {
            return response()->json(['response' => 'Success', 'data' => $routes]);
        }
        return response()->json(['response' => 'Fail', 'data' => null]);
    }

    public function edit($id) {
        
    }

    //Delete after not able to find the driver (Now booking)
    public static function delete($id) {
        $booking = Booking::find($id);
        $route = Route::find($booking->route_id);
        $booking->delete();
        $route->delete();
    }

    //passenger cancel booking
    public function cancel() {
        if (Auth::check() && request()->session()->exists('driverFound')) {
            $booking = Booking::find(request()->session()->get('booking_id'));
            if ($booking && $booking->status == "Scheduled") {
                $booking->status = 'Cancelled';
                $booking->save();

                $cancel = new Cancellations;
                $cancel->cancel_by = Auth::user()->userID;
                $cancel->cancel_type = 'Passenger';
                $cancel->booking_id = $booking->booking_id;
                $cancel->reason = "Booking cancelled by passenger";
                $cancel->save();

                $route = Route::find($booking->route_id);
                if ($route->posted_type == 'Passenger' && $route->posted_by == Auth::user()->userID) {
                    $route->status = 'Cancelled';
                    $route->save();
                } else {
                    $route->available_seats = $route->available_seats + $booking->seats;
                    $route->status = 'Open';
                    $route->save();
                }
                request()->session()->forget('booking_id');
                request()->session()->forget('driverFound');
                return redirect('rides')->with('success', 'You have successfully cancelled.');
            }
        }
        return redirect()->back()->with('failure', 'Error occurred.');
    }

    //Passenger raise new schedule request
    public function scheduleRequest(Request $request) {

        if ($request->isMethod('post')) {
            $route = new Route;
            $route->status = "Open";
            $route->route_datetime = date("Y-m-d H:i:s", strtotime($request->datetime));
            $route->available_seats = $request->seats;
            $route->pickup = $request->pick;
            $route->destination = $request->dest;
            $route->posted_by = Auth::user()->userID;
            $route->posted_type = "Passenger";
            $route->save();

            $booking = new Booking;
            $booking->request_time = date("Y-m-d H:i:s");
            $booking->status = "Open";
            $booking->seats = $request->seats;
            $booking->price = $request->price;
            $booking->passenger_id = Auth::user()->userID;
            //$booking->driver_id = 0;
            $booking->route_id = $route->route_id;
            $booking->save();
            return response()->json(['response' => 'Success']);
        }

        return response()->json(['response' => 'There is something wrong.']);
    }

    public function submitRating(Request $request) {

        if ($request->isMethod('post')) {
            $booking = Booking::find($request->booking_id);
            $booking->rating = $request->rating;
            $booking->save();

            request()->session()->forget('driverFound');

            return redirect('rides');
        }
    }

}
