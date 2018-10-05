<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamPayment extends Model
{
    protected $fillable = [
        'student_id',
        'sclass_id',
        'section_id',
        'group_id',
        'exam_id',
        'session',
        'session_month',
        'amount',
        'month',
        'staying_id',
        'version_id',
        'serial_id'
    ];

    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }

    public function sclass()
    {
        return $this->belongsTo('App\Sclass');
    }

    public function serial()
    {
        return $this->belongsTo('App\Serial');
    }
}
