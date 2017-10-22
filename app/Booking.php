<?php

namespace App; 

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
 
    protected $primaryKey = 'booking_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'request_time', 'status', 'price'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'passenger_id', 'route_id' , 'drivers_driving_license_no'
    ];
}
