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

    public static function nearBy($lat, $long, $max_distance = 25, $units = 'miles', $fields = false )
    {

        if(empty($lat)){
            $lat = 0;
        }
        if(empty($long)){
            $long = 0;
        }
        /*
         *  Allow for changing of units of measurement
         */
        switch ( $units ) {
            case 'miles':
                //radius of the great circle in miles
                $gr_circle_radius = 3959;
                break;
            case 'kilometers':
                //radius of the great circle in kilometers
                $gr_circle_radius = 6371;
                break;
        }
        /*
         *  Support the selection of certain fields
         */
        /*
         *  Generate the select field for disctance
         */
        $distance_select = sprintf(
            "           
					                ROUND(( %d * acos( cos( radians(%s) ) " .
            " * cos( radians( lat ) ) " .
            " * cos( radians( long ) - radians(%s) ) " .
            " + sin( radians(%s) ) * sin( radians( lat ) ) " .
            " ) " .
            ")
        							, 2 ) " .
            "AS distance
					                ",
            $gr_circle_radius,
            $lat,
            $long,
            $lat
        );

        $data = DB::select( DB::raw( implode( ',' ,  $fields ) . ',' .  $distance_select  ) )
            ->having( 'distance', '<=', $max_distance )
            ->orderBy( 'distance', 'ASC' )
            ->get();

        //echo '<pre>';
        //echo $query->toSQL();
        //echo $distance_select;
        //echo '</pre>';
        //die();
        //
        //$queries = DB::getQueryLog();
        //$last_query = end($queries);
        //var_dump($last_query);
        //die();
        return $data;

    }
}
