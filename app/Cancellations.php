<?php

namespace App;

use Illuminate\Database\Eloquent\Model; 

class Cancellations extends Model {

    protected $primaryKey = 'cancel_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reason', 'remarks','cancel_id','support_doc','booking_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      
    ];
    
    public  $timestamps = false;
    public $incrementing = false;
}
