<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Driver;

class User extends Authenticatable {

    use Notifiable;

    protected $primaryKey = 'userID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'last_name', 'email', 'first_name', 'contactNo', 'gender', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'is_driver' => 'boolean',
    ];

    public function driver() {
        return $this->hasOne(Driver::class, 'userID');
    }

    //public $timestamps = false;

}
