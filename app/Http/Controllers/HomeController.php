<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('home.home');
    }

//foldername.filename
//    public function postLogin() {
//        $email = Input::get('email');
//        $password = Input::get('password');
//        $remember = (Input::has('remember')) ? true : false;
//
//        if (Auth::attempt(array('email' => $email, 'password' => $password), $remember)) {
//            if (Auth::user()->status == 'Banned') {
//                Auth::logout();
//                return Redirect::back()->with('failure', 'Your username/password combination was incorrect');
//            }
//            return redirect()->route('/');
//        } else {
//            return Redirect::back()->with('failure', 'Your username/password combination was incorrect');
//        }
//    }
}
