@extends('app_admin')
@section('content')
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-3 sidenav hidden-xs">
                <h3>หน้าจัดการระบบ</h3>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="{{ url('/index_admin') }}">ผู้ใช้งาน</a></li>
                    <li class="active"><a href="{{ url('/index_admin_ws') }}">สถานีวัดคุณภาพอากาศ</a></li>
                    <li><a href="{{ url('/index_admin_noise') }}">รายงานมลพิษทางเสียง</a></li>
                    <li><a href="{{ url('/index_admin_air') }}">รายงานมลพิษทางอากาศ</a></li>
                </ul><br>
            </div>

            <div class="col-sm-4 col-sm-offset-2">
                <div class="input-group">
                    <input type="text" name="province" class="form-control" placeholder="ค้นหา">
                    <span class="input-group-btn">
                            <input type="submit" value="ค้นหา" class="btn btn-default">
                        </span>
                </div>
            </div>
            <div class="col-sm-9">
                <br>
                <table class="table table-bordered">
                    <tr>
                        <th>รหัสสถานี</th>
                        <th>ชื่อสถานี</th>
                        <th>พื้นที่</th>
                        <th>จังหวัด</th>
                        <th>ค่าคุณภาพอากาศ</th>
                        <th>สถานะ</th>
                        <th>วันที่</th>
                        <th>เวลา</th>
                        <th>ลบ</th>
                    </tr>
                    @foreach($datas as $data)
                        <tr>
                            <td>{{ $data->station_id }}</td>
                            <td>{{ $data->station_name }}</td>
                            <td>{{ $data->area_name }}</td>
                            <td>{{ $data->province_name }}</td>
                            <td>{{ $data->aqi_value }}</td>
                            <td>{{ $data->aqi_condition_name }}</td>
                            <td>{{ $data->thai_date }}</td>
                            <td>{{ $data->time }}</td>

                            <td><input type="button" class="btn btn-danger" value="ลบ"></td>
                        </tr>
                    @endforeach
                </table>


            </div>
        </div>
    </div>
@stop
