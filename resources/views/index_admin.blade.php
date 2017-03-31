@extends('app_admin')
@section('content')
<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3 sidenav hidden-xs">
            <h3>หน้าจัดการระบบ</h3>
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="#section1">ผู้ใช้งาน</a></li>
                <li><a href="#section2">สถานีวัดคุณภาพอากาศ</a></li>
                <li><a href="#section3">รายงานมลพิษทางเสียง</a></li>
                <li><a href="#section3">รายงานมลพิษทางอากาศ</a></li>
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
                    @if($user->user_level = 1)
                    <td> ผู้ใช้ทั่วไป </td>
                    @elseif($user->user_level = 2)
                        <td> ผู้ดูแลระบบ </td>
                    @endif
                    <td><input type="button" class="btn btn-warning" value="แก้ไข"></td>
                    <td><input type="button" class="btn btn-danger" value="ลบ"></td>
                </tr>
                @endforeach
            </table>


        </div>
    </div>
</div>
    @stop
