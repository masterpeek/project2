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
<div class="form-group" style="text-align:center">
    <h3> แผนที่คุณภาพอากาศ</h3>
</div>
{!! Form::open(['url' => 'select_condition', 'method' => 'post']) !!}
<div class="form-group" style="text-align:center">
    <h4>เลือกดูตามระดับคุณภาพอากาศ</h4>
<select name="condition">
    <option value="ทั้งหมด">ทั้งหมด</option>
    <option value="ดี">คุณภาพดี</option>
    <option value="ปานกลาง">คุณภาพปานกลาง</option>
    <option value="กระทบต่อสุขภาพ">กระทบต่อสุขภาพ</option>
    <option value="กระทบต่อสุขภาพมาก">กระทบต่อสุขภาพมาก</option>
    <option value="อันตราย">อันตราย</option>
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
            ['', {{ $marker->lat }}, {{ $marker->long }}, {{ $marker->aqi_value }},
                "{{ $marker->aqi_condition_name }}", "{{ $marker->station_name }}",
                "{{ $marker->area_name }}", "{{ $marker->date }}", "{{ $marker->time }}", "{{ $marker->province_name }}"],
            @endforeach
        ];


        for (i = 0; i < markers.length; i++) {
            var position = new google.maps.LatLng(markers[i][1], markers[i][2]);

            var aqi = markers[i][3];
            var aqi_condition = markers[i][4];
            var station = markers[i][5];
            var area = markers[i][6];
            var date = markers[i][7];
            var time = markers[i][8];
            var province = markers[i][9];


            var content = "ค่า​AQI: "+ aqi + " " + "ระดับคุณภาพอากาศ: " + aqi_condition +
                "<br>" + "ชื่อ: "+ station + "<br>" + "พื้นที่: "+ area + " จ." + province +
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
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5-kfTpPFWJkFxa5hazbi8ywhCwViGYuQ&callback=initMap">
</script>
<div class="form-group" style="text-align:center">
    <img src="station_color1.png" height="100" width="700">
</div>
</body>
</html>
@stop



