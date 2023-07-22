<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customization extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'theme',
        'logo',
        'favicon',
        'selected_hero',
        'hero_title',
        'hero_subtitle',
        'hero_button_text',
        'hero_button_url',
        'hero_image',
        'selected_navbar',
        'topbar_text',
        'topbar_url',
    ];
}
