<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Booking;

class Route extends Model {

    protected $primaryKey = 'route_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'seats', 'comment', 'status','destination', 'pickup'
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
        return $this->hasMany(Booking::class,'route_id');
    }
    public function driver() {
        return $this->belongsTo(User::class,'posted_by');
    }    
    public function passenger() {
        return $this->belongsTo(User::class,'posted_by');
    }
    /*
    public function booking() {
        return $this->belongsTo('App\Booking', 'foreign_key');
    }
     * 
     */ 
}
