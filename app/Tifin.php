<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tifin extends Model
{
    protected $fillable = [
        'student_id',
        'sclass_id',
        'section_id',
        'group_id',
        'version_id',
        'staying_id',
        'session',
        'month',
        'amount',
    ];

    public function student()
    {
        return $this->belongsTo('App\Student');
    }

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
}
