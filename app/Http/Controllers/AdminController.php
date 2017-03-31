<?php

namespace App\Http\Controllers;

use App\User;
use App\WeatherStation;
use App\AutoReportNoiseByUser;
use App\ReportAirByUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;

class AdminController extends Controller
{
    public function index()
    {
        return view('/login_admin');
    }

    public function create()
    {
        return view('/create_form_admin');
    }

    public function indexAdmin()
    {
        $users = User::all();

        return view('/index_admin')->with('users', $users);

    }

    public function indexWeatherStation()
    {
        $datas = WeatherStation::all();

        return view('/index_admin_ws')->with('datas', $datas);

    }

    public function indexNoise()
    {
        $datas = AutoReportNoiseByUser::all();

        return view('/index_admin_noise')->with('datas', $datas);

    }

    public function indexAir()
    {
        $datas = ReportAirByUser::all();

        return view('/index_admin_air')->with('datas', $datas);

    }

    public function createAdmin(Request $request)
    {
        $admin = $request->all();

        $data = [];

        $data['username'] = $admin['username'];
        $data['password'] = md5($admin['password']);
        $data['confirm_password'] = md5($admin['confirm_password']);
        $data['fname'] = $admin['name'];
        $data['lname'] = $admin['lastname'];
        $data['tel'] = $admin['telephone'];
        $data['user_level'] = 2;


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

    public function loginAdmin(Request $request)
    {
        $result = "";

        $user = $request->all();

        $username = $user["username"];
        $password = md5($user["password"]);

        $data = User::where('username', '=', $username)->get()->first();


        if($data != null)
        {
            if($data->password == $password)
            {
                $result = $result.$data->id.";".$data->username.";".$data->fname.";".$data->lname.";".$data->tel;

                return redirect()->route('index_admin');
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

    public function updateUser($id)
    {

    }

    public function deleteUser($id)
    {
        $users = User::where('id', $id)->delete();

        return redirect()->route('index_admin');
    }

    public function showUser()
    {
        $users = User::all();
    }

}
