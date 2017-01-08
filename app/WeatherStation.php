<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeatherStation extends Model
{
    protected $table = 'weather_station';
    //อนุญาติให้ใส่อะไรเข้ามาได้บ้าง
    protected $fillable = [
        'station_id', 'station_name', 'area_name', 'province_name',
        'aqi_value', 'aqi_condition_name', 'lat', 'long'
    ];
}
