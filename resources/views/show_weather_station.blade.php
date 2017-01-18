@extends('app_show')
<head>
    <style>
        #map {
            height: 400px;
        }
    </style>
</head>
@section('content')
    <br><br><br>
    <div id="map" style="width:600px; margin:0 auto;"></div>
    <script>
        function initMap() {
            var bkk = {lat: 13.7251097, lng: 100.3529027};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 5,
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
    <br>
                <section class='section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp'>
                    <div class='mdl-card mdl-cell mdl-cell--12-col'>
                        <div class='mdl-card__supporting-text'>
                            <h4>Hello</h4>
                        </div>
                        <div class='mdl-card__actions'>
                            <h5>World</h5>
                        </div>
                    </div>
                </section>

    <br><br><br>
    @stop