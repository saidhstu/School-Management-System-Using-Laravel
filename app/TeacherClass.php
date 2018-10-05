<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherClass extends Model
{
    protected $fillable = ['teacher_id','sclass_id'];

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }

    public function sclass()
    {
        return $this->belongsTo('App\Sclass');
    }
}
