<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AutoReportNoiseByUser extends Model
{
    protected $table = 'auto_report_noise_by_user';
    //อนุญาติให้ใส่อะไรเข้ามาได้บ้าง
    protected $fillable = [
        'noise_value', 'noise_condition_name',
        'lat', 'long', 'noise_area_name', 'noise_province_name'
    ];
}
