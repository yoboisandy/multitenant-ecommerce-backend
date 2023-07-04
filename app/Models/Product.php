<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $fillable =
    [
        'name',
        'description',
        'category_id',
        'selling_price',
        'cost_price',
        'crossed_price',
        'quantity',
        'sku',
        'status',
    ];

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }

    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
