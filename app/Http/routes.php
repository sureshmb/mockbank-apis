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
  return view('welcome');
});

$router->group(['prefix' => env('API_VERSION')], function($router) {
	$router->controller('user', 'UserController',[
		'postAdd'						=>	'user.add',
		'postVerifyOtp' 		=> 	'user.verify-otp',
		'getResendOtp'			=>	'user.resend-otp',
		'getAccountStatus'	=>	'user.account-status'
	]);
});
