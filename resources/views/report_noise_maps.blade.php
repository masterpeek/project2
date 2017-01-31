@extends('app_noise_maps')
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
            ['', {{ $marker->noise_lat }}, {{ $marker->noise_long }}, {{ $marker->noise_value }},
                "{{ $marker->noise_area_name }}", "{{ $marker->noise_thai_date }}" ],
            @endforeach
        ];

        for (i = 0; i < markers.length; i++) {
            var position = new google.maps.LatLng(markers[i][1], markers[i][2]);

            var value = markers[i][3];
            var area = markers[i][4];
            var date = markers[i][5];

            var content = "ความดังของเสียง: "+ value + " เดซิเบล" +
                "<br>" + "พื้นที่: "+ area + "<br>" +
                "วันที่: "+ date + " น.";

            var infowindow = new google.maps.InfoWindow({
                content: content
            });

            marker = new google.maps.Marker({
                position: position,
                map: map,
                title: content
            });

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