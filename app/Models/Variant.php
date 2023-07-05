<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory, HasUuids;

    protected $fillable =
    [
        'name',
        'product_id',
        'selling_price',
        'cost_price',
        'crossed_price',
        'quantity',
        'sku',
    ];
}
