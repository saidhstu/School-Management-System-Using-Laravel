<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = [
        'name', 'email', 'password','mobile','address','joining_date','gender','religion','image','cpassword'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function subjects()
    {
        return $this->hasMany('App\TeacherSubject');
    }

    public function classes()
    {
        return $this->hasMany('App\TeacherClass');
    }

    public function bivag()
    {
        return $this->belongsTo('App\Bivag');
    }

}
