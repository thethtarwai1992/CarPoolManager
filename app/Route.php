<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model {

    protected $primaryKey = 'route_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'seats', 'comment', 'destination_point', 'pick_up_point','route_start_datetime'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'driver_car_driver_driving_license_no','driver_car_car_plate_no'
    ];

    public function booking() {
        return $this->belongsTo('App\Booking', 'foreign_key');
    }
    
    
}
