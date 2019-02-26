<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/testroute', function () use ($router){
	dd(json_encode("this is test route for CAR BNB App. "));
});

// $router->get('/signup', function () {
//     return 'SignUP Router';
// });

// $router->post('/api/user/signup',['middleware'=>'auth','uses'=>'UserController@signup']);
// $router->post('/api/user/signup','UserController@signup');
// $router->post('/login','UserController@login');


$router->group(['prefix'=>'api/user','middleware'=>'auth'],function() use ($router){

	$router->put('/signup','UserController@signup');
	$router->post('/login','UserController@login');
	$router->post('/forgetpassword','UserController@forgetPassword');


});

$router->group(['prefix'=>'api/user','middleware'=>'auth'],function() use ($router){

	$router->get('/logout','UserController@logout');
	$router->post('/changepassword','UserController@changePassword');
	$router->get('/profile','UserController@profile');
	$router->post('/update-profile','UserController@updateProfile');

	$router->get('/countries','MiniController@getAllCountries');
	$router->get('/city/{countryId}','MiniController@getCityByCountryId');
	$router->get('/categories','MiniController@getAllCategories');

	$router->post('/add-car','CarController@addUserCar');
	$router->get('/all-rent-cars','CarController@getCars');
	$router->get('/my-cars','CarController@getUserCars');
});