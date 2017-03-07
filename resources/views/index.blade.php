@extends('app')
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
<h3> แผนที่คุณภาพเสียงและอากาศ</h3>
</div>
{!! Form::open(['url' => 'search_all', 'method' => 'post']) !!}
<div class="row">
    <div class="col-lg-6 col-centered">
        <div class="input-group">
            <input type="text" name="province" class="form-control" placeholder="ค้นหาจังหวัด เช่น กรุงเทพ, นครปฐม...">
            <span class="input-group-btn">
                            <input type="submit" value="ค้นหา" class="btn btn-default">
                        </span>
        </div><!-- /input-group -->
    </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
{!! Form::close() !!}

{!! Form::open(['url' => 'select_condition_all', 'method' => 'post']) !!}
<div class="form-group" style="text-align:center">
    <h4>เลือกดูตามหัวข้อ</h4>
    <select name="condition">
        <option value="ทั้งหมด">ทั้งหมด</option>
        <option value="สถานีวัดคุณภาพอากาศ">สถานีวัดคุณภาพอากาศ</option>
        <option value="รายงานมลพิษทางเสียง">รายงานมลพิษทางเสียง</option>
        <option value="รายงานมลพิษทางอากาศ">รายงานมลพิษทางอากาศ</option>
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
                "{{ $marker->area_name }}", "{{ $marker->date }}", "{{ $marker->time }}"],
            @endforeach
        ];

        var noises = [
                @foreach($noises as $noise)
            ['', {{ $noise->noise_lat }}, {{ $noise->noise_long }}, {{ $noise->noise_value }},
                "{{ $noise->noise_area_name }}", "{{ $noise->noise_province_name }}", "{{ $noise->noise_thai_date }}" ],
            @endforeach
        ];

        var airs = [
                @foreach($airs as $air)
            ['', {{ $air->air_lat }}, {{ $air->air_long }}, "{{ $air->air_pollution }}",
                "{{ $air->air_area_name }}", "{{ $air->air_province_name }}", "{{ $air->air_thai_date }}"],
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

        for (i = 0; i < noises.length; i++) {
            var position = new google.maps.LatLng(noises[i][1], noises[i][2]);

            var value = noises[i][3];
            var area = noises[i][4];
            var province = noises[i][5];
            var date = noises[i][6];

            var content = "ความดังเสียง: "+ value + " เดซิเบล" +
                "<br>" + "พื้นที่: "+ area + " "+ province + "<br>" +
                "วันที่: "+ date;

            var infowindow = new google.maps.InfoWindow({
                content: content
            });

            marker = new google.maps.Marker({
                position: position,
                map: map,
                title: content,
                icon: 'voice1.png'
            });

            google.maps.event.addListener(marker, 'click', function() {
                infowindow.setContent(this.title);
                infowindow.open(map, this);
            });
        }

        for (i = 0; i < airs.length; i++) {
            var position = new google.maps.LatLng(airs[i][1], airs[i][2]);

            var value = airs[i][3];
            var area = airs[i][4];
            var province = airs[i][5];
            var date = airs[i][6];

            var content = "ระดับมลพิษทางอากาศ: "+ value +
                "<br>" + "พื้นที่: "+ area +" "+ province + "<br>" +
                "วันที่: "+ date;

            var infowindow = new google.maps.InfoWindow({
                content: content
            });

            marker = new google.maps.Marker({
                position: position,
                map: map,
                title: content,
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
<br><br><br>
</body>
</html>
@stop