<?php

namespace App\Http\Controllers;

use App\WeatherStation;
use Illuminate\Http\Request;
use GuzzleHttp;
use Illuminate\Support\Facades\DB;
use Log;

class WeatherStationController extends Controller
{
    public function callData()
    {
        DB::table('weather_station')->delete();

        $id_station = array('02', '03', '05', '10', '12', '52', '54',
            '59', '61', '46', '60', '32', '33', '34', '76', '47', '41',
            '13', '62', '67', '75', '77', '21', '70', '43', '63', '28',
            '30', '31', '74', '26', '37', '38', '39', '40', '68', '44',
            '08', '16', '17', '19', '14', '27', '24', '25', '71', '42',
            '57', '73', '35', '36', '72', '69', '58');

        $size_id_station = sizeof($id_station);

        Log::info($size_id_station);

        $client = new GuzzleHttp\Client();

        for ($i = 0; $i < $size_id_station; $i++) {
            $res = $client->request('GET', 'http://air4thai.pcd.go.th/forapp2/getAQI_JSON.php?stationID=' . $id_station[$i] . 't');
            $store = $res->getBody()->getContents();
            $ans = GuzzleHttp\json_decode($store);
            Log::info($ans->areaTH);

            $province_name_split = explode(", ", $ans->areaTH);
            $province_name_split = $province_name_split[sizeof($province_name_split) - 1];

            $data = [];
            $data['station_id'] = $ans->stationID;
            Log::info($ans->stationID);
            $data['station_name'] = $ans->nameTH;
            $data['area_name'] = $ans->areaTH;
            $data['province_name'] = $province_name_split;
            $data['aqi_value'] = $ans->AQILast->AQI->aqi;
            $data['lat'] = $ans->lat;
            $data['long'] = $ans->long;

            if ($ans->AQILast->AQI->aqi >= 0 && $ans->AQILast->AQI->aqi <= 50) {
                $data['aqi_condition_name'] = 'คุณภาพดี';
            } else if ($ans->AQILast->AQI->aqi >= 51 && $ans->AQILast->AQI->aqi <= 100) {
                $data['aqi_condition_name'] = 'คุณภาพปานกลาง';
            } else if ($ans->AQILast->AQI->aqi >= 101 && $ans->AQILast->AQI->aqi <= 200) {
                $data['aqi_condition_name'] = 'มีผลกระทบต่อสุขภาพ';
            } else if ($ans->AQILast->AQI->aqi >= 201 && $ans->AQILast->AQI->aqi <= 300) {
                $data['aqi_condition_name'] = 'มีผลกระทบต่อสุขภาพมาก';
            } else if ($ans->AQILast->AQI->aqi > 300) {
                $data['aqi_condition_name'] = 'อันตราย';
            }

            WeatherStation::create($data);

        }

        Log::info($province_name_split);
        Log::info($ans->AQILast->AQI->aqi);

    }

    public function nearByLatLong(Request $request)
    {
        $aqi_near_by = [];

        $data = $request->all();

        $lat = $data["Latitude"];
        $lng = $data["Longitude"];

        $results = DB::select('select weather_station.aqi_value, 
        weather_station.aqi_condition_name, 
        weather_station.area_name, weather_station.province_name,  
        weather_station.lat, weather_station.long, 
        (3959 * acos(cos(radians(' . $lat . ')) * cos(radians(weather_station.lat)) 
        * cos(radians(weather_station.long ) - radians(' . $lng . ')) 
        + sin(radians(' . $lat .')) * sin(radians(weather_station.lat)))) as distance
        from weather_station order by distance limit 1');

        foreach ($results as $result){
            array_push($aqi_near_by, $result);
        }

        $aqi_value = strval($aqi_near_by['aqi_value']);
        $aqi_condition_name = strval($aqi_near_by['aqi_condition_name']);

        return array('aqi_value' => $aqi_value, 'aqi_condition_name' => $aqi_condition_name);

    }

    public function goodRank()
    {
        $good_rank["good_rank"] = [];

        $goods = WeatherStation::orderBy('aqi_value')->limit('10')->get();

        foreach ($goods as $good){
            array_push($good_rank["good_rank"], $good);
        }

        return $good_rank;
    }

    public function badRank()
    {
        $bad_rank["bad_rank"] = [];

        $bads = WeatherStation::orderBy('aqi_value','DESC')->limit('10')->get();

        foreach ($bads as $bad){
            array_push($bad_rank["bad_rank"], $bad);
        }

        return $bad_rank;
    }

    public function allData()
    {
        $arrWeather["arrWeather"] = [];


        $datas = WeatherStation::all();

        foreach ($datas as $data){
            array_push($arrWeather["arrWeather"], $data);
        }

        return $arrWeather;
    }






}
