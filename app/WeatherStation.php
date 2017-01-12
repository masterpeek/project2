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
        $results =  DB::select(DB::raw('SELECT id, 
        ( 3959 * acos( cos( radians(' . $lat . ') ) 
        * cos( radians( lat ) ) * cos( radians( lng ) 
        - radians(' . $long . ') ) + sin( radians(' . $lat .') ) 
        * sin( radians(lat) ) ) ) AS distance FROM weather_station 
        HAVING distance < 25 ORDER BY distance') );
    }
}
