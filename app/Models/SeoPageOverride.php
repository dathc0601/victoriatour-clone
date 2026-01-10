<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class SeoPageOverride extends Model
{
    use HasTranslations;

    protected $fillable = [
        'url_path',
        'is_wildcard',
        'priority',
        'title',
        'meta_title',
        'meta_description',
        'og_title',
        'og_description',
        'og_image',
        'meta_robots',
        'canonical_url',
        'is_active',
    ];

    public array $translatable = [
        'title',
        'meta_title',
        'meta_description',
        'og_title',
        'og_description',
    ];

    protected $casts = [
        'is_wildcard' => 'boolean',
        'is_active' => 'boolean',
        'priority' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeExact($query)
    {
        return $query->where('is_wildcard', false);
    }

    public function scopeWildcard($query)
    {
        return $query->where('is_wildcard', true);
    }

    /**
     * Find the SEO override for a given URL path.
     * Priority: Exact match > Wildcard with higher priority
     */
    public static function findForPath(string $path): ?self
    {
        $cacheKey = "seo_override:" . md5($path);

        return Cache::remember($cacheKey, 3600, function () use ($path) {
            // First try exact match (highest priority)
            $exact = static::where('url_path', $path)
                ->exact()
                ->active()
                ->first();

            if ($exact) {
                return $exact;
            }

            // Then try wildcards, ordered by priority (descending)
            $wildcards = static::wildcard()
                ->active()
                ->orderByDesc('priority')
                ->get();

            foreach ($wildcards as $override) {
                if (static::matchesWildcard($path, $override->url_path)) {
                    return $override;
                }
            }

            return null;
        });
    }

    /**
     * Check if a path matches a wildcard pattern.
     * Supports * as a wildcard that matches any segment.
     */
    protected static function matchesWildcard(string $path, string $pattern): bool
    {
        // Escape regex special characters except *
        $regex = preg_quote($pattern, '#');

        // Replace * with regex pattern to match anything except /
        $regex = str_replace('\*', '[^/]+', $regex);

        // Also support ** to match anything including /
        $regex = str_replace('\*\*', '.*', $regex);

        return (bool) preg_match("#^{$regex}$#", $path);
    }

    /**
     * Clear the cache for all SEO overrides.
     */
    public static function clearCache(): void
    {
        // Clear all cached overrides by forgetting the cache tag
        Cache::flush();
    }

    /**
     * Clear the cache for a specific path.
     */
    public static function clearCacheForPath(string $path): void
    {
        Cache::forget("seo_override:" . md5($path));
    }

    protected static function booted(): void
    {
        static::saved(function ($model) {
            // Clear cache when a record is saved
            Cache::forget("seo_override:" . md5($model->url_path));
        });

        static::deleted(function ($model) {
            // Clear cache when a record is deleted
            Cache::forget("seo_override:" . md5($model->url_path));
        });
    }
}
