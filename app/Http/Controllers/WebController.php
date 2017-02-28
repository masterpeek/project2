<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WeatherStation;
use App\ReportAirByUser;
use App\AutoReportNoiseByUser;
use Illuminate\Support\Facades\Input;

class WebController extends Controller
{
    public function index()
    {
        $markers = WeatherStation::all();
        $noises = AutoReportNoiseByUser::all();
        $airs = ReportAirByUser::all();

        return view('index')->with('markers', $markers)->with('noises', $noises)->with('airs', $airs);
    }

    public function select_condition_all()
    {
        $input = Input::all();

        $condition = $input["condition"];

        if($condition == "ทั้งหมด")
        {
            $markers = WeatherStation::all();
            $noises = AutoReportNoiseByUser::all();
            $airs = ReportAirByUser::all();

            return view('index')->with('markers', $markers)->with('noises', $noises)->with('airs', $airs);
        }
        else if($condition == "สถานีวัดคุณภาพอากาศ")
        {
            $markers = WeatherStation::all();
            $noises = AutoReportNoiseByUser::where('noise_value', $condition)->get();
            $airs = ReportAirByUser::where('air_pollution', $condition)->get();

            return view('index')->with('markers', $markers)->with('noises', $noises)->with('airs', $airs);
        }
        else if($condition == "รายงานมลพิษทางเสียง")
        {
            $noises = AutoReportNoiseByUser::all();
            $markers = WeatherStation::where('id', $condition)->get();
            $airs = ReportAirByUser::where('air_pollution', $condition)->get();

            return view('index')->with('markers', $markers)->with('noises', $noises)->with('airs', $airs);
        }
        else if($condition == "รายงานมลพิษทางอากาศ")
        {
            $airs = ReportAirByUser::all();
            $markers = WeatherStation::where('id', $condition)->get();
            $noises = AutoReportNoiseByUser::where('noise_value', $condition)->get();

            return view('index')->with('markers', $markers)->with('noises', $noises)->with('airs', $airs);
        }

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
