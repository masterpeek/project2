<?php

namespace App\Http\Controllers;

use App\AutoReportNoiseByUser;
use Illuminate\Http\Request;
use GuzzleHttp;
use Illuminate\Support\Facades\DB;

class AutoReportNoiseByUserController extends Controller
{
    public function getNoise(Request $request)
    {
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

        $noise_area_name =  $ans->results[0]->formatted_address;
        $noise_province_name = $ans->results[0]->address_components[4]->short_name;


        //$ans->results->address_components->short_name[3];
        $data['noise_area_name'] = $noise_area_name;
        //$ans->results->address_components->short_name[4];
        $data['noise_province_name'] = $noise_province_name;
        $data['user_id'] = intval($noise['UserId']);

            AutoReportNoiseByUser::create($data);

    }

    public function reportNoiseNearBy(Request $request)
    {

        $ans = "";

        $data = $request->all();

        $lat = $data["Latitude"];
        $lng = $data["Longitude"];
        $distance = $data["Distance"];

        $result = DB::select('auto_report_noise_by_user.noise_value, 
        auto_report_noise_by_user.noise_area_name, auto_report_noise_by_user.noise_province_name,  
        auto_report_noise_by_user.noise_lat, auto_report_noise_by_user.noise_long, 
        (6371 * acos(cos(radians(' . $lat . ')) * cos(radians(auto_report_noise_by_user.noise_lat)) 
        * cos(radians(auto_report_noise_by_user.noise_long ) - radians(' . $lng . ')) 
        + sin(radians(' . $lat .')) * sin(radians(auto_report_noise_by_user.noise_lat)))) as distance
        from auto_report_noise_by_user having distance < '. $distance .' order by distance limit 1');

        if($result != null)
        {
            $ans = $ans.$result[0]->noise_value.";".$result[0]->area_name.";".$result[0]->province_name;

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

    public function maps()
    {
        $markers = AutoReportNoiseByUser::all();

        return view('report_noise_maps')->with('markers', $markers);
    }

    public function index()
    {
        $datas = AutoReportNoiseByUser::orderBy('created_at', 'DESC')->take(6)->get();

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



}
