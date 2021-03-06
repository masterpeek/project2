<?php

namespace App\Http\Controllers;

use App\WeatherStation;
use Illuminate\Http\Request;
use GuzzleHttp;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class WeatherStationController extends Controller
{
    public function callData()
    {
        DB::table('weather_station')->delete();

        $id_station = array('02t', '03t', '05t', '10t', '12t', '52t', '54t',
            '59t', '61t', '46t', '60t', '32t', '33t', '34t', '76t', '47t', '41t',
            '13t', '62t', '67t', '75t', '77t', '70t', '43t', '63t', '28t',
            '30t', '31t', '74t', '26t', '37t', '38t', '39t', '40t', '68t', '44t',
            '08t', '16t', '17t', '19t', '14t', '27t', '24t', '25t', '71t', '42t',
            '57t', '73t', '35t', '36t', '72t', '69t', '58t', 'm101', 'm110');

        $size_id_station = sizeof($id_station);


        $client = new GuzzleHttp\Client();

        for ($i = 0; $i < $size_id_station; $i++) {
            $res = $client->request('GET', 'http://air4thai.pcd.go.th/forapp2/getAQI_JSON.php?stationID=' . $id_station[$i]);
            $store = $res->getBody()->getContents();
            $ans = GuzzleHttp\json_decode($store);

            $province_name_split = explode(", ", $ans->areaTH);
            $province_name_split = $province_name_split[sizeof($province_name_split) - 1];

            $check = array("มหานคร", "ฯ", "จ.");

            $province_name = str_replace($check,"",$province_name_split);

            $check2 = array("มหานคร", "ฯ", $province_name, "จ.");

            $area_name = str_replace($check2,"",$ans->areaTH);

            $area_name1 = str_replace(","," ",$area_name);

            $data = [];
            $data['station_id'] = $ans->stationID;
            $data['station_name'] = $ans->nameTH;
            $data['area_name'] = $area_name1;
            $data['province_name'] = $province_name;
            $data['aqi_value'] = $ans->AQILast->AQI->aqi;
            $data['lat'] = $ans->lat;
            $data['long'] = $ans->long;
            $data['date'] = $ans->AQILast->date;
            $data['thai_date'] = $this->thai_date_and_time(strtotime($ans->AQILast->date));
            $data['time'] = $ans->AQILast->time;
            $data['station_type'] = $ans->stationType;

            if ($ans->AQILast->AQI->aqi >= 0 && $ans->AQILast->AQI->aqi <= 50) {
                $data['aqi_condition_name'] = 'ดี';
            } else if ($ans->AQILast->AQI->aqi >= 51 && $ans->AQILast->AQI->aqi <= 100) {
                $data['aqi_condition_name'] = 'ปานกลาง';
            } else if ($ans->AQILast->AQI->aqi >= 101 && $ans->AQILast->AQI->aqi <= 200) {
                $data['aqi_condition_name'] = 'กระทบต่อสุขภาพ';
            } else if ($ans->AQILast->AQI->aqi >= 201 && $ans->AQILast->AQI->aqi <= 300) {
                $data['aqi_condition_name'] = 'กระทบต่อสุขภาพมาก';
            } else if ($ans->AQILast->AQI->aqi > 300) {
                $data['aqi_condition_name'] = 'อันตราย';
            }

            WeatherStation::create($data);

        }
        
    }

    public function thai_date_and_time($time)
    {   // 19 ธันวาคม 2556 เวลา 10:10:43
        $thai_date_return = "";

        $thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");

        $thai_month_arr=array(
            "0"=>"",
            "1"=>"มกราคม",
            "2"=>"กุมภาพันธ์",
            "3"=>"มีนาคม",
            "4"=>"เมษายน",
            "5"=>"พฤษภาคม",
            "6"=>"มิถุนายน",
            "7"=>"กรกฎาคม",
            "8"=>"สิงหาคม",
            "9"=>"กันยายน",
            "10"=>"ตุลาคม",
            "11"=>"พฤศจิกายน",
            "12"=>"ธันวาคม"
        );

        $thai_month_arr_short=array(
            "0"=>"",
            "1"=>"ม.ค.",
            "2"=>"ก.พ.",
            "3"=>"มี.ค.",
            "4"=>"เม.ย.",
            "5"=>"พ.ค.",
            "6"=>"มิ.ย.",
            "7"=>"ก.ค.",
            "8"=>"ส.ค.",
            "9"=>"ก.ย.",
            "10"=>"ต.ค.",
            "11"=>"พ.ย.",
            "12"=>"ธ.ค."
        );

        $thai_date_return.= date("j",$time);
        $thai_date_return.= " ".$thai_month_arr_short[date("n",$time)];
        $thai_date_return.= " ".(date("Y",$time)+543);

        return $thai_date_return;

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
        weather_station.area_name, weather_station.province_name, weather_station.thai_date,weather_station.time,   
        weather_station.lat, weather_station.long, 
        (6371 * acos(cos(radians(' . $lat . ')) * cos(radians(weather_station.lat)) 
        * cos(radians(weather_station.long ) - radians(' . $lng . ')) 
        + sin(radians(' . $lat .')) * sin(radians(weather_station.lat)))) as distance
        from weather_station order by distance limit 1');

        $ans = $ans.$result[0]->aqi_value.";".$result[0]->aqi_condition_name.";".$result[0]->area_name.";".number_format($result[0]->distance, 2).";".
            $result[0]->thai_date.";".$result[0]->time.";".$result[0]->province_name;

        $arr['area'] = $ans;

        return $ans;

    }

    public function notifyWeatherNearby(Request $request)
    {
        $ans = "";

        $data = $request->all();

        $lat = $data["Latitude"];
        $lng = $data["Longitude"];
        $distance = $data["Distance"];

        $result = DB::select('select weather_station.aqi_value, 
        weather_station.aqi_condition_name, 
        weather_station.area_name, weather_station.province_name, weather_station.thai_date,weather_station.time,   
        weather_station.lat, weather_station.long, 
        (6371 * acos(cos(radians(' . $lat . ')) * cos(radians(weather_station.lat)) 
        * cos(radians(weather_station.long ) - radians(' . $lng . ')) 
        + sin(radians(' . $lat .')) * sin(radians(weather_station.lat)))) as distance
        from weather_station having distance <= '. $distance .' order by distance limit 1');

        if($result != null)
        {
            if($result[0]->aqi_value >= 101)
            {
                $ans = $ans.$result[0]->aqi_value.";".$result[0]->aqi_condition_name.";".$result[0]->area_name.";".number_format($result[0]->distance, 2).";".
                    $result[0]->thai_date.";".$result[0]->time.";".$result[0]->province_name;

                return $ans;
            }
            else
            {
                 return "no result";
            }
        }
        else
        {
            return "no result";
        }

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
        $datas = WeatherStation::orderBy('date', 'DESC')->orderBy('time', 'DESC')->take(8)->get();

        return view('index_weather')->with('datas', $datas);
    }

    public function show($id)
    {
        $data = WeatherStation::where('station_id', $id)->get()->first();

        return view('show_weather_station')->with('data', $data);
    }

    public function viewAll()
    {
        $datas = WeatherStation::orderBy('date', 'DESC')->orderBy('time', 'DESC')->get();

        return view('index_weather')->with('datas', $datas);
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

    public function search()
    {
        $input = Input::all();

        $check_bkk = array("มหานคร");

        $province = str_replace($check_bkk,"",$input['province']);

        $datas = WeatherStation::where('province_name', $province)->get();

        return view('index_weather')->with('datas', $datas);

    }

    public function select_condition()
    {
        $input = Input::all();

        $condition = $input["condition"];

        if($condition === "ทั้งหมด")
        {
            $datas = WeatherStation::all();
        }
        else
        {
            $datas = WeatherStation::where('aqi_condition_name', $condition)->get();
        }

        return view('maps')->with('markers', $datas);
    }

    public function selectConditionWeather()
    {
        $input = Input::all();

        $condition = $input["condition"];

        if($condition === "ทั้งหมด")
        {
            $datas = WeatherStation::orderBy('date', 'DESC')->orderBy('time', 'DESC')->get();
        }
        else
        {
            $datas = WeatherStation::where('aqi_condition_name', $condition)->orderBy('date', 'DESC')->orderBy('time', 'DESC')->get();
        }

        return view('index_weather')->with('datas', $datas);
    }

}
