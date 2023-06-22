<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'name',
        'description',
        'selling_price',
        'cost_price',
        'crossed_price',
        'quantity',
        'sku',
        'status',
    ];
}
