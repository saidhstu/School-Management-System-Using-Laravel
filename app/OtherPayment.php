<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OtherPayment extends Model
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
        'fund_id',
        'month',
        'amount',
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

    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function fund()
    {
        return $this->belongsTo('App\Fund');
    }

    public function serial()
    {
        return $this->belongsTo('App\Serial');
    }
}
