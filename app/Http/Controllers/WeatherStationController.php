<?php

namespace App\Http\Controllers;

use App\Near;
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

        $id_station = array('02t', '03t', '05t', '10t', '12t', '52t', '54t',
            '59t', '61t', '46t', '60t', '32t', '33t', '34t', '76t', '47t', '41t',
            '13t', '62t', '67t', '75t', '77t', '21t', '70t', '43t', '63t', '28t',
            '30t', '31t', '74t', '26t', '37t', '38t', '39t', '40t', '68t', '44t',
            '08t', '16t', '17t', '19t', '14t', '27t', '24t', '25t', '71t', '42t',
            '57t', '73t', '35t', '36t', '72t', '69t', '58t', 'm109', 'm110');

        $size_id_station = sizeof($id_station);

        Log::info($size_id_station);

        $client = new GuzzleHttp\Client();

        for ($i = 0; $i < $size_id_station; $i++) {
            $res = $client->request('GET', 'http://air4thai.pcd.go.th/forapp2/getAQI_JSON.php?stationID=' . $id_station[$i]);
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
            $data['date'] = $ans->AQILast->date;
            $data['time'] = $ans->AQILast->time;
            $data['station_type'] = $ans->stationType;

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
        $ans = "";

        $aqi_near_by["aqi_near_by"] = [];

        $arr =[];

        $data = $request->all();

        $lat = $data["Latitude"];
        $lng = $data["Longitude"];

        $arr['lat'] = doubleval($lat);
        $arr['long'] = doubleval($lng);

        $result = DB::select('select weather_station.aqi_value, 
        weather_station.aqi_condition_name, 
        weather_station.area_name, weather_station.province_name,  
        weather_station.lat, weather_station.long, 
        (3959 * acos(cos(radians(' . $lat . ')) * cos(radians(weather_station.lat)) 
        * cos(radians(weather_station.long ) - radians(' . $lng . ')) 
        + sin(radians(' . $lat .')) * sin(radians(weather_station.lat)))) as distance
        from weather_station order by distance limit 1');

        $ans = $ans.$result[0]->aqi_value.";".$result[0]->aqi_condition_name.";".$result[0]->area_name;

        $arr['area'] = $ans;

        Near::create($arr);

        return $ans;

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

    public function maps()
    {
        $markers = WeatherStation::all();

        return view('maps')->with('markers', $markers);
    }

    public function index()
    {
        $datas = WeatherStation::all()->take(6);

        return view('index')->with('datas', $datas);
    }

    public function show($id)
    {
        $data = WeatherStation::where('station_id', $id)->get()->first();

        return view('show_weather_station')->with('data', $data);
    }

    public function viewAll()
    {
        $datas = WeatherStation::all();

        return view('index')->with('datas', $datas);
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

    public function showNear()
    {
        $all = Near::all();

        return $all;
    }
}
