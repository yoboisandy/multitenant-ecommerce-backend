<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address_province',
        'customer_address_city',
        'customer_address_area',
        'customer_address_nearby_landmark',
        'total_price',
        'total_discount',
        'total_quantity',
        'order_note',
        'payment_method',
        'delivery_charge',
        'payment_status',
        'order_status',
        'products',
    ];

    // cast
    protected $casts = [
        'delivery_charge' => 'float',
        'total_price' => 'float',
        'total_discount' => 'float',
    ];

    public function setProductsAttribute($value)
    {
        $this->attributes['products'] = json_encode($value);
    }

    public function getProductsAttribute($value)
    {
        return json_decode($value);
    }
}
