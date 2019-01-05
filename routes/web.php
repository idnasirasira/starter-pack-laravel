<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/* Send Email Route Queue */
Route::get('send-email', function(){
  
	$details['email'] = 'arris.smpn6@gmail.com';
  
    dispatch(new App\Jobs\SendEmailJob($details));
  
    dd('done');
});

/* FrontEnd */
Route::get('/', function () {
    return view('welcome');
});


/* BackEnd */
Auth::routes(["verify" => true]);
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
