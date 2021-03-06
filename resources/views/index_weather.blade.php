@extends('app_weather')

@section('content')
    <div class="form-group" style="text-align:center">
        <h3> สถานีวัดคุณภาพอากาศ</h3>
    </div>
    <section class="section--center mdl-grid mdl-grid--no-spacing">
        <div class="mdl-grid">
            <div class="row">
                {!! Form::open(['url' => 'search_weather', 'method' => 'post']) !!}
                <div class="col-lg-6 col-centered">
                    <div class="input-group">
                        <input type="text" name="province" class="form-control" placeholder="ค้นหาจังหวัด เช่น กรุงเทพ, นครปฐม...">
                        <span class="input-group-btn">
                            <input type="submit" value="ค้นหา" class="btn btn-default">
                            <a href="{{ url('/all') }}" class="btn btn-default">ค้นหาทั้งหมด</a>
                            <a href="{{ url('/maps') }}" class="btn btn-default">แผนที่</a>
                        </span>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                {!! Form::close() !!}

                {!! Form::open(['url' => 'select_condition_weather', 'method' => 'post']) !!}
                <div class="form-group" style="text-align:center">
                    <h4>เลือกดูตามระดับคุณภาพอากาศ</h4>
                    <select name="condition">
                        <option value="ทั้งหมด">ทั้งหมด</option>
                        <option value="ดี">คุณภาพดี</option>
                        <option value="ปานกลาง">คุณภาพปานกลาง</option>
                        <option value="กระทบต่อสุขภาพ">กระทบต่อสุขภาพ</option>
                        <option value="กระทบต่อสุขภาพมาก">กระทบต่อสุขภาพมาก</option>
                        <option value="อันตราย">อันตราย</option>
                    </select>
                    <input type="submit" value="ค้นหา">
                </div>
                {!! Form::close() !!}

            </div><!-- /.row -->

            @foreach($datas as $data)
                <div class="mdl-cell mdl-cell--3-col">
                    <div class="demo-card-square mdl-card mdl-shadow--2dp">
                        @if($data->aqi_value >= 0 && $data->aqi_value <= 50)
                        <div class="mdl-card__title mdl-card--expand" style="background: #0099ff">
                            @elseif($data->aqi_value >= 51 && $data->aqi_value <= 100)
                                <div class="mdl-card__title mdl-card--expand" style="background: #33cc33">
                                    @elseif($data->aqi_value >= 101 && $data->aqi_value <= 200)
                                        <div class="mdl-card__title mdl-card--expand" style="background: #f7ca18">
                                            @elseif($data->aqi_value >= 201 && $data->aqi_value <= 300)
                                                <div class="mdl-card__title mdl-card--expand" style="background: #ff9900">
                                                @elseif($data->aqi_value > 300)
                                                    <div class="mdl-card__title mdl-card--expand" style="background: #ff0000">
                                                        @endif
                            <h2 class="mdl-card__title-text" style="color: #ffffff">ค่า AQI: {{ $data->aqi_value }} <br> คุณภาพ: {{ $data->aqi_condition_name }} </h2>

                        </div>
                        <div class="mdl-card__supporting-text">
                            วันที่:  {{ $data->thai_date }} &nbsp; เวลา: {{ $data->time }}  น.
                            <br>
                            พื้นที่: {{ $data->area_name }} จ.{{ $data->province_name }}
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="{{ url('show_weather_station/'.$data->station_id) }}">
                                รายละเอียด
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
                    </div>
                </div>
        </div>
    </section>
@stop