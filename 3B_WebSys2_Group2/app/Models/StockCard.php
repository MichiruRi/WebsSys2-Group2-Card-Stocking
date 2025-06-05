<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockCard extends Model
{
    //
    protected $fillable = [
        'item',
        'description',
        'stock_no',
        'date',
        'month',
        'year',
        'reference',
        'receipt_quantity',
        'quantity',
        'office',
        'balance_quantity',
        'days_consume',
    ];
}
