<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraIncome extends Model
{
    protected $fillable = ['amount','income_head_id','date_of_income','remarks'];

    public function incomehead()
    {
        return $this->belongsTo('App\IncomeHead','income_head_id');
    }
}
