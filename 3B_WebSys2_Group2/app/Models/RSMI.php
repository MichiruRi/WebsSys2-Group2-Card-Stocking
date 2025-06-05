<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RSMI extends Model
{
    //
    protected $table = 'rsmi';
    protected $fillable = [
        'date',
        'month',
        'year',
        'RIS_no',
        'fund_cluster',
        'office',
        'center_code',
        'stock_no',
        'item',
        'unit',
        'quantity_issued',
        'unit_cost',
        'amount',
    ];
}
