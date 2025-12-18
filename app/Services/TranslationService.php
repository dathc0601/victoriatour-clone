<?php

namespace App\Services;

use App\Models\Translation;
use App\Models\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class TranslationService
{
    public function __construct(
        private GeminiService $gemini
    ) {}

    /**
     * Queue translations for a model.
     * Creates pending translation records for all target locales.
     */
    public function queueTranslations(Model $model): void
    {
        if (!$this->isTranslatable($model)) {
            return;
        }

        $sourceLocale = $model->source_locale ?? config('translation.default_source_locale', 'en');
        $targetLocales = $this->getTargetLocales($sourceLocale);
        $translatableFields = $model->translatable ?? [];

        foreach ($targetLocales as $targetLocale) {
            foreach ($translatableFields as $field) {
                $sourceContent = $model->getTranslation($field, $sourceLocale, false);

                // Skip if no source content
                if (empty($sourceContent)) {
                    continue;
                }

                // Check if translation already exists and is completed
                $existingTranslation = Translation::where([
                    'translatable_type' => get_class($model),
                    'translatable_id' => $model->id,
                    'target_locale' => $targetLocale,
                    'field' => $field,
                ])->first();

                // If translation exists and is completed, check if source changed
                if ($existingTranslation && $existingTranslation->status === 'completed') {
                    // Get the current translation
                    $currentTranslation = $model->getTranslation($field, $targetLocale, false);

                    // If there's already a translation and source hasn't changed significantly, skip
                    if (!empty($currentTranslation)) {
                        continue;
                    }
                }

                Translation::updateOrCreate(
                    [
                        'translatable_type' => get_class($model),
                        'translatable_id' => $model->id,
                        'target_locale' => $targetLocale,
                        'field' => $field,
                    ],
                    [
                        'source_locale' => $sourceLocale,
                        'status' => 'pending',
                        'error_message' => null,
                    ]
                );
            }
        }
    }

    /**
     * Translate a model to a specific target locale.
     */
    public function translateModel(Model $model, string $targetLocale): bool
    {
        if (!$this->isTranslatable($model)) {
            return false;
        }

        $sourceLocale = $model->source_locale ?? config('translation.default_source_locale', 'en');
        $translatableFields = $model->translatable ?? [];
        $modelType = class_basename($model);
        $allSuccessful = true;

        foreach ($translatableFields as $field) {
            $translation = Translation::where([
                'translatable_type' => get_class($model),
                'translatable_id' => $model->id,
                'target_locale' => $targetLocale,
                'field' => $field,
            ])->first();

            // Skip if already completed
            if ($translation && $translation->status === 'completed') {
                continue;
            }

            // Create translation record if it doesn't exist
            if (!$translation) {
                $translation = Translation::create([
                    'translatable_type' => get_class($model),
                    'translatable_id' => $model->id,
                    'source_locale' => $sourceLocale,
                    'target_locale' => $targetLocale,
                    'field' => $field,
                    'status' => 'pending',
                ]);
            }

            $translation->markInProgress();

            try {
                $sourceContent = $model->getTranslation($field, $sourceLocale, false);

                if (empty($sourceContent)) {
                    $translation->markCompleted();
                    continue;
                }

                $translatedContent = $this->gemini->translateWithRetry(
                    $sourceContent,
                    $sourceLocale,
                    $targetLocale,
                    "{$modelType} {$field}"
                );

                if ($translatedContent) {
                    $model->setTranslation($field, $targetLocale, $translatedContent);
                    $model->saveQuietly(); // Avoid triggering the saved event again
                    $translation->markCompleted();

                    Log::info('Translation completed', [
                        'model' => get_class($model),
                        'id' => $model->id,
                        'field' => $field,
                        'target_locale' => $targetLocale,
                    ]);
                } else {
                    $translation->markFailed('Empty translation returned');
                    $allSuccessful = false;
                }

            } catch (\Exception $e) {
                Log::error('Translation failed', [
                    'model' => get_class($model),
                    'id' => $model->id,
                    'field' => $field,
                    'error' => $e->getMessage(),
                ]);
                $translation->markFailed($e->getMessage());
                $allSuccessful = false;
            }

            // Small delay between field translations to avoid rate limiting
            usleep(100000); // 0.1 seconds
        }

        return $allSuccessful;
    }

    /**
     * Check if a model is translatable.
     */
    private function isTranslatable(Model $model): bool
    {
        return method_exists($model, 'getTranslatableAttributes')
            && !empty($model->translatable);
    }

    /**
     * Get target locales for translation.
     */
    private function getTargetLocales(string $sourceLocale): array
    {
        return Language::active()
            ->where('code', '!=', $sourceLocale)
            ->pluck('code')
            ->toArray();
    }
}
