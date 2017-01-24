<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;
use Illuminate\Support\Facades\DB;
use App\ReportAirByUser;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

class ReportAirByUserController extends Controller
{
    public function getAir(Request $request)
    {
        $air = $request->all();

        $latitude = doubleval($air['Latitude']);
        $longitude = doubleval($air['Longitude']);

        $pollution_choice = 0;

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

        $data = [];
        $data['air_smell'] = $air['SmellChoice'];
        $data['air_pollution'] = $pollution_choice;
        $data['air_comment'] = $air['Detail'];
        $data['air_lat'] = $latitude;
        $data['air_long'] = $longitude;
        $data['air_area_name'] = $air_area_name;
        $data['air_province_name'] = $air_province_name;
        $data['user_id'] = intval($air['UserId']);

        ReportAirByUser::create($data);

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
