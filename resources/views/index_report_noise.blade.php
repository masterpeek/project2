@extends('app_noise')

@section('content')
    <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
        <div class="mdl-grid">
            @foreach($datas as $data)
                <div class="mdl-cell mdl-cell--4-col">
                    <div class="demo-card-square mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title mdl-card--expand">
                            <h2 class="mdl-card__title-text"></h2>
                        </div>
                        <div class="mdl-card__supporting-text">
                            {{ $data->noise_area_name }}, {{$data->noise_province_name}} <br>
                            {{ $data->created_at }}
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" href="{{ url('show_report_noise/'.$data->id) }}">
                                รายละเอียด
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    @unless(Request::url() == url('/all_report_noise'))
        <div class="mdl-layout__obfuscator"></div>
        <a href="{{ url('/all_report_noise') }}" id="view-source" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--white">รายการทั้งหมด</a>
        <script src="$$hosted_libs_prefix$$/$$version$$/material.min.js"></script>
    @endunless
@stop
