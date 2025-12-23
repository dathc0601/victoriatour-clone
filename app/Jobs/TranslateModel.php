<?php

namespace App\Jobs;

use App\Models\Language;
use App\Services\TranslationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class TranslateModel implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $backoff = 600; // 10 minutes between retries
    public int $timeout = 600; // 10 minutes
    public int $uniqueFor = 86400; // 24 hours - prevent re-queueing same post

    /**
     * Unique ID for the job (prevents duplicates in queue).
     *
     * For force translations (manual "Translate Now"), include timestamp
     * to allow each click to queue new jobs. Automatic translations
     * use stable IDs to prevent duplicates.
     */
    public function uniqueId(): string
    {
        $modelClass = get_class($this->model);
        $modelId = $this->model->id;
        $locale = $this->targetLocale ?? 'all';

        // For force translations, add timestamp to make each dispatch unique
        if ($this->force) {
            return "{$modelClass}:{$modelId}:{$locale}:force:" . now()->timestamp;
        }

        return "{$modelClass}:{$modelId}:{$locale}:normal";
    }

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Model $model,
        public ?string $targetLocale = null,
        public bool $force = false
    ) {}

    /**
     * Execute the job.
     */
    public function handle(TranslationService $translationService): void
    {
        $modelClass = get_class($this->model);
        $modelId = $this->model->id;

        Log::info('TranslateModel job started', [
            'model' => $modelClass,
            'id' => $modelId,
            'target_locale' => $this->targetLocale,
        ]);

        // If specific locale provided, translate to that locale only
        if ($this->targetLocale) {
            $translationService->translateModel($this->model, $this->targetLocale, $this->force);
            return;
        }

        // Otherwise, translate to all target locales
        $sourceLocale = $this->model->source_locale ?? config('translation.default_source_locale', 'en');
        $targetLocales = Language::active()
            ->where('code', '!=', $sourceLocale)
            ->pluck('code');

        foreach ($targetLocales as $locale) {
            try {
                $translationService->translateModel($this->model, $locale, $this->force);

                // Small delay between locales
                usleep(500000); // 0.5 seconds

            } catch (\Exception $e) {
                Log::error('TranslateModel failed for locale', [
                    'model' => $modelClass,
                    'id' => $modelId,
                    'locale' => $locale,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        Log::info('TranslateModel job completed', [
            'model' => $modelClass,
            'id' => $modelId,
        ]);
    }

    /**
     * Handle job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('TranslateModel job failed', [
            'model' => get_class($this->model),
            'id' => $this->model->id,
            'target_locale' => $this->targetLocale,
            'error' => $exception->getMessage(),
        ]);
    }
}
