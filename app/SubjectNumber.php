<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectNumber extends Model
{
    protected $fillable = ['sclass_id','number'];

    public function sclass()
    {
        return $this->belongsTo('App\Sclass');
    }
}
