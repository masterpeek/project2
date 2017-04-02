@extends('app_admin_index')
@section('content')
    <br><br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title" align="center">สมัครสมาชิก</h1>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['url' => 'create_admin', 'method' => 'post']) !!}
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="ชื่อผู้ใช้" type="text" name="username">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="รหัสผ่าน" type="password" name="password">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="ยืนยันรหัสผ่าน" type="password" name="confirm_password">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="ชื่อ" type="text" name="name">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="นามสกุล" type="text" name="lastname">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="เบอร์โทรศัพท์" type="text" name="telephone">
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
