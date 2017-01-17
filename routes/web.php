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
Route::post('aqi_near_by', 'WeatherStationController@nearByLatLong');
Route::get('good_rank', 'WeatherStationController@goodRank');
Route::get('bad_rank', 'WeatherStationController@badRank');
Route::get('maps', 'WeatherStationController@maps');
Route::get('/', 'WeatherStationController@index');
Route::get('/all', 'WeatherStationController@viewAll');
Route::get('/next/{number}', 'WeatherStationController@next');
Route::get('/show_near/{lat}', 'WeatherStationController@showNear');



Route::resource('user','UserController');
Route::post('register', 'UserController@register');
Route::get('allUser', 'UserController@allUser');

Route::post('get_noise', 'AutoReportNoiseByUserController@getNoise');
Route::get('show_noise', 'AutoReportNoiseByUserController@showNoise');
Route::get('report_noise_maps', 'AutoReportNoiseByUserController@maps');

Route::post('get_air', 'ReportAirByUserController@getAir');
Route::get('show_air', 'ReportAirByUserController@showAir');
Route::get('report_air_maps', 'ReportAirByUserController@maps');