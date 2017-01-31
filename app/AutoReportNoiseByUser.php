<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AutoReportNoiseByUser extends Model
{
    //use Notifiable;
    //public $timestamps = true;

    protected $table = 'auto_report_noise_by_user';
    //อนุญาติให้ใส่อะไรเข้ามาได้บ้าง
    protected $fillable = [
        'noise_value', 'noise_lat', 'noise_long', 'noise_area_name', 'noise_province_name', 'noise_thai_date',
    ];

}
