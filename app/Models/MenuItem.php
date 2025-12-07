<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use SolutionForest\FilamentTree\Concern\ModelTree;
use Spatie\Translatable\HasTranslations;

class MenuItem extends Model
{
    use HasFactory, HasTranslations, ModelTree;

    protected $fillable = [
        'parent_id',
        'order',
        'title',
        'type',
        'url',
        'route_name',
        'page_id',
        'icon',
        'target',
        'location',
        'is_active',
    ];

    public array $translatable = ['title'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // ModelTree configuration
    public function determineOrderColumnName(): string
    {
        return 'order';
    }

    public function determineParentColumnName(): string
    {
        return 'parent_id';
    }

    // Relationships
    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')
            ->where('is_active', true)
            ->orderBy('order');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeLocation($query, string $location)
    {
        return $query->where('location', $location);
    }

    public function scopeRootLevel($query)
    {
        return $query->where('parent_id', -1);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    // Helper Methods
    public function getUrl(): ?string
    {
        return match ($this->type) {
            'url' => $this->url,
            'route' => $this->route_name ? route($this->route_name, [], false) : null,
            'page' => $this->page ? url($this->page->slug) : null,
            default => null,
        };
    }

    public function hasChildren(): bool
    {
        return $this->children()->count() > 0;
    }

    // Get cached tree by location
    public static function getTreeByLocation(string $location): Collection
    {
        return cache()->remember(
            "menu_tree_{$location}_" . app()->getLocale(),
            now()->addHours(24),
            fn () => static::query()
                ->active()
                ->location($location)
                ->rootLevel()
                ->ordered()
                ->with(['children' => fn ($q) => $q->active()->ordered()
                    ->with(['children' => fn ($q2) => $q2->active()->ordered()])])
                ->get()
        );
    }

    // Clear cache on model events
    protected static function booted(): void
    {
        $clearCache = function () {
            foreach (['header', 'footer'] as $loc) {
                foreach (['en', 'vi'] as $locale) {
                    cache()->forget("menu_tree_{$loc}_{$locale}");
                }
            }
        };

        static::saved($clearCache);
        static::deleted($clearCache);
    }
}
