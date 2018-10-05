<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SetSessionAmount extends Model
{
    protected $fillable = [
        'session',
        'fund_id',
        'amount',
        'sclass_id'
    ];
}
