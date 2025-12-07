<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\Translatable\HasTranslations;

class FooterColumn extends Model
{
    use HasFactory, HasTranslations;

    // Column Types
    public const TYPE_LOGO_CONTACT = 'logo_contact';
    public const TYPE_DESTINATIONS = 'destinations';
    public const TYPE_MENU_LINKS = 'menu_links';
    public const TYPE_NEWSLETTER_SOCIAL = 'newsletter_social';
    public const TYPE_CUSTOM_HTML = 'custom_html';

    protected $fillable = [
        'title',
        'type',
        'settings',
        'order',
        'width',
        'is_active',
    ];

    public array $translatable = ['title'];

    protected $casts = [
        'settings' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get available column types.
     */
    public static function getTypes(): array
    {
        return [
            self::TYPE_LOGO_CONTACT => 'Logo & Contact Info',
            self::TYPE_DESTINATIONS => 'Destinations',
            self::TYPE_MENU_LINKS => 'Menu Links',
            self::TYPE_NEWSLETTER_SOCIAL => 'Newsletter & Social',
            self::TYPE_CUSTOM_HTML => 'Custom HTML/Content',
        ];
    }

    /**
     * Get icon for each column type.
     */
    public static function getTypeIcon(string $type): string
    {
        return match ($type) {
            self::TYPE_LOGO_CONTACT => 'heroicon-o-building-office',
            self::TYPE_DESTINATIONS => 'heroicon-o-map-pin',
            self::TYPE_MENU_LINKS => 'heroicon-o-link',
            self::TYPE_NEWSLETTER_SOCIAL => 'heroicon-o-envelope',
            self::TYPE_CUSTOM_HTML => 'heroicon-o-code-bracket',
            default => 'heroicon-o-rectangle-stack',
        };
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    /**
     * Get cached footer columns for frontend rendering.
     */
    public static function getCachedColumns(): Collection
    {
        return cache()->remember(
            'footer_columns_' . app()->getLocale(),
            now()->addHours(24),
            fn () => static::active()->ordered()->get()
        );
    }

    /**
     * Clear cache on model events.
     */
    protected static function booted(): void
    {
        $clearCache = function () {
            foreach (['en', 'vi'] as $locale) {
                cache()->forget("footer_columns_{$locale}");
            }
        };

        static::saved($clearCache);
        static::deleted($clearCache);
    }
}
