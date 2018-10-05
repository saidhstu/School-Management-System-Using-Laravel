<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Syllebus extends Model
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
