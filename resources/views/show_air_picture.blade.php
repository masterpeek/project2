@extends('app_air_maps')
@section('content')


    <div class="container" style="border: 1px solid #000; height: 600px; width: 600px; line-height: 600px; *font-size: 600px; text-align: center;">
        <img src="data:image/jpeg;base64,{{ $air_picture->air_picture }}" class="img-rounded" width="304" height="236">
        <br>
        <a href="{{ url('report_air_maps') }}">ย้อนกลับ</a>
    </div>

    @stop
