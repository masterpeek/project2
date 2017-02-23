<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WeatherStation;
use App\ReportAirByUser;
use App\AutoReportNoiseByUser;

class WebController extends Controller
{
    public function index()
    {
        $markers = WeatherStation::all();
        $noises = AutoReportNoiseByUser::all();
        $airs = ReportAirByUser::all();

        return view('index')->with('markers', $markers)->with('noises', $noises)->with('airs', $airs);
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

}
