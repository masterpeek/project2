<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;
use Illuminate\Support\Facades\DB;
use App\ReportAirByUser;

class ReportAirByUserController extends Controller
{
    public function getReportAirByUser()
    {
        $json = Input::json()->all();

        $resultJson = GuzzleHttp\json_decode($json);

        $data['username'] = $resultJson->username;
        $data['password'] = $resultJson->password;
        $data['fname'] = $resultJson->fname;
        $data['lname'] = $resultJson->lname;
        $data['tel'] = $resultJson->tel;
        $data['email'] = $resultJson->email;

        $date_time = new Carbon();

        $data['user_level'] = 1;
        $data['created_at'] = $date_time->toDateTimeString();

        ReportAirByUser::create($data);

    }
}
