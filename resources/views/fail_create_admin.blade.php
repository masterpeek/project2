@extends('app_admin_index')
@section('content')
    <div class="alert alert-danger fade in">
        <a href="{{ url('login_admin') }}" class="close" data-dismiss="alert">&times;</a>
        <strong>สมัครสมาชิกล้มเหลว!</strong> คุณได้ทำการสมัครสมาชิกล้มเหลว.
    </div>
@stop