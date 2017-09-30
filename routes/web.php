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
/*
  |--------------------------------------------------------------------------
  | Resource Contollers
  |--------------------------------------------------------------------------
 */
 
Route::resource('user', 'UserController'); 
Route::resource('rides', 'RideController'); 