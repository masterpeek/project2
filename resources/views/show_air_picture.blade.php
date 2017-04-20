@extends('app_air_maps')

@section('content')
    <br>
    <div class="form-group" style="text-align:center">
        <img src="data:image/jpeg;base64,{{ $air_picture->air_picture }}" class="centered" width="500" height="500">
    </div>
    <br>
    <div class="form-group" style="text-align:center">
    <a href="{{ url('show_report_air') }}" class="btn btn-primary" role="button">กลับสู่หน้าแผนที่</a>
    </div>
    @stop

