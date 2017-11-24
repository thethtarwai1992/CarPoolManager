<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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
        if (Auth::check()) {
            if (Auth::user()->is_admin) {
                return redirect('admin/drivers');
            }
            return redirect('rides');
        } else {
            return view('home.home');
        }
    }

    public function faq() {
        return view('home.faq');
    }

    public function about() {
        return view('home.about');
    }

    public function contact() {
        return view('home.contact');
    }

}
