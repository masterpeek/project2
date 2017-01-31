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
                ['', {{ $data->lat }}, {{ $data->long }}, {{ $data->aqi_value }},
                    "{{ $data->aqi_condition_name }}", "{{ $data->station_name }}",
                    "{{ $data->area_name }}", "{{ $data->thai_date }}", "{{ $data->time }}"],
            ];

            for (i = 0; i < markers.length; i++) {
                var position = new google.maps.LatLng(markers[i][1], markers[i][2]);

                var aqi = markers[i][3];
                var aqi_condition = markers[i][4];
                var station = markers[i][5];
                var area = markers[i][6];
                var date = markers[i][7];
                var time = markers[i][8];


                var content = "ค่า​AQI: "+ aqi + " " + "ระดับคุณภาพอากาศ: " + aqi_condition +
                    "<br>" + "ชื่อ: "+ station + "<br>" + "พื้นที่: "+ area +
                    "<br>" + "วันที่: "+ date + " " + "เวลา: " + time +" น.";

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
    <br>
    <section class="section--center mdl-grid mdl-grid--no-spacing">
        <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--4-col">
                    <div class="demo-card-square mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title mdl-card--expand">
                            <h4> AQI: {{ $data->aqi_value }} &nbsp;
                                คุณภาพอากาศ: {{ $data->aqi_condition_name }}
                                &nbsp;วันที่: {{ $data->date }}&nbsp;เวลา: {{ $data->time }}  น.</h4>
                        </div>
                        <div class="mdl-card__supporting-text">
                            <h5> พื้นที่: {{ $data->area_name }} </h5>
                        </div>
                    </div>
                </div>
        </div>
    </section>
    <br><br><br>
    @stop