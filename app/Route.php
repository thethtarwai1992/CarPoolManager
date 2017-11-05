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
        'seats', 'comment', 'status','destination', 'pickup','start','end'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'posted_by'
    ];

    public function bookings() {
        return $this->hasMany('App\Booking','route_id');
    }
    /*
    public function booking() {
        return $this->belongsTo('App\Booking', 'foreign_key');
    }
     * 
     */ 
}
