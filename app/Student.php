<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = [
        'name', 'email', 'password','father','mother','birth_date','nationality','roll','sclass_id','section_id','group_id','session','mobile','gender','address','image','email','version_id','staying_id','religion','cpassword'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sclass()
    {
        return $this->belongsTo('App\Sclass');
    }

    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }



}
