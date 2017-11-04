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
        'driving_license_no','driving_license_valid_till', 'remarks','status','User_userID'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'User_userID' 
    ];
    
    public function scopeDriver($query,$id)
    {
        return $query->where('User_userID', $id);
    }
    
    public function user() {
        return $this->hasOne('App\User');
    }
    
     public function route()
    {
        return $this->hasMany('App\Route');
    }
    
    public  $timestamps = false;
    public $incrementing = false;
}
