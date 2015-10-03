<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/provider', function () {
	return view('provider');
});
	
Route::get('/about', function () {
	return view('about');
});

Route::get('/register', function () {
	return view('register');
});
	
// A route group allows us to have a prefix, in this case api
Route::group(array('prefix' => 'api'), function()
{
	Route::any('/vendor/register/{cell}', 'VendorController@signup');
	Route::any('/vendor/verify/{cell}/{otp}', 'VendorController@verifyotp');
	Route::any('/vendor/setname/{token}/{name}', 'VendorController@setName');
	Route::any('/settings/set/{token}', 'SettingsController@set');
	Route::any('/settings/get/{token}', 'SettingsController@get');
	
	Route::any('/qstatus/update/{token}/{counter}', 'VendorController@updateCounter');
	Route::any('/qstatus/get/{cell}','VendorController@getCounter');
	Route::any('/qstatus/publicinfo/{cell}','VendorController@getPublicInfo');
	
	Route::any('/qstatus/next/{token}', 'VendorController@setNextCounter');
	Route::any('/qstatus/reset/{token}', 'VendorController@resetCounter');

	Route::any('/appointment/book/{cell}/{reference}/{counter}', 'AppointmentController@book');
	Route::any('/appointment/cancel/{cell}/{reference}', 'AppointmentController@cancel');
	Route::any('/appointment/isaccepting/{cell}', 'AppointmentController@isAccepting');
	Route::any('/appointment/retrieve/{token}/{counter}', 'AppointmentController@retrieve');
	Route::any('/appointment/reset/{token}', 'AppointmentController@reset');
	Route::any('/appointment/accept/{token}', 'AppointmentController@accept');
	Route::any('/appointment/close/{token}', 'AppointmentController@close');
	Route::any('/appointment/retrieveall/{token}/{counter}', 'AppointmentController@retrieveAll');
});


		