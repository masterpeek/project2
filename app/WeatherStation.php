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

    public static function getNearby($lat, $long)
    {
        $result = WeatherStation::select('station_id, 3959 * acos(cos(radians(' . $lat . ')) * cos(radians(lat))
            * cos(radians(long ) - radians(' . $long . '))
            + sin(radians(' . $lat .')) * sin(radians(lat)))) as distance')
            ->orderBy('distance')
            ->limit('1')
            ->get();

        return $result;
    }

}
