@extends('app_show_air')
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
                ['', {{ $data->air_lat }}, {{ $data->air_long }}, "{{ $data->air_smell }}",
                    "{{ $data->air_area_name }}", "{{ $data->created_at }}"],
            ];

            for (i = 0; i < markers.length; i++) {
                var position = new google.maps.LatLng(markers[i][1], markers[i][2]);

                var value = markers[i][3];
                var area = markers[i][4];
                var date = markers[i][5];

                var content = "ระดับมลพิษทางอากาศ: "+ value +
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
            }
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSolnKvQzksYqxOviOJrNTkRn7-voF9MA&callback=initMap">
    </script>
    <br>
    <section class="section--center mdl-grid mdl-grid--no-spacing">
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--4-col">
                <div class="demo-card-square mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title mdl-card--expand">
                        <h4> ระดับมลพิษทางอากาศ: {{ $data->air_smell }} &nbsp;วันที่: {{ $data->created_at }}  น.
                            <br>
                            ความคิดเห็น: {{ $data->air_comment }}</h4>

                    </div>
                    <div class="mdl-card__supporting-text">
                        <h5> พื้นที่: {{ $data->air_area_name }} </h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br><br><br>
@stop