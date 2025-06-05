<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    protected $fillable = [
        'date',
        'month',
        'year',
        'item',
        'unit',
        'quantity',
        'purchased_supplies',
        'supplies_from_lingayen',
        'purchased_total_cost',
        'lingayen_total_cost',
        'issued',
        'inventory_end',
        'unit_cost',
        'amount'
    ];
}
