<?php
use App\Models\Course;
use App\Models\Benefit;

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

// $router->get('/login',function(){
// 	return view('/login');
// });

$router->group(['prefix' => env('API_VERSION')], function($router) {
	$router->controller('user', 'UserController',[
		'postAdd'						=>	'user.add',
		'postVerifyOtp' 		=> 	'user.verify-otp',
		'getResendOtp'			=>	'user.resend-otp',
		'getAccountStatus'	=>	'user.account-status',
		'postLogin'					=>	'user.login'
	]);

	$router->controller('exams', 'ExamsController',[
		'getList'						=>	'exams.list',
		'getCourses'				=>	'exam.courses'
	]);
});

// $router->get('seed-test',function(Course $course, Benefit $benefit){
// 	$courses = $course->get();
// 	$benefitIds = $benefit->lists('id')->toArray();
// 	$randomKeys = array_rand($benefitIds, 10);
// 	foreach($randomKeys as $randomKey) {
		
// 	}
// });
// 
$router->get('debug', function(){
	echo 'Dbugging';
	\Debugbar::enable();
});
