<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Validator;

class AdminController extends Controller
{
    public function index()
    {
        return view('/login_admin');
    }

    public function create()
    {
        return view('/create_admin');
    }

    public function createAdmin(Request $request)
    {
        $admin = $request->all();

        $data = [];

        $data['username'] = $admin['Username'];
        $data['password'] = md5($admin['Password']);
        $data['confirm_password'] = md5($admin['ConfirmPassword']);
        $data['fname'] = $admin['Name'];
        $data['lname'] = $admin['Lastname'];
        $data['tel'] = $admin['Telephone'];
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

    public function updateUser($id)
    {

    }

    public function deleteUser($id)
    {
        User::where('id', $id)->delete();
    }

    public function showUser()
    {
        $users = User::all();
    }

}
