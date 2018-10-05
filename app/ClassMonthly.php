<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassMonthly extends Model
{
    protected $fillable = ['sclass_id','monthly_id'];

    public function sclass()
    {
        return $this->belongsTo('App\Sclass');
    }

    public function monthly()
    {
        return $this->belongsTo('App\Monthly');
    }
}
