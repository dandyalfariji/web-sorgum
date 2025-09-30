<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HeaderMenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'header_id',
        'label',
        'url',
        'wire_click_key',
        'order',
        'is_visible',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    /**
     * Mendefinisikan relasi bahwa item menu ini milik satu Header.
     */
    public function header(): BelongsTo
    {
        return $this->belongsTo(Header::class);
    }
}
