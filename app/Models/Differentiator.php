<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Differentiator extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'title',
        'description',
        'icon',
        'order',
        'is_active',
    ];

    public array $translatable = [
        'title',
        'description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
