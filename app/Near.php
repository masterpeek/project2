<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Near extends Model
{
    protected $table = 'near';
    //อนุญาติให้ใส่อะไรเข้ามาได้บ้าง
    protected $fillable = [
        'lat', 'long', 'area',
    ];
}
