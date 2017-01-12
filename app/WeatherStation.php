<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class WeatherStation extends Model
{
    //use Notifiable;
    //public $timestamps = true;

    protected $table = 'weather_station';
    //อนุญาติให้ใส่อะไรเข้ามาได้บ้าง
    protected $fillable = [
        'station_id', 'station_name', 'area_name', 'province_name',
        'aqi_value', 'aqi_condition_name', 'lat', 'long'
    ];

    public static function nearBy($lat, $long)
    {
        $results =  DB::select(DB::raw('SELECT * FROM weather_station 
        WHERE $lat = lat AND $long = long') );
    }
}
