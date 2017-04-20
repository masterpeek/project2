@extends('app_air_maps')

@section('content')
    <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
        <div class="mdl-grid">


    <div class="container" style="text-align: center">
        <img src="data:image/jpeg;base64,{{ $air_picture->air_picture }}" class="centered" width="400" height="200">
    </div>
        </div>
    </section>
    @stop

