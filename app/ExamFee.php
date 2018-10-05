<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamFee extends Model
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
        'staying_id',
        'version_id',
        'discount',
    ];

    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }

    public function sclass()
    {
        return $this->belongsTo('App\Sclass');
    }
}
