@extends('app_admin')
@section('content')
    <div class="container-fluid">
        <div class="row content">
            <div class="col-sm-3 sidenav hidden-xs">
                <h3>หน้าจัดการระบบ</h3>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="{{ url('/index_admin') }}">ผู้ใช้งาน</a></li>
                    <li><a href="{{ url('/index_admin_ws') }}">สถานีวัดคุณภาพอากาศ</a></li>
                    <li><a href="{{ url('/index_admin_noise') }}">รายงานมลพิษทางเสียง</a></li>
                    <li class="active"><a href="{{ url('/index_admin_air') }}">รายงานมลพิษทางอากาศ</a></li>
                </ul><br>
            </div>

            <div class="col-sm-4 col-sm-offset-2">
                {!! Form::open(['url' => 'search_air_admin', 'method' => 'post']) !!}
                <div class="input-group">
                    <input type="text" name="province" class="form-control" placeholder="ค้นหาจังหวัด เช่น กรุงเทพ, นครปฐม...">
                    <span class="input-group-btn">
                            <input type="submit" value="ค้นหา" class="btn btn-default">
                            <a href="{{ url('/index_admin_air') }}" class="btn btn-default">ค้นหาทั้งหมด</a>
                        </span>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="col-sm-9">
                <br>
                <table class="table table-bordered">
                    <tr>
                        <th>รหัส</th>
                        <th>รูป</th>
                        <th>ระดับกลิ่นเหม็น</th>
                        <th>ระดับมลพิษ</th>
                        <th>รายละเอียด</th>
                        <th>พื้นที่</th>
                        <th>จังหวัด</th>
                        <th>วันที่และเวลา</th>
                        <th>ลบ</th>
                    </tr>
                    @foreach($datas as $data)
                        <tr>
                            <td>{{ $data->id }}</td>
                            <td><img src="data:image/jpeg;base64,{{ $data->air_picture }}" /></td>
                            <td>{{ $data->air_smell }}</td>
                            <td>{{ $data->air_pollution }}</td>
                            <td>{{ $data->air_comment }}</td>
                            <td>{{ $data->air_area_name }}</td>
                            <td>{{ $data->air_province_name }}</td>
                            <td>{{ $data->air_thai_date }}</td>
                            <td>{!! Form::open(['method' => 'DELETE', 'url' => 'index_admin_air/'.$data->id]) !!}
                                {!! Form::submit('ลบ', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}</td>
                        </tr>
                    @endforeach
                </table>


            </div>
        </div>
    </div>
@stop
