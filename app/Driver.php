<?php

namespace App; 

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
 
    protected $primaryKey = 'driving_license_no';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'driving_license_valid_from', 'remarks'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'userID' 
    ];
}
