<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Co extends Model
{
    protected $fillable = [
        'name',
        'details',
        'file',
    ];
}
