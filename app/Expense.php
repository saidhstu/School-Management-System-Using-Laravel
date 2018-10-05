<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['expense_head_id','date_of_expense','amount','remarks','expense_serial_id'];

    public function head()
    {
        return $this->belongsTo('App\ExpenseHead','expense_head_id');
    }

}
