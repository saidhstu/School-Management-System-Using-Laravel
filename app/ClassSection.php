<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassSection extends Model
{
    protected $fillable = ['sclass_id','section_id'];


    public function sclass()
    {
        return $this->belongsTo('App\Sclass');
    }

    public function section()
    {
        return $this->belongsTo('App\Section');
    }
}
