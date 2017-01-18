@extends('app')
@section('content')
    <section class="section--center mdl-grid mdl-grid--no-spacing mdl-shadow--2dp">
        <div class="mdl-card mdl-cell mdl-cell--12-col">
            <div class="mdl-card__supporting-text">
                <h4>{{ $data->aqi_value }}</h4>
               {{ $data->aqi_condition_name }}
            </div>
            <div class="mdl-card__actions">
                <div class="mdl-button">{{ $data->area_name }}
                </div>
            </div>
        </div>
    </section>
    @stop