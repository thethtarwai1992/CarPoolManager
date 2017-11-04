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
        'seats', 'comment', 'status','destination_point', 'pick_up_point','route_datetime','drivers_driving_license_no'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'drivers_driving_license_no'
    ];

    public function booking() {
        return $this->hasOne('App\Booking','route_id');
    }
    /*
    public function booking() {
        return $this->belongsTo('App\Booking', 'foreign_key');
    }
     * 
     */
    public  $timestamps = false;
}
