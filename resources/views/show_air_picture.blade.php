@extends('app_air_maps')

@section('content')

    <div class="container" style="text-align: center">
        <img src="data:image/jpeg;base64,{{ $air_picture->air_picture }}" class="centered" width="600" height="600">
    </div>

    @stop

