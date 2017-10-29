<?php

namespace App; 

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
 
    protected $primaryKey = 'plate_no';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model', 'manufacture_year','capacity'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         
    ];
}
