<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NonSubject extends Model
{
    protected $fillable = ['student_id','student_roll','sclass_id','section_id','group_id','session','subject_id'];

    public function sclass()
    {
        return $this->belongsTo('App\Sclass');
    }

    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }

    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function student()
    {
        return $this->belongsTo('App\Student');
    }
}
