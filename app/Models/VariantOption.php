<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantOption extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'name',
        'variant_id',
        'selling_price',
        'cost_price',
        'crossed_price',
        'quantity',
        'sku',
    ];
}
