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
            $table->string('username');
            $table->text('air_image');
            $table->integer('air_level');
            $table->string('air_condition_name');
            $table->double('lat');
            $table->double('long');
            $table->string('air_area_name');
            $table->string('air_province_name');
            $table->string('air_comment');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
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
