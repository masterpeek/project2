@extends('app_show_noise')
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
                ['', {{ $data->noise_lat }}, {{ $data->noise_long }}, {{ $data->noise_value }},
                    "{{ $data->noise_area_name }}", "{{ $data->noise_province_name }}", "{{ $data->noise_thai_date }}"],
            ];

            for (i = 0; i < markers.length; i++) {
                var position = new google.maps.LatLng(markers[i][1], markers[i][2]);

                var value = markers[i][3];
                var area = markers[i][4];
                var province = markers[i][5];
                var date = markers[i][6];

                var content = "ความดังของเสียง: "+ value + " เดซิเบล" +
                    "<br>" + "พื้นที่: "+ area + " จ." + province +  "<br>" +
                    "วันที่: "+ date;

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
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5-kfTpPFWJkFxa5hazbi8ywhCwViGYuQ&callback=initMap">
    </script>
    <br>
    <section class="section--center mdl-grid mdl-grid--no-spacing">
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--4-col">
                <div class="demo-card-square mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-card--expand" style="background: red">
                        <h4> ความดังเสียง: {{ $data->noise_value }} เดซิเบล
                            &nbsp;วันที่: {{ $data->noise_thai_date }}
                        </h4>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <h5> พื้นที่: {{ $data->noise_area_name }} จ.{{ $data->noise_province_name }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br><br><br>
@stop