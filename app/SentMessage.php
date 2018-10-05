<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SentMessage extends Model
{
    protected $fillable = [
        'student_id',
        'teacher_id',
        'student_roll',
        'sclass_id',
        'session',
        'section_id',
        'group_id',
        'is_read',
        'subject',
        'message',
        'file',
    ];

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }

    public function student()
    {
        return $this->belongsTo('App\Student');
    }
}
