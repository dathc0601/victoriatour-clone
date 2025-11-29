<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Tour extends Model implements HasMedia
{
    use HasFactory, HasTranslations, HasSlug, InteractsWithMedia;

    protected $fillable = [
        'destination_id',
        'city_id',
        'title',
        'slug',
        'excerpt',
        'description',
        'duration_days',
        'price',
        'price_type',
        'rating',
        'gallery',
        'itinerary',
        'inclusions',
        'exclusions',
        'meta_title',
        'meta_description',
        'is_featured',
        'is_active',
        'order',
    ];

    public array $translatable = [
        'title',
        'excerpt',
        'description',
        'itinerary',
        'inclusions',
        'exclusions',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'gallery' => 'array',
        'price' => 'decimal:2',
        'rating' => 'decimal:1',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(fn ($model) => $model->getTranslation('title', 'en'))
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

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(TourCategory::class, 'tour_tour_category');
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
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
        return match ($this->price_type) {
            'fixed' => '$' . number_format($this->price, 0),
            'from' => 'From $' . number_format($this->price, 0),
            'contact' => 'Contact for price',
        };
    }

    public function getDurationAttribute(): string
    {
        return $this->duration_days . ' ' . ($this->duration_days === 1 ? 'Day' : 'Days');
    }
}
