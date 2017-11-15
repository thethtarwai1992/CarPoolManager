<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Driver;

class Car extends Model {

    protected $primaryKey = 'plate_no';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'plate_no', 'model', 'manufacture_year', 'capacity', 'driver_register_date', 'driving_license_no'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function driver() {
        return $this->belongsTo(Driver::class, 'driving_license_no');
    }

    public $timestamps = false;
    public $incrementing = false;

}
