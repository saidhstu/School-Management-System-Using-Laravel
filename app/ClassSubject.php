<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassSubject extends Model
{
    protected $fillable = [
        'sclass_id',
        'exam_id',
        'subject_id',
        'group_id',
        'subjective',
        'sub_pass',
        'objective',
        'obj_pass',
        'practical',
        'prac_pass',
        'percent',
        'part',
        'part_details',
        'total_pass',
        'single_pass',
        'inactive',
        'rank',
        'has_monthly',
        'monthly_limit',
    ];

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
}
