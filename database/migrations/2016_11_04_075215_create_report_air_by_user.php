<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportAirByUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_air_by_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('air_smell');
            $table->integer('air_pollution');
            $table->string('air_comment');
            $table->double('air_lat');
            $table->double('air_long');
            $table->string('air_area_name');
            $table->string('air_province_name');
            $table->string('air_thai_date');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
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
        Schema::drop('report_air_by_user');
    }
}
