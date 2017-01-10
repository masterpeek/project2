<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('call_data_weather_station', 'WeatherStationController@callData');
Route::get('register1', 'RegisterController@register');

Route::post('addUser', 'RegisterController@addUser');
Route::resource('user','UserController');
Route::post('register', 'UserController@register');
Route::get('allData', 'WeatherStationController@allData');
Route::get('allUser', 'UserController@allUser');
Route::get('allDb', 'WeatherStationController@allDB');

Route::post('getNoise', 'AutoReportNoiseByUserController@getNoise');
Route::get('showNoise', 'AutoReportNoiseByUserController@showNoise');