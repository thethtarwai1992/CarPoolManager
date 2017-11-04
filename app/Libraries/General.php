<?php
//Class for common use functions

namespace App\Libraries;

class General{
    
       public function __construct() {
    
    }
    public static function checkIfDriver() { 
        $driverView = false; 
        if (request()->session()->exists('driverView')) { 
            $driverView =true;
        }
        return $driverView;
    }    
    
}