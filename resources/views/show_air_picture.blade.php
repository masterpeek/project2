@extends('app_air_maps')
@section('content')


    <div class="container" style="height: 600px; width: 600px; line-height: 600px; *font-size: 600px; text-align: center;">
        <img src="data:image/jpeg;base64,{{ $air_picture->air_picture }}" class="img-rounded" width="304" height="236">
    </div>


    @stop
