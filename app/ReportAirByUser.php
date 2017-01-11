<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ReportAirByUser extends Model
{
    //use Notifiable;
    //public $timestamps = true;

    protected $table = 'report_air_by_user';
    //อนุญาติให้ใส่อะไรเข้ามาได้บ้าง
    protected $fillable = [
        'air_image', 'air_smell', 'air_pollution','air_comment', 'air_level',
        'lat', 'long', 'air_area_name', 'air_province_name',

    ];
}
