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
        'plate_no','model', 'manufacture_year','capacity','driver_register_date','driving_license_no'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         
    ];
    
     public function driver() {
        return $this->hasOne('App\Driver');
    }
    public  $timestamps = false;
    public $incrementing = false;
}
