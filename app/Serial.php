<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serial extends Model
{
    protected $fillable = [
        'student_id',
        'sclass_id',
        'section_id',
        'staying_id',
        'version_id',
        'group_id',
        'session',
        'serial',
        'session',
    ];

    public function sclass()
    {
        return $this->belongsTo('App\Sclass');
    }

    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function student()
    {
        return $this->belongsTo('App\Student');
    }
}
