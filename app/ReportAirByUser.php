<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ReportAirByUser extends Model
{
    use Notifiable;
    public $timestamps = true;

    protected $table = 'report_air_by_user';
    //อนุญาติให้ใส่อะไรเข้ามาได้บ้าง
    protected $fillable = [
        'username', 'air_image', 'air_level', 'air_condition_name',
        'lat', 'long', 'air_area_name', 'air_province_name', 'air_comment'

    ];
}
