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
Route::get('/about', 'WebController@about');
Route::get('/contact', 'WebController@contact');

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
Route::get('/show_weather_station/{id}', 'WeatherStationController@show');
Route::get('/show_near', 'WeatherStationController@showNear');
Route::post('/search_weather', 'WeatherStationController@search');

Route::resource('user','UserController');
Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');
Route::get('allUser', 'UserController@allUser');

Route::post('get_noise', 'AutoReportNoiseByUserController@getNoise');
Route::get('show_noise', 'AutoReportNoiseByUserController@showNoise');
Route::get('delete_noise', 'AutoReportNoiseByUserController@deleteNoise');
Route::get('report_noise_maps', 'AutoReportNoiseByUserController@maps');
Route::get('/index_report_noise', 'AutoReportNoiseByUserController@index');
Route::get('/all_report_noise', 'AutoReportNoiseByUserController@viewAll');
Route::get('/show_report_noise/{id}', 'AutoReportNoiseByUserController@show');
Route::post('/notify_nearby_noise', 'AutoReportNoiseByUserController@reportNoiseNearBy');
Route::post('/delete_noise_marker', 'AutoReportNoiseByUserController@deleteNoiseMarker');

Route::post('get_air', 'ReportAirByUserController@getAir');
Route::get('show_air', 'ReportAirByUserController@showAir');
Route::get('delete_air', 'ReportAirByUserController@deleteAir');
Route::get('report_air_maps', 'ReportAirByUserController@maps');
Route::get('/index_report_air', 'ReportAirByUserController@index');
Route::get('/all_report_air', 'ReportAirByUserController@viewAll');
Route::get('/show_report_air/{id}', 'ReportAirByUserController@show');
Route::post('/notify_nearby_air','ReportAirByUserController@reportAirNearBy');
Route::post('/delete_air_marker', 'ReportAirByUserController@deleteAirMarker');