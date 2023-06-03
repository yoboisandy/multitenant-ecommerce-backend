<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_name',
        'email',
        'password',
        'phone',
        'store_name',
        'store_category_id',
        'subdomain',
        'email_token',
        'email_verified_at',
    ];

    public function storeCategory()
    {
        return $this->belongsTo(StoreCategory::class);
    }
}
