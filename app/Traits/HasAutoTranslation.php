<?php

namespace App\Traits;

use App\Models\Translation;
use App\Services\TranslationService;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasAutoTranslation
{
    /**
     * Boot the trait.
     */
    public static function bootHasAutoTranslation(): void
    {
        static::saved(function ($model) {
            // Queue translations when model is saved
            app(TranslationService::class)->queueTranslations($model);
        });

        static::deleted(function ($model) {
            // Clean up translation records when model is deleted
            Translation::where('translatable_type', get_class($model))
                ->where('translatable_id', $model->id)
                ->delete();
        });
    }

    /**
     * Get all translation status records for this model.
     */
    public function translationRecords(): MorphMany
    {
        return $this->morphMany(Translation::class, 'translatable');
    }

    /**
     * Get translation status for a specific locale and optional field.
     */
    public function getTranslationStatus(string $locale, ?string $field = null): ?string
    {
        $query = $this->translationRecords()
            ->where('target_locale', $locale);

        if ($field) {
            $query->where('field', $field);
        }

        $statuses = $query->pluck('status')->unique();

        // Return status priority: in_progress > pending > failed > completed
        if ($statuses->contains('in_progress')) {
            return 'in_progress';
        }
        if ($statuses->contains('pending')) {
            return 'pending';
        }
        if ($statuses->contains('failed')) {
            return 'failed';
        }
        if ($statuses->contains('completed')) {
            return 'completed';
        }

        return null;
    }

    /**
     * Check if translation is pending for a locale.
     */
    public function isTranslationPending(string $locale): bool
    {
        $status = $this->getTranslationStatus($locale);

        return in_array($status, ['pending', 'in_progress']);
    }

    /**
     * Check if auto-translation content exists for a locale.
     * Uses Spatie's hasTranslation internally.
     */
    public function hasAutoTranslatedContent(string $locale): bool
    {
        if (!property_exists($this, 'translatable') || empty($this->translatable)) {
            return false;
        }

        foreach ($this->translatable as $field) {
            // Use Spatie's getTranslation method
            $translation = $this->getTranslation($field, $locale, false);
            if (!empty($translation)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if translation is complete for a locale.
     */
    public function isTranslationComplete(string $locale): bool
    {
        return $this->getTranslationStatus($locale) === 'completed';
    }

    /**
     * Get the source locale attribute.
     */
    public function getSourceLocaleAttribute(): string
    {
        return $this->attributes['source_locale'] ?? config('translation.default_source_locale', 'en');
    }

    /**
     * Get all available translations for display.
     */
    public function getAvailableLocales(): array
    {
        $locales = [$this->source_locale];

        // Add locales that have completed translations
        $completedLocales = $this->translationRecords()
            ->where('status', 'completed')
            ->pluck('target_locale')
            ->unique()
            ->toArray();

        return array_unique(array_merge($locales, $completedLocales));
    }

    /**
     * Should show translation pending notice for current locale.
     */
    public function shouldShowTranslationPendingNotice(): bool
    {
        $currentLocale = app()->getLocale();

        // Don't show notice if viewing in source language
        if ($currentLocale === $this->source_locale) {
            return false;
        }

        // Show notice if translation is pending or doesn't exist
        return !$this->hasAutoTranslatedContent($currentLocale) || $this->isTranslationPending($currentLocale);
    }
}
