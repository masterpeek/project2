@extends('app_air_maps')
@section('content')


    <div class="container" style="display: block;margin-left: auto;margin-right: auto">
        <img src="data:image/jpeg;base64,{{ $air_picture->air_picture }}" class="img-rounded" width="304" height="236">
    </div>


    @stop
