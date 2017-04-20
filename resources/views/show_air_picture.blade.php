@extends('app_air_maps')

@section('content')

    <div class="container" style="text-align: center">
        <img src="data:image/jpeg;base64,{{ $air_picture->air_picture }}" class="centered" width="500" height="500">
    </div>

    @stop

