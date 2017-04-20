@extends('app_air_maps')
@section('content')

    <img src="data:image/jpeg;base64,{{ $air_picture->air_picture }}" />

    @stop
