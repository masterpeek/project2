<?php

namespace App\Http\Controllers;

use App\AutoReportNoiseByUser;
use Illuminate\Http\Request;
use GuzzleHttp;

class AutoReportNoiseByUserController extends Controller
{
    public function getNoise(Request $request)
    {
        $noise = $request->all();

        $lat = $noise['Latitude'];
        $long = $noise['Longitude'];

        $latitude = doubleval($noise['Latitude']);
        $longitude = doubleval($noise['Longitude']);

        $data = [];
        $data['noise_value'] = $noise['NoiseValue'];
        $data['noise_lat'] = $latitude;
        $data['noise_long'] = $longitude;

        $client = new GuzzleHttp\Client();

        $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$long.'&key=AIzaSyBuNhJ7nKSLGV63AaNIls6M41Xu3kgK8Ss');
        $store = $res->getBody()->getContents();
        $ans = GuzzleHttp\json_decode($store);

        $noise_area_name =  $ans->results[0]->address_components[3]->short_name;
        $noise_province_name = $ans->results[0]->address_components[4]->short_name;

        //$ans->results->address_components->short_name[3];
        $data['noise_area_name'] = $noise_area_name;
        //$ans->results->address_components->short_name[4];
        $data['noise_province_name'] = $noise_province_name;

            AutoReportNoiseByUser::create($data);

    }

    public function showNoise()
    {
        $all_noise = AutoReportNoiseByUser::all();

        return $all_noise;
    }
}
