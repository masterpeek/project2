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

        $latitude = doubleval($noise['Latitude']);
        $longitude = doubleval($noise['Longitude']);

        $data = [];
        $data['noise_value'] = $noise['NoiseValue'];
        $data['lat'] = $latitude;
        $data['long'] = $longitude;

        $client = new GuzzleHttp\Client();

        $res = $client->request('GET', '
        https://maps.googleapis.com/maps/api/geocode/json?latlng='.$latitude.','.$longitude.'&key=AIzaSyBuNhJ7nKSLGV63AaNIls6M41Xu3kgK8Ss');
        $store = $res->getBody()->getContents();
        $ans = GuzzleHttp\json_decode($store);

        $data['noise_area_name'] = $ans->results->address_components->short_name[3];
        $data['noise_province_name'] = $ans->results->address_components->short_name[4];

        AutoReportNoiseByUser::create($data);

    }

    public function showNoise()
    {
        $all_noise = AutoReportNoiseByUser::all();

        return $all_noise;
    }
}
