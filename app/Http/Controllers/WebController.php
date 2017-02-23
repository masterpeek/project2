<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WeatherStation;

class WebController extends Controller
{
    public function index()
    {
        $markers = WeatherStation::all();

        return view('index')->with('markers', $markers);

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
