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
        $data['password'] = md5($user['Password']);
        $data['confirm_password'] = md5($user['ConfirmPassword']);
        $data['fname'] = $user['Name'];
        $data['lname'] = $user['Lastname'];
        $data['tel'] = $user['Telephone'];
        $data['user_level'] = 1;


        $rule = array
        (
            'username' => 'required|unique:users|min:6|max:16',
            'password' => 'required|min:6|max:80',
            'confirm_password' => 'min:6|max:80|same:password',
            'fname' => 'required',
            'lname' => 'required',
            'tel' => 'required|min:10|max:10'
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
        $password = md5($user["Password"]);

        $data = User::where('username', '=', $username)->get()->first();


        if($data != null)
        {
            if($data->password == $password)
            {
                $result = $result.$data->id.";".$data->username.";".$data->fname.";".$data->lname.";".$data->tel;

                return $result;
            }
            else
            {
                return "incorrect password";
            }
        }
        else
        {
            return "incorrect username";
        }
    }

    public function allUser()
    {
        $users = User::all();

        return $users;
    }
}
