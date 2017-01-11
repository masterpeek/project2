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

        $lat = $air['Latitude'];
        $long = $air['Longitude'];

        $latitude = doubleval($air['Latitude']);
        $longitude = doubleval($air['Longitude']);

        $client = new GuzzleHttp\Client();

        $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$long.'&key=AIzaSyBuNhJ7nKSLGV63AaNIls6M41Xu3kgK8Ss');
        $store = $res->getBody()->getContents();
        $ans = GuzzleHttp\json_decode($store);

        $air_area_name =  $ans->results[0]->address_components[3]->short_name;
        $air_province_name = $ans->results[0]->address_components[4]->short_name;

        $data = [];
        $data['air_level'] = $air['SmellChoice'];
        $data['noise_condition_name'] = "good";
        $data['lat'] = $latitude;
        $data['long'] = $longitude;
        $data['air_area_name'] = $air_area_name;
        $data['air_province_name'] = $air_province_name;

        ReportAirByUser::create($data);

    }

    public function showAir()
    {
        $all_air = ReportAirByUser::all();

        return $all_air;
    }
}
