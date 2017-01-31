<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;
use Illuminate\Support\Facades\DB;
use App\ReportAirByUser;

class ReportAirByUserController extends Controller
{
    public function getAir(Request $request)
    {
        $air = $request->all();

        $latitude = doubleval($air['Latitude']);
        $longitude = doubleval($air['Longitude']);

        $pollution_choice = 0;
        $smell_choice = "";

        if($air['PollutionChoice'] = "Normal"){
            $pollution_choice = 3;
        }
        else if($air['PollutionChoice'] = "High"){
            $pollution_choice = 4;
        }
        else if($air['PollutionChoice'] = "Very High"){
            $pollution_choice = 5;
        }

        $lat = $air['Latitude'];
        $long = $air['Longitude'];

        $client = new GuzzleHttp\Client();

        $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$long.'&key=AIzaSyBuNhJ7nKSLGV63AaNIls6M41Xu3kgK8Ss');
        $store = $res->getBody()->getContents();
        $ans = GuzzleHttp\json_decode($store);

        $air_area_name =  $ans->results[0]->formatted_address;
        $air_province_name = $ans->results[0]->address_components[4]->short_name;

        if($air['SmellChoice'] === "Normal"){
            $smell_choice = "ปกติ";
        }
        else if($air['SmellChoice'] === "High"){
            $smell_choice = "สูง";
        }
        else if($air['SmellChoice'] === "Very High"){
            $smell_choice = "สูงมาก";
        }

        $data = [];
        $data['air_smell'] = $smell_choice;
        $data['air_pollution'] = $pollution_choice;
        $data['air_comment'] = $air['Detail'];
        $data['air_lat'] = $latitude;
        $data['air_long'] = $longitude;
        $data['air_area_name'] = $air_area_name;
        $data['air_province_name'] = $air_province_name;

        $date = time();
        $data['air_thai_date'] = $this->thai_date_and_time($date);

        $data['user_id'] = intval($air['UserId']);

        ReportAirByUser::create($data);

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
        $thai_date_return.= " เวลา ".date("H:i:s",$time)." น.";

        return $thai_date_return;

    }

    public function reportAirNearby(Request $request)
    {
        $ans = "";

        $data = $request->all();

        $lat = $data["Latitude"];
        $lng = $data["Longitude"];
        $distance = $data["Distance"];

        $result = DB::select('select report_air_by_user.air_smell, 
        report_air_by_user.air_area_name, report_air_by_user.air_province_name,  
        report_air_by_user.air_lat, report_air_by_user.air_long, 
        (6371 * acos(cos(radians(' . $lat . ')) * cos(radians(report_air_by_user.air_lat)) 
        * cos(radians(report_air_by_user.air_long ) - radians(' . $lng . ')) 
        + sin(radians(' . $lat .')) * sin(radians(report_air_by_user.air_lat)))) as distance
        from report_air_by_user having distance < '. $distance .' order by distance limit 1');

        if($result != null)
        {
            $ans = $ans.$result[0]->air_smell.";".$result[0]->air_area_name.";".$result[0]->air_province_name;

            return $ans;
        }
        else
        {
            return "no result";
        }

    }

    public function showAir()
    {
        $arrAir["arrAir"] = [];

        $all_airs = ReportAirByUser::all();

        foreach ($all_airs as $all_air){
            array_push($arrAir["arrAir"], $all_air);
        }

        return $arrAir;
    }

    public function deleteAir()
    {
        $query = "TRUNCATE TABLE report_air_by_user";

        ReportAirByUser::getQuery($query)->delete();

    }

    public function maps()
    {
        $markers = ReportAirByUser::all();

        return view('report_air_maps')->with('markers', $markers);
    }

    public function index()
    {
        $datas = ReportAirByUser::orderBy('created_at', 'DESC')->take(6)->get();

        return view('index_report_air')->with('datas', $datas);
    }

    public function viewAll()
    {
        $datas = ReportAirByUser::orderBy('created_at', 'DESC')->get();

        return view('index_report_air')->with('datas', $datas);
    }

    public function show($id)
    {
        $data = ReportAirByUser::where('id', $id)->get()->first();

        return view('show_report_air')->with('data', $data);
    }





}
