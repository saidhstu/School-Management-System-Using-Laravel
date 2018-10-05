<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsInfo extends Model
{
    protected $fillable = [
        'name_bangla',
        'name_english',
        'eiin_num',
        'reg_year',
        'mobile',
        'email',
        'address',
        'description',
        'file',
    ];
}
