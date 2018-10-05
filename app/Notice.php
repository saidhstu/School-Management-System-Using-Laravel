<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable = [
        'name',
        'details',
        'publish_date',
        'unpublish_date',
        'file',  
    ];
}
