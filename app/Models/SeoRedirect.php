<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SeoRedirect extends Model
{
    protected $fillable = [
        'source_path',
        'target_url',
        'status_code',
        'is_active',
        'hit_count',
        'last_hit_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'status_code' => 'integer',
        'hit_count' => 'integer',
        'last_hit_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Find the redirect for a given source path.
     */
    public static function findForPath(string $path): ?self
    {
        $cacheKey = "seo_redirect:" . md5($path);

        return Cache::remember($cacheKey, 3600, function () use ($path) {
            return static::where('source_path', $path)
                ->active()
                ->first();
        });
    }

    /**
     * Increment the hit count and update last hit timestamp.
     */
    public function incrementHit(): void
    {
        $this->increment('hit_count');
        $this->update(['last_hit_at' => now()]);
    }

    /**
     * Clear the cache for a specific path.
     */
    public static function clearCacheForPath(string $path): void
    {
        Cache::forget("seo_redirect:" . md5($path));
    }

    protected static function booted(): void
    {
        static::saved(function ($model) {
            // Clear cache when a record is saved
            Cache::forget("seo_redirect:" . md5($model->source_path));
        });

        static::deleted(function ($model) {
            // Clear cache when a record is deleted
            Cache::forget("seo_redirect:" . md5($model->source_path));
        });
    }
}
