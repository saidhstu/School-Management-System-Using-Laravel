<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sclass extends Model
{
    protected $fillable = ['name'];


    public function sections()
    {
        return $this->hasMany('App\ClassSection');
    }

    public function exams()
    {
        return $this->hasMany('App\ClassExam');
    }

    public function groups()
    {
        return $this->hasMany('App\ClassGroup');
    }

    public function subjects()
    {
        return $this->hasMany('App\ClassSubject');
    }

    public function monthlies()
    {
        return $this->hasMany('App\ClassMonthly');
    }
}
