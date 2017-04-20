@extends('app_air_maps')

@section('content')


    <div class="container">
        <img src="data:image/jpeg;base64,{{ $air_picture->air_picture }}" class="centered" width="304" height="236">
    </div>


    @stop

