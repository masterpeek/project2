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

            AutoReportNoiseByUser::create($data);

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

    public function maps()
    {
        $markers = AutoReportNoiseByUser::all();

        return view('report_noise_maps')->with('markers', $markers);
    }

    public function index()
    {
        $datas = AutoReportNoiseByUser::orderBy('created_at', 'DESC')->take(6);

        return view('index_report_noise')->with('datas', $datas);
    }

    public function viewAll()
    {
        $datas = AutoReportNoiseByUser::orderBy('created_at', 'DESC');

        return view('index_report_noise')->with('datas', $datas);
    }

    public function show($id)
    {
        $data = AutoReportNoiseByUser::where('id', $id)->get()->first();

        return view('show_report_noise')->with('data', $data);
    }



}
