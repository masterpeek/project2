@extends('app_air')

@section('content')
    <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
        <div class="mdl-grid">
            <br>
            {!! Form::open(['url' => 'search_air', 'method' => 'post']) !!}
            <div class="row">
                <div class="col-lg-6 col-centered">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="ค้นหาจังหวัด เช่น กรุงเทพมหานคร, นครปฐม...">
                        <span class="input-group-btn">
                            <input type="submit" value="ค้นหา" class="btn btn-default">
                        </span>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
            {!! Form::close() !!}
            @foreach($datas as $data)
                <div class="mdl-cell mdl-cell--4-col">
                    <div class="demo-card-square mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title mdl-card--expand">
                            <h2 class="mdl-card__title-text"></h2>
                        </div>
                        <div class="mdl-card__supporting-text">
                            วันที่: {{ $data->air_thai_date }}  <br>
                            พื้นที่: {{ $data->air_area_name }}
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
    @unless(Request::url() == url('/all_report_air'))
        <div class="mdl-layout__obfuscator"></div>
        <a href="{{ url('/all_report_air') }}" id="view-source" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--white">รายการทั้งหมด</a>
        <script src="$$hosted_libs_prefix$$/$$version$$/material.min.js"></script>
    @endunless
@stop