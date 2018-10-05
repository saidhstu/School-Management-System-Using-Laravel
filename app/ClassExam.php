<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassExam extends Model
{
    protected $fillable = ['sclass_id','exam_id'];

    public function sclass()
    {
        return $this->belongsTo('App\Sclass');
    }

    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }
}
