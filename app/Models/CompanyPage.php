<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CompanyPage extends Model
{
     use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'headline',
        'paragraph_1',
        'paragraph_2',
        'button_1_text',
        'button_1_link',
        'button_2_text',
        'button_2_link',
        'image_1',
        'image_1_alt',
        'image_2',
        'image_2_alt',
    ];
}
