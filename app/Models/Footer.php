<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Footer extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo_path',
        'brand_name',
        'description',
        'link_columns',
        'copyright_text',
        'whatsapp_url',
        'instagram_url',
        'tiktok_url',
        'shopee_url',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'link_columns' => 'array', //untuk Repeater
    ];
}
