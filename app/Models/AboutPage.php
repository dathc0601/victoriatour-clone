<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AboutPage extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia;

    protected $table = 'about_page';

    protected $fillable = [
        'hero_category',
        'hero_line1',
        'hero_line2',
        'hero_line3',
        'hero_subtitle',
        'story_title',
        'story_content',
        'mission_title',
        'mission_content',
        'vision_title',
        'vision_content',
        'stat1_number',
        'stat1_label',
        'stat2_number',
        'stat2_label',
        'stat3_number',
        'stat3_label',
        'stat4_number',
        'stat4_label',
        'meta_title',
        'meta_description',
    ];

    public array $translatable = [
        'hero_category',
        'hero_line1',
        'hero_line2',
        'hero_line3',
        'hero_subtitle',
        'story_title',
        'story_content',
        'mission_title',
        'mission_content',
        'vision_title',
        'vision_content',
        'stat1_label',
        'stat2_label',
        'stat3_label',
        'stat4_label',
        'meta_title',
        'meta_description',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('hero_image')->singleFile();
        $this->addMediaCollection('story_image')->singleFile();
        $this->addMediaCollection('mission_image')->singleFile();
        $this->addMediaCollection('vision_image')->singleFile();
    }

    /**
     * Get the singleton instance of the About page content with caching.
     */
    public static function getContent(): self
    {
        return cache()->remember('about_page_content', 3600, function () {
            return self::firstOrCreate([]);
        });
    }

    /**
     * Clear the cached content.
     */
    public static function clearCache(): void
    {
        cache()->forget('about_page_content');
    }
}
