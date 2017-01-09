<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutoReportNoiseByUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auto_report_noise_by_user', function (Blueprint $table) {
            $table->increments('id');
            $table->double('noise_value');
            $table->string('noise_condition_name');
            $table->double('lat');
            $table->double('long');
            $table->string('noise_area_name');
            $table->string('noise_province_name');
            $table->timestamp();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('auto_report_noise_by_user');
    }
}
