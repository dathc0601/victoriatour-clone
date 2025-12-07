<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class MiceContent extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;

    protected $fillable = [
        'destination_id',
        'region',
        'title',
        'subtitle',
        'description',
        'highlights',
        'min_delegates',
        'max_delegates',
        'venue_features',
        'services_included',
        'is_featured',
        'is_active',
        'order',
    ];

    public array $translatable = [
        'title',
        'subtitle',
        'description',
        'highlights',
    ];

    protected $casts = [
        'highlights' => 'array',
        'venue_features' => 'array',
        'services_included' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')->singleFile();
        $this->addMediaCollection('gallery');
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    // Scopes
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

    public function scopeForDelegates($query, ?int $delegates)
    {
        if (!$delegates) return $query;

        return $query->where('min_delegates', '<=', $delegates)
                     ->where(function ($q) use ($delegates) {
                         $q->whereNull('max_delegates')
                           ->orWhere('max_delegates', '>=', $delegates);
                     });
    }

    public function scopeForRegion($query, ?string $region)
    {
        if (!$region) return $query;
        return $query->where('region', $region);
    }
}
