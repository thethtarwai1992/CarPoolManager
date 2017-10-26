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
        'seats', 'comment', 'destination', 'pickup'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function booking() {
        return $this->belongsTo('App\Booking', 'foreign_key');
    }

}
