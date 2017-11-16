<?php

namespace App;

use Illuminate\Database\Eloquent\Model; 
use App\Route;
use App\User;
use App\Driver;

class Booking extends Model {

    protected $primaryKey = 'booking_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start', 'status', 'price'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'passenger_id', 'route_id'
    ];

    
    /*
    public function route() {
        return $this->hasOne('App\Route');
    }
 * 
 */
     public function route() {
        return $this->belongsTo(Route::class, 'route_id');
    }
    
    public function passenger() {
        return $this->belongsTo(User::class, 'passenger_id');
    }    
    
    public function driver() {
        return $this->belongsTo(User::class, 'driver_id');
    }

       //public  $timestamps = false;
}
