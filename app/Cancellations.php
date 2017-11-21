<?php

namespace App;

use Illuminate\Database\Eloquent\Model; 
use App\Booking;

class Cancellations extends Model {

    protected $primaryKey = 'cancel_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reason', 'remarks','cancel_id','support_doc','booking_id','cancel_by','cancel_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      
    ];
    
    public function booking() {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

}
