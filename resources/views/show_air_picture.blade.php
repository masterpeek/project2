@extends('app_air_maps')
@section('content')


    <div class="container">
        <img src="data:image/jpeg;base64,{{ $air_picture->air_picture }}" class="img-rounded" width="304" height="236">

        <a href="{{ url('report_air_maps') }}">ย้อนกลับ</a>
        
    </div>

    @stop
