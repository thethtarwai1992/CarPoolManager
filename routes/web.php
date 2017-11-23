<?php
/*
  |--------------------------------------------------------------------------
  | Routes
  |--------------------------------------------------------------------------
 */
Route::get('logout', 'Auth\LoginController@logout');
/* |-------------------------------------------------------------------------- */

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
/* |-------------------------------------------------------------------------- */

Route::get('driver/register', 'DriverController@register');
Route::get('driver/switch-to-driver', 'DriverController@switchToDriver');
Route::post('driver/register/store', 'DriverController@store');
Route::get('driver/profile', 'DriverController@index');
/* |-------------------------------------------------------------------------- */

Route::get('driver/route', 'RouteController@show');
Route::post('driver/route/store', 'RouteController@store');
Route::get('driver/route/cancel', 'RouteController@cancel');
//Route::get('driver/route/update/{id}', 'RouteController@update');  
Route::get('driver/route', 'RouteController@show');
Route::get('route/view/{id}', 'RouteController@view');
/* |-------------------------------------------------------------------------- */

Route::get('driver/task', 'TaskController@show');
Route::post('driver/task/cancel', 'TaskController@cancel');
Route::get('task/accept/{id}', 'TaskController@accept');
Route::get('driver/scheduled', 'TaskController@showScheduled');
Route::get('driver/new_request', 'TaskController@newRequest');
Route::get('task/view/{id}', 'TaskController@view');


Route::get('rides/myrides', 'RideController@show');
Route::get('rides/scheduled', 'RideController@scheduled');
Route::get('route/view/{id}', 'RouteController@view');
/* |-------------------------------------------------------------------------- */

Route::get('rides/myrides', 'RideController@show');
Route::get('rides/scheduled', 'RideController@scheduled');
/* |-------------------------------------------------------------------------- */

Route::post('rides/request', 'BookingController@store');
Route::post('book', 'BookingController@book');
Route::get('booking/finding', 'BookingController@bookingUpdate');  
Route::get('booking/cancel', 'BookingController@cancel');  
Route::get('bookings/ongoing', 'BookingController@ongoing'); 
Route::post('book/scheduled', 'BookingController@bookSchedule');
Route::get('bookings/view/{id}', 'BookingController@view');
Route::post('rides/schedule-request', 'BookingController@scheduleRequest');
Route::post('submitRating', 'BookingController@submitRating');
/* |-------------------------------------------------------------------------- */

Route::get('user/change-pw', 'UserController@changePassword');
Route::get('user/edit', 'UserController@edit');
Route::post('book', 'BookingController@book');
/* |-------------------------------------------------------------------------- */

Route::get('user/change-pw', 'UserController@changePassword');
Route::get('user/edit', 'UserController@edit');
/* |-------------------------------------------------------------------------- */

Route::get('user/change-pw', 'UserController@changePassword');
Route::get('user/edit', 'UserController@edit');
/* |-------------------------------------------------------------------------- */

Route::get('/admin', 'AdminController@scheduled');
Route::get('/admin/details', 'AdminController@show');
/* |-------------------------------------------------------------------------- */

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
