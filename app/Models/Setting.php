<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'store_fb',
        'store_ig',
        'store_tiktok',
        'store_whatsapp',
        'delivery_charge',
        'delivery_time',
    ];

    protected $casts = [
        'delivery_charge' => 'float',
    ];
}
