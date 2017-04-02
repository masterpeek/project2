<?php

namespace App\Http\Controllers;

use App\User;
use App\WeatherStation;
use App\AutoReportNoiseByUser;
use App\ReportAirByUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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

    public function editUser($id)
    {
        $user = User::where('id', $id)->get()->first();

        return view('index_admin_edit')->with('user', $user);
    }

    public function updateUser(Request $request)
    {
        $user = $request->all();

        $data = [];

        $data['username'] = $user['username'];
        $data['password'] = $user['password'];
        $data['confirm_password'] = $user['confirm_password'];
        $data['fname'] = $user['name'];
        $data['lname'] = $user['lastname'];
        $data['tel'] = $user['telephone'];

        $rule = array
        (
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
            User::where('username', $data['username'])
                ->update(['username' => $data['username'],
                'password' => $data['password'], 'confirm_password' => $data['confirm_password'],
                'fname' => $data['fname'], 'lname' => $data['lname'], 'tel' => $data['tel']]);

            return redirect()->action('AdminController@indexAdmin');
        }

    }

    public function deleteUser($id)
    {
        User::where('id', $id)->delete();

        return redirect()->route('index_admin');
    }

    public function searchUser()
    {
        $input = Input::all();

        $users = User::where('username', $input['username'])->get();

        return view('index_admin')->with('users', $users);

    }

    public function searchConditionUser()
    {
        $input = Input::all();

        $condition = $input["condition"];

        if($condition === "ทั้งหมด")
        {
            $users = User::all();
        }
        else
        {
            $users = User::where('user_level', intval($condition))->get();
        }

        return view('index_admin')->with('users', $users);

    }

    public function indexWeatherStation()
    {
        $datas = WeatherStation::all();

        return view('/index_admin_ws')->with('datas', $datas);

    }

    public function searchWeatherStation()
    {
        $input = Input::all();

        $datas = WeatherStation::where('province_name', $input['province'])->get();

        return view('index_admin_ws')->with('datas', $datas);

    }

    public function searchConditionWeatherStation()
    {
        $input = Input::all();

        $condition = $input["condition"];

        if($condition === "ทั้งหมด")
        {
            $datas = WeatherStation::all();
        }
        else
        {
            $datas = WeatherStation::where('aqi_condition_name', $condition)->get();
        }

        return view('index_admin_ws')->with('datas', $datas);
    }

    public function deleteWeatherStation($id)
    {
        WeatherStation::where('station_id', $id)->delete();

        return redirect()->route('index_admin_ws');
    }

    public function indexNoise()
    {
        $datas = AutoReportNoiseByUser::all();

        return view('/index_admin_noise')->with('datas', $datas);

    }

    public function searchNoise()
    {
        $input = Input::all();

        $datas = AutoReportNoiseByUser::where('noise_province_name', $input['province'])->get();

        return view('index_admin_noise')->with('datas', $datas);

    }

    public function deleteNoise($id)
    {
        AutoReportNoiseByUser::where('id', $id)->delete();

        return redirect()->route('index_admin_noise');
    }

    public function indexAir()
    {
        $datas = ReportAirByUser::all();

        return view('/index_admin_air')->with('datas', $datas);

    }

    public function searchAir()
    {
        $input = Input::all();

        $datas = ReportAirByUser::where('air_province_name', $input['province'])->get();

        return view('index_admin_air')->with('datas', $datas);

    }

    public function searchConditionAir()
    {
        $input = Input::all();

        $condition = $input["condition"];

        if($condition === "ทั้งหมด")
        {
            $datas = ReportAirByUser::all();
        }
        else
        {
            $datas = ReportAirByUser::where('air_pollution', $condition)->get();
        }

        return view('index_admin_air')->with('datas', $datas);
    }

    public function deleteAir($id)
    {
        ReportAirByUser::where('id', $id)->delete();

        return redirect()->route('index_admin_air');
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

                Session::put('username_admin', $data->username);

                return redirect()->route('index_admin');
            }
            else
            {
                return "incorrect password";
            }
        }

    }

    public function destroySession()
    {
        Session::flush();

        return redirect()->route('login_admin');

    }


}
