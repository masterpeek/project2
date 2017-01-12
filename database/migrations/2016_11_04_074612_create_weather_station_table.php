<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeatherStationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_station', function (Blueprint $table) {
            $table->increments('id');
            $table->string('station_id');
            $table->string('station_name');
            $table->string('area_name');
            $table->string('province_name');
            $table->integer('aqi_value');
            $table->string('aqi_condition_name');
            $table->double('lat');
            $table->double('long');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('weather_station');
    }
}
