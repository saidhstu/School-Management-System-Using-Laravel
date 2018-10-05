<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendence extends Model
{
    protected $fillable = [
        'student_id',
        'student_roll',
        'sclass_id',
        'section_id',
        'staying_id',
        'version_id',
        'group_id',
        'session',
        'month',
        'status',
        'attendence_date',
    ];

    public function student()
    {
        return $this->belongsTo('App\Student');
    }
}
