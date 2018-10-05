<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSell extends Model
{
    protected $fillable = [
        'student_id',
        'student_roll',
        'sclass_id',
        'session',
        'section_id',
        'group_id',
        'product_id',
        'quantity',
        'price',
        'total_amount',
        'sell_date',
        'year',
        'month',
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
