@extends('app_air_maps')

@section('content')
    <br>
    <div class="form-group" style="text-align:center">
        <img src="data:image/jpeg;base64,{{ $air_picture->air_picture }}" class="centered" width="450" height="450">
    </div>
    <br>
    <div class="form-group" style="text-align:center">
    <a href="{{ url('index_report_air') }}" class="btn btn-primary" role="button">กลับสู่หน้ารายงานมลพิษทางอากาศ</a>
    </div>
    @stop

