<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller {

    public function __construct() {
        
        $this->middleware('auth'); 
//
//        $this->middleware('log')->only('index');
//
//        $this->middleware('subscribed')->except('store');
    }

    public function index() {

        return view('users.profile');
    }
    
    public function show() {
        return view('users.profile');
    }

    public function edit() { 
        $user = Auth::user(); 
         return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id) {

        //My Profile update
        request()->validate([
            'name' => 'required',
            'first_name' => 'required',
            'email' => 'required',
            'contactNO' => 'required',
        ]);

        User::find($id)->update($request->all());
 
       return redirect()->route('user.index')
                        ->with('success', 'User profile updated successfully');
    }

    public function changePassword(){
        return view('users.change_pw');
    } 

}
