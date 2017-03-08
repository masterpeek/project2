<?php

namespace App\Http\Controllers;

use App\AutoReportNoiseByUser;
use Illuminate\Http\Request;
use GuzzleHttp;
use Illuminate\Support\Facades\DB;
use Stichoza\GoogleTranslate\TranslateClient;
use Illuminate\Support\Facades\Input;

class AutoReportNoiseByUserController extends Controller
{
    public function getNoise(Request $request)
    {
        $tr = new TranslateClient();

        $noise = $request->all();

        $latitude = doubleval($noise['Latitude']);
        $longitude = doubleval($noise['Longitude']);

        $lat = $noise['Latitude'];
        $long = $noise['Longitude'];

        $data = [];
        $data['noise_value'] = $noise['NoiseValue'];
        $data['noise_lat'] = $latitude;
        $data['noise_long'] = $longitude;

        $client = new GuzzleHttp\Client();

        $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$long.'&key=AIzaSyBuNhJ7nKSLGV63AaNIls6M41Xu3kgK8Ss');
        $store = $res->getBody()->getContents();
        $ans = GuzzleHttp\json_decode($store);

        $noise_area_name =  explode(",", $ans->results[0]->formatted_address);

        $noise_province_name = explode(",",$ans->results[0]->formatted_address);

        $check = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "Chang Wat", "มหานคร", "ฯ", "จ.");

        $noise_province_name1 = str_replace($check,"",$noise_province_name[3]);

        $area1 = $tr->setSource('en')->setTarget('th')->translate($noise_area_name[1]);
        $area2 = $tr->setSource('en')->setTarget('th')->translate($noise_area_name[2]);

        $province = $tr->setSource('en')->setTarget('th')->translate($noise_province_name1);

        $check2 = array("มหานคร", "ฯ", "จ.");

        $province1 = str_replace($check2,"",$province);

        $check3 = array("ตำบล");

        $area1_1 = str_replace($check3, "ต.", $area1);

        $check4 = array("อำเภอ");

        $area2_2 = str_replace($check4, "อ.", $area2);

        $data['noise_area_name'] = $area1_1." ".$area2_2;

        //$data['noise_province_name'] = $tr->setSource('en')->setTarget('th')->translate($noise_province_name);

        $data['noise_province_name'] = $province1;

        $date = time();
        $data['noise_thai_date'] = $this->thai_date_and_time($date);


        AutoReportNoiseByUser::create($data);

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


    public function reportNoiseNearBy(Request $request)
    {

        $ans = "";

        $data = $request->all();

        $lat = $data["Latitude"];
        $lng = $data["Longitude"];
        $distance = $data["Distance"];

        $result = DB::select('select auto_report_noise_by_user.noise_value, 
        auto_report_noise_by_user.noise_area_name, auto_report_noise_by_user.noise_province_name,  
        auto_report_noise_by_user.noise_lat, auto_report_noise_by_user.noise_long, 
        (6371 * acos(cos(radians(' . $lat . ')) * cos(radians(auto_report_noise_by_user.noise_lat)) 
        * cos(radians(auto_report_noise_by_user.noise_long ) - radians(' . $lng . ')) 
        + sin(radians(' . $lat .')) * sin(radians(auto_report_noise_by_user.noise_lat)))) as distance
        from auto_report_noise_by_user having distance <= '. $distance .' order by distance limit 1');

        if($result != null)
        {
            $ans = $ans.$result[0]->noise_value.";".$result[0]->noise_area_name.";".$result[0]->noise_province_name;

            return $ans;
        }
        else
        {
            return "no result";
        }


    }

    public function showNoise()
    {
        $arrNoise["arrNoise"] = [];

        $all_noises = AutoReportNoiseByUser::all();

        foreach ($all_noises as $all_noise){
            array_push($arrNoise["arrNoise"], $all_noise);
        }

        return $arrNoise;
    }

    public function deleteNoise()
    {
        $query = "TRUNCATE TABLE auto_report_noise_by_user";

        AutoReportNoiseByUser::getQuery($query)->delete();

    }

    public function deleteNoiseMarker(Request $request)
    {
        $data = $request->all();

        $id = $data["Id"];

        AutoReportNoiseByUser::where('id', $id)->delete();
    }

    public function maps()
    {
        $markers = AutoReportNoiseByUser::all();

        return view('report_noise_maps')->with('markers', $markers);
    }

    public function index()
    {
        $datas = AutoReportNoiseByUser::orderBy('created_at', 'DESC')->take(8)->get();

        return view('index_report_noise')->with('datas', $datas);
    }

    public function viewAll()
    {
        $datas = AutoReportNoiseByUser::orderBy('created_at', 'DESC')->get();

        return view('index_report_noise')->with('datas', $datas);
    }

    public function show($id)
    {
        $data = AutoReportNoiseByUser::where('id', $id)->get()->first();

        return view('show_report_noise')->with('data', $data);
    }

    public function search()
    {
        $input = Input::all();

        $datas = AutoReportNoiseByUser::where('noise_province_name', $input['province'])
            ->orderBy('created_at', 'DESC')->get();

        return view('index_report_noise')->with('datas', $datas);

    }

    public function updateNoise(Request $request)
    {
        $data = $request->all();

        $id = $data["ID"];

        $choice = $data["Choice"];

        if($choice == 0)
        {
            AutoReportNoiseByUser::where('id', $id)->delete();
        }
    }


}
