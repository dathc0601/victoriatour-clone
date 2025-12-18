<?php

namespace App\Jobs;

use App\Models\Language;
use App\Services\TranslationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class TranslateModel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public int $backoff = 60;
    public int $timeout = 600; // 10 minutes

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Model $model,
        public ?string $targetLocale = null
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
            $translationService->translateModel($this->model, $this->targetLocale);
            return;
        }

        // Otherwise, translate to all target locales
        $sourceLocale = $this->model->source_locale ?? config('translation.default_source_locale', 'en');
        $targetLocales = Language::active()
            ->where('code', '!=', $sourceLocale)
            ->pluck('code');

        foreach ($targetLocales as $locale) {
            try {
                $translationService->translateModel($this->model, $locale);

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
