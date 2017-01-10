<?php

namespace App\Http\Controllers;

use App\AutoReportNoiseByUser;
use Illuminate\Http\Request;

class AutoReportNoiseByUserController extends Controller
{
    public function getNoise(Request $request)
    {
        $noise = $request->all();

        $latitude = $noise['Latitude'];
        $longitude = $noise['Longitude'];

        $data = [];
        $data['noise_value'] = 10;
        $data['noise_condition_name'] = "good";
        $data['lat'] = $latitude;
        $data['long'] = $longitude;
        $data['noise_area_name'] = "pinklao";
        $data['noise_province_name'] = "bkk";

        AutoReportNoiseByUser::create($data);

    }

    public function showNoise()
    {
        $all_noise = AutoReportNoiseByUser::all();

        return $all_noise;
    }
}
