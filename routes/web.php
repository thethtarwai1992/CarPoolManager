<?php
/*
  |--------------------------------------------------------------------------
  | Routes
  |--------------------------------------------------------------------------
 */ 
Route::get('logout', 'Auth\LoginController@logout'); 

Route::get('/', 'HomeController@index'); 
Route::get('/home', 'HomeController@index');

Route::get('driver/register','DriverController@index');
Route::post('driver/register/store', 'DriverController@store'); 

Route::get('driver/route', 'RouteController@show'); 
Route::post('driver/route/store', 'RouteController@store'); 

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
Route::resource('driver', 'DriverController');  
Route::resource('rides', 'RideController'); 
Route::resource('route', 'RouteController');  

//To test login
Auth::routes();