<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Merit extends Model
{
    protected $fillable = [
        'student_id',
        'student_roll',
        'sclass_id',
        'session',
        'exam_id',
        'section_id',
        'group_id',
        'total_mark',
        'gpa',
        'grade',
        'pass',
        'fail',
        'fail_subjects',
        'position',
        'class_position',
        'wo_gpa',
        'is_golden',
        'absent',
        'has_monthly'
    ];

    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    public function sclass()
    {
        return $this->belongsTo('App\Sclass');
    }

    public function exam()
    {
        return $this->belongsTo('App\Exam');
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
