<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Header extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo_path',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Mendefinisikan relasi bahwa satu Header memiliki banyak item menu.
     * Item menu akan otomatis diurutkan berdasarkan kolom 'order'.
     */
    public function menuItems(): HasMany
    {
        return $this->hasMany(HeaderMenuItem::class)->orderBy('order');
    }
}
