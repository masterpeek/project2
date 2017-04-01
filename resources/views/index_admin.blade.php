@extends('app_admin')
@section('content')
<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3 sidenav hidden-xs">
            <h3>หน้าจัดการระบบ</h3>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="{{ url('/index_admin') }}">ผู้ใช้งาน</a></li>
                <li><a href="{{ url('/index_admin_ws') }}">สถานีวัดคุณภาพอากาศ</a></li>
                <li><a href="{{ url('/index_admin_noise') }}">รายงานมลพิษทางเสียง</a></li>
                <li><a href="{{ url('/index_admin_air') }}">รายงานมลพิษทางอากาศ</a></li>
            </ul><br>
        </div>

        <div class="col-sm-4 col-sm-offset-2">
            {!! Form::open(['url' => 'search_user_admin', 'method' => 'post']) !!}
            <div class="input-group">
                <input type="text" name="province" class="form-control" placeholder="ค้นหาจากชื่อผู้ใช้">
                <span class="input-group-btn">
                            <input type="submit" value="ค้นหา" class="btn btn-default">
                            <a href="{{ url('/index_admin') }}" class="btn btn-default">ค้นหาทั้งหมด</a>
                        </span>
            </div>
            {!! Form::close() !!}
            <br>
            {!! Form::open(['url' => 'search_condition_user_admin', 'method' => 'post']) !!}
            <div class="form-group" style="text-align:center">
                <h4>เลือกดูตามระดับผู้ใช้</h4>
                <select name="condition">
                    <option value="ทั้งหมด">ทั้งหมด</option>
                    <option value="1">ผู้ใช้ทั่วไป</option>
                    <option value="2">ผู้ดูแลระบบ</option>
                </select>
                <input type="submit" value="ค้นหา">
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-sm-9">
            <br>
            <table class="table table-bordered">
                <tr>
                    <th>รหัส</th>
                    <th>ชื่อผู้ใช้</th>
                    <th>รหัสผ่าน</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>ระดับผู้ใช้</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                </tr>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->password }}</td>
                    <td>{{ $user->fname }}</td>
                    <td>{{ $user->lname }}</td>
                    <td>{{ $user->tel }}</td>
                    @if($user->user_level == 1)
                    <td> ผู้ใช้ทั่วไป </td>
                        @elseif($user->user_level == 2)
                            <td> ผู้ดูแลระบบ </td>
                        @endif
                    <td><a class="btn btn-small btn-success" href="{{ url('index_admin_edit/'.$user->id) }}">
                        แก้ไข</a>
                    </td>
                    <td>{!! Form::open(['method' => 'DELETE', 'url' => 'index_admin/'.$user->id]) !!}
                        {!! Form::submit('ลบ', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}</td>
                </tr>
                @endforeach
            </table>


        </div>
    </div>
</div>
    @stop
