<?php

namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use Mail;
use App\Route;

class MailController extends Controller {

//    public function send(){
//        $r = Route::with('driver')->find(8);
//        $r['price'] = 10;
//        $this->sendToDriver($r);
//    }
 
    public static function sendToDriver($data) { 
        Mail::send(['text' => 'emails.email_to_driver'], ['data' => $data], function($message) use ($data){
            $message->from('Carpoolingmanager@gmail.com', 'Carpooling Manager');
            $message->to($data->driver->email, $data->driver->first_name)
            //$message->to('blackfirewave@gmail.com','Thet')
                    ->subject('Passenger booked from your scheduled post!');
        });
    }

}
