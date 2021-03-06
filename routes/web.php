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
Route::post('/select_condition_all', 'WebController@select_condition_all');
Route::post('/search_all', 'WebController@search_all');

Route::get('/login_admin', 'AdminController@index')->name('login_admin');
Route::get('/create_form_admin', 'AdminController@create');
Route::post('/create_admin', 'AdminController@createAdmin');
Route::post('/check_login_admin', 'AdminController@loginAdmin');
Route::get('/index_admin', 'AdminController@indexAdmin')->name('index_admin');
Route::post('search_user_admin', 'AdminController@searchUser');
Route::post('search_condition_user_admin', 'AdminController@searchConditionUser');
Route::get('/index_admin_edit/{id}', 'AdminController@editUser');
Route::post('/update_user', 'AdminController@updateUser');
Route::delete('/index_admin/{id}', 'AdminController@deleteUser');
Route::get('/index_admin_ws', 'AdminController@indexWeatherStation')->name('index_admin_ws');
Route::post('search_weather_admin', 'AdminController@searchWeatherStation');
Route::post('search_condition_ws_admin', 'AdminController@searchConditionWeatherStation');
Route::delete('/index_admin_ws/{id}', 'AdminController@deleteWeatherStation');
Route::get('/index_admin_noise', 'AdminController@indexNoise')->name('index_admin_noise');
Route::post('search_noise_admin', 'AdminController@searchNoise');
Route::delete('/index_admin_noise/{id}', 'AdminController@deleteNoise');
Route::get('/index_admin_air', 'AdminController@indexAir')->name('index_admin_air');
Route::post('search_air_admin', 'AdminController@searchAir');
Route::post('search_condition_air_admin', 'AdminController@searchConditionAir');
Route::delete('/index_admin_air/{id}', 'AdminController@deleteAir');
Route::get('/logout', 'AdminController@destroySession')->name('logout');

Route::get('call_data_weather_station', 'WeatherStationController@callData');
Route::get('return_data_weather_station', 'WeatherStationController@allData');
Route::get('allDb', 'WeatherStationController@allDB');
Route::post('aqi_near_by', 'WeatherStationController@nearByLatLong');
Route::post('notify_nearby_weather', 'WeatherStationController@notifyWeatherNearby');
Route::get('good_rank', 'WeatherStationController@goodRank');
Route::get('bad_rank', 'WeatherStationController@badRank');
Route::get('maps', 'WeatherStationController@maps');
Route::get('/index_weather', 'WeatherStationController@index');
Route::get('/all', 'WeatherStationController@viewAll');
Route::get('/next/{number}', 'WeatherStationController@next');
Route::get('/show_weather_station/{id}', 'WeatherStationController@show');
Route::get('/show_near', 'WeatherStationController@showNear');
Route::post('/search_weather', 'WeatherStationController@search');
Route::post('/select_condition', 'WeatherStationController@select_condition');
Route::post('/select_condition_weather', 'WeatherStationController@selectConditionWeather');

Route::resource('user','UserController');
Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');
Route::get('allUser', 'UserController@allUser');

Route::post('get_noise', 'AutoReportNoiseByUserController@getNoise');
Route::get('show_noise', 'AutoReportNoiseByUserController@showNoise');
Route::get('report_noise_maps', 'AutoReportNoiseByUserController@maps');
Route::get('/index_report_noise', 'AutoReportNoiseByUserController@index');
Route::get('/all_report_noise', 'AutoReportNoiseByUserController@viewAll');
Route::get('/show_report_noise/{id}', 'AutoReportNoiseByUserController@show');
Route::post('/notify_nearby_noise', 'AutoReportNoiseByUserController@reportNoiseNearBy');
Route::post('/search_noise', 'AutoReportNoiseByUserController@search');
Route::post('/update_noise', 'AutoReportNoiseByUserController@updateNoise');

Route::post('get_air', 'ReportAirByUserController@getAir');
Route::get('show_air', 'ReportAirByUserController@showAir');
Route::get('report_air_maps', 'ReportAirByUserController@maps');
Route::get('/index_report_air', 'ReportAirByUserController@index');
Route::get('/all_report_air', 'ReportAirByUserController@viewAll');
Route::get('/show_report_air/{id}', 'ReportAirByUserController@show');
Route::get('/show_air_picture/{id}', 'ReportAirByUserController@showAirPicture');
Route::post('/notify_nearby_air','ReportAirByUserController@reportAirNearBy');
Route::post('/search_air', 'ReportAirByUserController@search');
Route::post('/update_air', 'ReportAirByUserController@updateAir');
Route::post('/select_condition_air', 'ReportAirByUserController@select_condition_air');
Route::post('/select_condition_air_index', 'ReportAirByUserController@selectConditionAirIndex');