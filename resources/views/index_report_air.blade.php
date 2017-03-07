@extends('app_air')

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
            @foreach($datas as $data)
                <div class="mdl-cell mdl-cell--3-col">
                    <div class="demo-card-square mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title mdl-card--expand">
                            <h2 class="mdl-card__title-text">ระดับมลพิษอากาศ: {{ $data->air_pollution }}</h2>
                        </div>
                        <div class="mdl-card__supporting-text">
                            วันที่: {{ $data->air_thai_date }}  <br>
                            พื้นที่: {{ $data->air_area_name }} {{ $data->air_province_name }}
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="{{ url('show_report_air/'.$data->id) }}">
                                รายละเอียด
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@stop