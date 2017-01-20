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

        // Multiple Markers
        var markers = [
                @foreach($markers as $marker)
            ['', {{ $marker->lat }}, {{ $marker->long }}, {{ $marker->aqi_value }}],
            @endforeach
        ];


        for (i = 0; i < markers.length; i++) {
            var position = new google.maps.LatLng(markers[i][1], markers[i][2]);

            var aqi = markers[i][3];

            var content = "AQI: "+ aqi;

            var infowindow = new google.maps.InfoWindow({
                content: content
            });
            marker = new google.maps.Marker({
                position: position,
                map: map,
                title: content
            });

            if(aqi >= 0 && aqi <= 50)
            {
                marker.setIcon('http://maps.google.com/mapfiles/ms/icons/blue-dot.png');

            }
            else if(aqi >= 51 && aqi <= 100)
            {
                marker.setIcon('http://maps.google.com/mapfiles/ms/icons/green-dot.png');
            }
            else if(aqi >= 101 && aqi <= 200)
            {
                marker.setIcon('http://maps.google.com/mapfiles/ms/icons/yellow-dot.png');
            }
            else if(aqi >= 201 && aqi <= 300)
            {
                marker.setIcon('http://maps.google.com/mapfiles/ms/icons/orange-dot.png');
            }
            else if(aqi > 300)
            {
                marker.setIcon('http://maps.google.com/mapfiles/ms/icons/red-dot.png');
            }


            google.maps.event.addListener(marker, 'click', function() {
                infowindow.setContent(this.title);
                infowindow.open(map, this);
            });
        }
    }
    google.maps.event.addDomListener(window, 'load', initMap);
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSolnKvQzksYqxOviOJrNTkRn7-voF9MA&callback=initMap">
</script>
<br><br><br>
</body>
</html>
@stop