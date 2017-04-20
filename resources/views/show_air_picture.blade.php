@extends('app_air_maps')

@section('content')
    <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
        <div class="mdl-grid">


    <div class="container" style="align-content: center">
        <img src="data:image/jpeg;base64,{{ $air_picture->air_picture }}" class="centered" width="800" height="600">
    </div>
        </div>
    </section>
    @stop

