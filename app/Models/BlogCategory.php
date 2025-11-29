<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class BlogCategory extends Model
{
    use HasFactory, HasTranslations, HasSlug;

    protected $fillable = [
        'name',
        'slug',
        'is_active',
    ];

    public array $translatable = [
        'name',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(fn ($model) => $model->getTranslation('name', 'en'))
            ->saveSlugsTo('slug');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(BlogPost::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
