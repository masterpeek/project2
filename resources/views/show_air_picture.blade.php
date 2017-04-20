@extends('app_air_maps')

@section('content')
    <div class="form-group" style="text-align:center">
        <h3> รายงานมลพิษทางอากาศ </h3>
    </div>
    <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
        <div class="mdl-grid">
            {!! Form::open(['url' => 'search_air', 'method' => 'post']) !!}
            <div class="row">
                <div class="col-lg-6 col-centered">
                    <div class="input-group">
                        <input type="text" name="province" class="form-control" placeholder="ค้นหาจังหวัด เช่น กรุงเทพ, นครปฐม...">
                        <span class="input-group-btn">
                            <input type="submit" value="ค้นหา" class="btn btn-default">
                            <a href="{{ url('/all_report_air') }}" class="btn btn-default">ค้นหาทั้งหมด</a>
                            <a href="{{ url('/report_air_maps') }}" class="btn btn-default">แผนที่</a>
                        </span>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
            {!! Form::close() !!}

    <div class="container" style="text-align: center">
        <img src="data:image/jpeg;base64,{{ $air_picture->air_picture }}" class="centered" width="500" height="500">
    </div>

    @stop

