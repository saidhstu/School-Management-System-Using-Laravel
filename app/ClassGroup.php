<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassGroup extends Model
{
    protected $fillable = ['sclass_id','group_id'];

    public function sclass()
    {
        return $this->belongsTo('App\Sclass');
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }
}
