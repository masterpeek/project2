<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;
use Illuminate\Support\Facades\DB;
use App\User;
use Log;

class UserController extends Controller
{
    public function create()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $user = $request->all();

        $data = [];

        $data['username'] = $request['Username'];
        $data['password'] = $request['Password'];
        $data['fname'] = $request['Name'];
        $data['lname'] = $request['Lastname'];
        $data['tel'] = $request['Telephone'];

        $user = User::create($data);

        return $user;


        /*
        $json = $request->all();

        $data['username'] = $json['Username'];
        $data['password'] = $json['Password'];
        $data['fname'] = $json['Name'];
        $data['lname'] = $json['Lastname'];
        $data['tel'] = $json['Telephone'];
        $data['email'] = $json['Email'];
        $data['user_level'] = 1;

        /*$resultJson = GuzzleHttp\json_decode($json);

        $data['username'] = $resultJson->Username;
        $data['password'] = $resultJson->Password;
        $data['fname'] = $resultJson->Name;
        $data['lname'] = $resultJson->Lastname;
        $data['tel'] = $resultJson->Telephone;
        $data['email'] = $resultJson->Email;

        $date_time = new Carbon();


        $data['created_at'] = $date_time->toDateTimeString();*/

    }

    public function allUser()
    {
        $users = User::all();

        return $users;
    }
}
