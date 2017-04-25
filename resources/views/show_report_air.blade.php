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
                ['', {{ $data->air_lat }}, {{ $data->air_long }}, "{{ $data->air_pollution }}",
                    "{{ $data->air_area_name }}","{{ $data->air_province_name }}", "{{ $data->air_thai_date }}", {{ $data->id }}],
            ];

            for (i = 0; i < markers.length; i++) {
                var position = new google.maps.LatLng(markers[i][1], markers[i][2]);

                var value = markers[i][3];
                var area = markers[i][4];
                var province = markers[i][5];
                var date = markers[i][6];
                var id = markers[i][7];

                var content = "มลพิษทางอากาศ: "+ value +
                    "<br>" + "พื้นที่: "+ area + " จ." + province + "<br>" +
                    "วันที่: "+ date + "<br>" + "<a href='https://fast-fortress-33466.herokuapp.com/show_air_picture/"+id+"'>คลิกเพื่อดูรูป</a>";

                var infowindow = new google.maps.InfoWindow({
                    content: content
                });

                marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: content
                });

                if(value == "เล็กน้อย")
                {
                    marker.setIcon('http://maps.google.com/mapfiles/ms/icons/yellow-dot.png');
                }
                else if(value == "ปานกลาง")
                {
                    marker.setIcon('http://maps.google.com/mapfiles/ms/icons/orange-dot.png');
                }
                else if(value == "รุนแรง")
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
                    @if($data->air_pollution == "เล็กน้อย")
                        <div class="mdl-card__title mdl-card--expand" style="background: #f7ca18">
                            @elseif($data->air_pollution == "ปานกลาง")
                                <div class="mdl-card__title mdl-card--expand" style="background: #ff9900">
                                    @elseif($data->air_pollution == "รุนแรง")
                                        <div class="mdl-card__title mdl-card--expand" style="background: red">
                                            @endif
                        <h4> มลพิษทางอากาศ: {{ $data->air_pollution }} &nbsp;กลิ่นเหม็น: {{ $data->air_smell }} วันที่: {{ $data->air_thai_date }}
                            <br>
                            ความคิดเห็น: {{ $data->air_comment }}</h4>

                    </div>
                    <div class="mdl-card__supporting-text">
                        <h5> พื้นที่: {{ $data->air_area_name }} จ.{{ $data->air_province_name }} </h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br><br><br>
@stop