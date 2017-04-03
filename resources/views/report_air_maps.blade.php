@extends('app_air_maps')
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
<div class="form-group" style="text-align:center">
    <h3> แผนที่มลพิษทางอากาศ</h3>
</div>
{!! Form::open(['url' => 'select_condition_air', 'method' => 'post']) !!}
<div class="form-group" style="text-align:center">
    <h4>เลือกดูตามระดับมลพิษทางอากาศ</h4>
    <select name="condition">
        <option value="ทั้งหมด">ทั้งหมด</option>
        <option value="เล็กน้อย">เล็กน้อย</option>
        <option value="ปานกลาง">ปานกลาง</option>
        <option value="รุนแรง">รุนแรง</option>
    </select>
    <input type="submit" value="ค้นหา">
</div>
{!! Form::close() !!}
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
            ['', {{ $marker->air_lat }}, {{ $marker->air_long }}, "{{ $marker->air_pollution }}",
                "{{ $marker->air_area_name }}", "{{ $marker->air_province_name }}", "{{ $marker->air_thai_date }}", "{{ $marker->air_picture }}"],
            @endforeach
        ];

        for (i = 0; i < markers.length; i++) {
            var position = new google.maps.LatLng(markers[i][1], markers[i][2]);

            var value = markers[i][3];
            var area = markers[i][4];
            var province = markers[i][5];
            var date = markers[i][6];
            var picture = markers[i][7];

            var content = '<br><img src="data:image/jpg;base64,'+ picture + '"/>';

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
                marker.setIcon('cloud1.png');

            }
            else if(value == "ปานกลาง")
            {
                marker.setIcon('cloud2.png');
            }
            else if(value == "รุนแรง")
            {
                marker.setIcon('cloud3.png');
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
<div class="form-group" style="text-align:center">
    <img src="air_color.png" height="100" width="700">
</div>
</body>
</html>
@stop