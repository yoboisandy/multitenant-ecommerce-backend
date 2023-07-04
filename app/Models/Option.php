<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory, HasUuids;

    protected $fillable =
    [
        'name',
        'options',
        'product_id',
    ];

    public function getOptionsAttribute($value)
    {
        if (!$value) return [];
        return explode(',', $value);
    }

    public function setOptionsAttribute($value)
    {
        if (!count($value)) return $this->attributes['options'] = null;
        $this->attributes['options'] = implode(',', $value);
    }
}
