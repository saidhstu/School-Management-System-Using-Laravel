<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    protected $fillable = [
        'name',
        'details',
        'file',
        'sclass_id',
        'session',
        'all',
    ];
}
