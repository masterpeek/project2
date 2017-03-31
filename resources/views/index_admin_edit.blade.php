@extends('app_admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title" align="center">สมัครสมาชิก</h1>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['url' => 'update_user', 'method' => 'post']) !!}
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="ชื่อผู้ใช้" type="text" name="username" value="{{ $user->username }}">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="รหัสผ่าน" type="password" name="password" value="{{ $user->password }}">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="ยืนยันรหัสผ่าน" type="password" name="confirm_password" value="{{ $user->confirm_password }}">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="ชื่อ" type="text" name="name" value="{{ $user->fname }}">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="นามสกุล" type="text" name="lastname" value="{{ $user->lname }}">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="เบอร์โทรศัพท์" type="text" name="telephone" value="{{ $user->tel }}">
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
