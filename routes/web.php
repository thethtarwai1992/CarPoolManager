<?php
/*
  |--------------------------------------------------------------------------
  | Routes
  |--------------------------------------------------------------------------
 */
Route::get('register', 'Auth/RegisterController@register');
Route::get('/', 'HomeController@index'); 
//Route::post('/home/login', 'HomeController@postLogin');
Route::get('driver/register','DriverRegisterController@index');

Route::get('driver/route', 'RouteController@index'); 

Route::get('driver/task', 'TaskController@index'); 

Route::get('driver/booking_now', 'BookingController@booknow'); 
Route::get('driver/new_request', 'BookingController@newrequest'); 

Route::get('/admin', 'AdminController@scheduled');
Route::get('/admin/details','AdminController@show');

Route::get('rides/myrides', 'RideController@show'); 
Route::get('rides/scheduled', 'RideController@scheduled'); 

Route::get('user/change-pw', 'UserController@changePassword'); 
Route::get('user/edit', 'UserController@edit'); 
/*
  |--------------------------------------------------------------------------
  | Resource Contollers
  |--------------------------------------------------------------------------
 */
 
Route::resource('user', 'UserController'); 
Route::resource('rides', 'RideController'); 
Route::resource('driver', 'RouteController');  

//To test login
Auth::routes();