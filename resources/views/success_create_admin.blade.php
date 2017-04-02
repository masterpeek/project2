@extends('app_admin_index')
@section('content')
    <div class="alert alert-success fade in">
        <a href="{{ url('login_admin') }}" class="close" data-dismiss="alert">&times;</a>
        <strong>สมัครสมาชิกสำเร็จ!</strong> คุณได้ทำการสมัครสมาชิกสำเร็จเเล้ว.
    </div>
    @stop