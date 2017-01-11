<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;
use Illuminate\Support\Facades\DB;
use App\ReportAirByUser;

class ReportAirByUserController extends Controller
{
    public function getReportAirByUser(Request $request)
    {
        $air = $request->all();

        $latitude = doubleval($air['Latitude']);
        $longitude = doubleval($air['Longitude']);

        $data = [];
        $data['air_level'] = $air['SmellChoice'];
        $data['noise_condition_name'] = "good";
        $data['lat'] = $latitude;
        $data['long'] = $longitude;
        $data['noise_area_name'] = "pinklao";
        $data['noise_province_name'] = "bkk";

        ReportAirByUser::create($data);

    }
}
