<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function addUser(Request $request)
    {

       $input = $request->all();

       $username = $input['username'];
       $password = $input['password'];
       $fname = $input['fname'];
       $lname = $input['lname'];
       $tel = $input['tel'];
       $email = $input['email'];

       $date_time = new Carbon();

       DB::table('users')->insert([
           ['username' => $username, 'password' => $password,
           'fname' => $fname, 'lname' => $lname, 'tel' => $tel,
               'email' => $email, 'user_level' => 1,
               'created_at' => $date_time->toDateTimeString()]
       ]);

    }

    public function deleteUser($username, $password)
    {
        DB:table('users')->where('password', '=', $password, 'and',
        'password', '=', $password)->delete();
    }
}
