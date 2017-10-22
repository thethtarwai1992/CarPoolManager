<?php

namespace App; 

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
 
    protected $primaryKey = 'location_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address', 'postal_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         
    ];
}
