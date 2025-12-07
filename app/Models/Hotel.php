<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Hotel extends Model implements HasMedia
{
    use HasFactory, HasTranslations, HasSlug, InteractsWithMedia;

    protected $fillable = [
        'destination_id',
        'name',
        'slug',
        'address',
        'description',
        'rating',
        'price_per_night',
        'room_types',
        'amenities',
        'is_featured',
        'is_active',
        'order',
    ];

    public array $translatable = [
        'name',
        'address',
        'description',
    ];

    protected $casts = [
        'rating' => 'decimal:1',
        'price_per_night' => 'decimal:2',
        'room_types' => 'array',
        'amenities' => 'array',
        'is_featured' => 'boolean',
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
        $this->addMediaCollection('featured_image')->singleFile();
        $this->addMediaCollection('gallery');
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function getFormattedPriceAttribute(): string
    {
        if (!$this->price_per_night) {
            return __('messages.contact');
        }

        return '$' . number_format($this->price_per_night, 0);
    }

    public function getStarRatingAttribute(): string
    {
        return number_format($this->rating, 1);
    }
}
