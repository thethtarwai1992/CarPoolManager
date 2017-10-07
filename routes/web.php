<?php
/*
  |--------------------------------------------------------------------------
  | Routes
  |--------------------------------------------------------------------------
 */
//Get
Route::get('/', 'HomeController@getIndex'); 
Route::post('/home/login', 'HomeController@postLogin');
Route::get('driver/register','DriverRegisterController@index');

Route::get('rides/scheduled', 'RideController@scheduled'); 
Route::get('driver/route', 'RouteController@index'); 
Route::get('driver/task', 'TaskController@index'); 
Route::get('driver/booking_now', 'BookingController@booknow'); 
Route::get('driver/new_request', 'BookingController@newrequest'); 
/*
  |--------------------------------------------------------------------------
  | Resource Contollers
  |--------------------------------------------------------------------------
 */
 
Route::resource('user', 'UserController'); 
Route::resource('rides', 'RideController'); 
Route::resource('driver', 'RouteController'); 