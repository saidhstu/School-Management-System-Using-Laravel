<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPayment extends Model
{
    protected $fillable = [
        'student_id',
        'sclass_id',
        'section_id',
        'group_id',
        'session',
        'year',
        'month',
        'amount',
        'serial_id',
    ];
}
