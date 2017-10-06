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
<<<<<<< HEAD
Route::get('/admin', 'AdminController@scheduled');
Route::get('/admin/details','AdminController@show');
=======
Route::get('rides/myrides', 'RideController@show'); 

Route::get('user/change-pw', 'UserController@changePassword'); 
Route::get('user/edit', 'UserController@edit'); 
>>>>>>> 9aed203bedbd51b24fdd3574b790fc998c30a865
/*
  |--------------------------------------------------------------------------
  | Resource Contollers
  |--------------------------------------------------------------------------
 */
 
Route::resource('user', 'UserController'); 
Route::resource('rides', 'RideController'); 