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

Route::get('/', 'WebController@index');

Route::get('call_data_weather_station', 'WeatherStationController@callData');
Route::get('return_data_weather_station', 'WeatherStationController@allData');
Route::get('allDb', 'WeatherStationController@allDB');

Route::resource('user','UserController');
Route::post('register', 'UserController@register');
Route::get('allUser', 'UserController@allUser');

Route::post('send_noise', 'AutoReportNoiseByUserController@getNoise');
Route::get('show_noise', 'AutoReportNoiseByUserController@showNoise');