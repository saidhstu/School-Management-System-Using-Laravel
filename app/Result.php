<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'student_id',
        'student_roll',
        'sclass_id',
        'session',
        'exam_id',
        'section_id',
        'group_id',
        'subject_id',
        'subjective',
        'is_sub_pass',
        'objective',
        'is_obj_pass',
        'practical',
        'is_prac_pass',
        'monthly',
        'monthly_limit',
        'subjective_limit',
        'objective_limit',
        'practical_limit',
        'percent_limit',
        'total',
        'percent',
        'part_monthly',
        'part_sub',
        'part_obj',
        'part_prac',
        'part_mark',
        'part',
        'part_details',
        'total_mark',
        'gpa',
        'grade',
        'is_opt',
        'opt_point',
        'teacher_id',
        'inactive',
        'absent',
        'rank',
        'has_monthly',
    ];

    public function sclass()
    {
        return $this->belongsTo('App\Sclass');
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }

    public function student()
    {
        return $this->belongsTo('App\Student');
    }
}
