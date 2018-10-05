<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormPayment extends Model
{
    protected $fillable = [
        'student_id',
        'sclass_id',
        'section_id',
        'group_id',
        'version_id',
        'staying_id',
        'session',
        'session_month',
        'exam_id',
        'amount',
        'month',
        'serial_id',
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

    public function serial()
    {
        return $this->belongsTo('App\Serial');
    }
}
