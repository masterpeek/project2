@extends('app_air_maps')

@section('content')
    <br>
    <div class="form-group" style="text-align:center">
        <img src="data:image/jpeg;base64,{{ $air_picture->air_picture }}" class="centered" width="350" height="350">
    </div>
    <br>
    <div class="form-group" style="text-align:center">
    <a href="{{ url('report_air_maps') }}" class="btn btn-primary" role="button">กลับสู่หน้าแผนที่</a>
    </div>
    @stop

