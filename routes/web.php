<?php
/*
  |--------------------------------------------------------------------------
  | Routes
  |--------------------------------------------------------------------------
 */
//Get
Route::get('/', 'HomeController@getIndex'); 
Route::post('/home/login', 'HomeController@postLogin');

Route::get('rides/scheduled', 'RideController@scheduled'); 
Route::get('rides/myrides', 'RideController@show'); 

Route::get('user/change-pw', 'UserController@changePassword'); 
Route::get('user/edit', 'UserController@edit'); 
/*
  |--------------------------------------------------------------------------
  | Resource Contollers
  |--------------------------------------------------------------------------
 */
 
Route::resource('user', 'UserController'); 
Route::resource('rides', 'RideController'); 