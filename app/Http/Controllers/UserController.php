<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use GuzzleHttp;
use Illuminate\Support\Facades\DB;
use App\User;

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
        $data['password'] = password_hash($user['Password'], PASSWORD_DEFAULT);
        $data['fname'] = $user['Name'];
        $data['lname'] = $user['Lastname'];
        $data['tel'] = $user['Telephone'];
        $data['email'] = $user['Email'];
        $data['user_level'] = 1;


        $rule = array
        (
            'username' => 'required|unique:users',
            'password' => 'required|min:5|Max:80',
            'fname' => 'required|min:5|Max:80',
            'lname' => 'required|min:5|Max:80',
            'tel' => 'required',
            'email' => 'required|email|unique:users'
        );

        $validator = Validator::make($data, $rule);

        if($validator->fails())
        {
            return "fail";
        }
        else
        {
            User::create($data);

            return "success";
        }

    }


    public function login(Request $request)
    {
        $result = "";

        $user = $request->all();

        $username = $user["Username"];
        $password = $user["Password"];

        $data = User::where('username', '=', $username)->get()->first();


        if($data != null)
        {
            if(password_verify($password, $data->password))
            {
                $result = $result.$data->id.";".$data->username.";".$data->fname.";".$data->lname.";".$data->email;

                return $result;
            }
            else
            {
                return "0";
            }
        }
        else
        {
            return "1";
        }
    }

    public function allUser()
    {
        $users = User::all();

        return $users;
    }
}
