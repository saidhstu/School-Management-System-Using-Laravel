<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FailSubject extends Model
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
        'part',
        'rank',
    ];

    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }
}
