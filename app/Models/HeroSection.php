<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HeroSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_active',
        'headline',
        'description',
        'primary_button_text',
        'primary_button_url',
        'secondary_button_text',
        'secondary_button_url',
        'hero_image_path',
        'mid_section_headline',
        'mid_section_description',
        'mid_section_image_path',
        'cta_headline',
        'cta_description',
        'cta_button_text',
        'cta_button_url',
        'cta_image_path',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
