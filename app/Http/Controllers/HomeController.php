<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller {
    
    public function getIndex(){
        
        return view('home.home'); 
    }    

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
