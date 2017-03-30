@extends('app_admin')
@section('content')
    <div class="container1">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title" align="center">เข้าสู่ระบบ</h1>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['url' => 'login_admin', 'method' => 'post']) !!}
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="ชื่อผู้ใช้" type="text" name="username">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="รหัสผ่าน" name="password" type="password" value="">
                                </div>

                                <input class="btn btn-lg btn-success btn-block" type="submit" value="ยืนยัน">
                            </fieldset>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @stop