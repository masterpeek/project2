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

        $data['username'] = $user['Username'];
        $data['password'] = $user['Password'];
        $data['fname'] = $user['Name'];
        $data['lname'] = $user['Lastname'];
        $data['tel'] = $user['Telephone'];

        $user = User::create($data);

        return $user;

    }

    public function allUser()
    {
        $users = User::all();

        return $users;
    }
}
