@extends('app')
<head>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="$$hosted_libs_prefix$$/$$version$$/material.deep_purple-pink.min.css">
        <link rel="stylesheet" href="styles.css">

    <style>
        #map {
            height: 200px;
            width: 40%;
        }
    </style>
</head>
@section('content')
    <br><br><br>
    <div id="map" style="width:800px; margin:0 auto;"></div>
    <script>
        function initMap() {
            var bkk = {lat: 13.7251097, lng: 100.3529027};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 6,
                center: bkk
            });

            // Multiple Markers
            var markers = [
                ['', {{ $data->lat }}, {{ $data->long }} ],
            ];

            for (i = 0; i < markers.length; i++) {
                var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
                marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: markers[i][0]
                });
            }
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSolnKvQzksYqxOviOJrNTkRn7-voF9MA&callback=initMap">
    </script>
    <br><br><br>
    <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
        <div class="mdl-card mdl-cell mdl-cell--12-col">
            <div class="mdl-card__supporting-text">
                <h4>{{ $data->aqi_value }}</h4>
               {{ $data->aqi_condition_name }}
            </div>
            <div class="mdl-card__actions">
                <div class="mdl-button">{{ $data->area_name }}
                </div>
            </div>
        </div>
    </section>
    @stop