@extends('app_maps')
@section('content')
        <!DOCTYPE html>
<html>
<head>
    <style>
        #map {
            height: 500px;
            width: 60%;
        }
    </style>
</head>
<body>
<br><br><br>
<div id="map" style="width:800px; margin:0 auto;"></div>
<script>
    function initMap() {
        var bkk = {lat: 13.7251097, lng: 100.3529027};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            center: bkk
        });

        function addInfoWindow(marker, message) {

            var infoWindow = new google.maps.InfoWindow({
                content: message
            });

            google.maps.event.addListener(marker, 'click', function () {
                infoWindow.open(map, marker);
            });
        }

        //All Data
        var datas = [
            @foreach($markers as $marker)
            [{{ $marker->aqi_value }}, {{ $marker->area_name }},
                {{ $marker->date }}, {{ $marker->time }}],
        ];

        // Multiple Markers
        var markers = [
                @foreach($markers as $marker)
            ['', {{ $marker->lat }}, {{ $marker->long }}],
            @endforeach
        ];

        for (i = 0; i < markers.length; i++) {
            var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
            marker = new google.maps.Marker({
                position: position,
                map: map,
                title: markers[i][0]
            });

            addInfoWindow(marker, datas[i][1]);

            //var marker = new google.maps.Marker({
            //  position: ,
            //map: map
            //});

        }
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSolnKvQzksYqxOviOJrNTkRn7-voF9MA&callback=initMap">
</script>
<br><br><br>
</body>
</html>
@stop