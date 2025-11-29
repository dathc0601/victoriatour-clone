<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class City extends Model implements HasMedia
{
    use HasFactory, HasTranslations, HasSlug, InteractsWithMedia;

    protected $fillable = [
        'destination_id',
        'name',
        'slug',
        'description',
        'image',
        'tour_count',
        'is_active',
    ];

    public array $translatable = [
        'name',
        'description',
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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function updateTourCount(): void
    {
        $this->update(['tour_count' => $this->tours()->active()->count()]);
    }
}
