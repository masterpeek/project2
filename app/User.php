<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Model
{
    //use Notifiable;
    //public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'fname', 'lname', 'tel', 'email','user_level',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function reportAirs()
    {
        return $this->hasMany('App\ReportAirByUser');
    }

    public function reportNoises()
    {
        return $this->hasMany('App\AutoReportNoiseByUser');
    }
}
