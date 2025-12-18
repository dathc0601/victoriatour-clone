<?php

namespace App\Jobs;

use App\Models\Translation;
use App\Services\TranslationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessPendingTranslations implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 1;
    public int $timeout = 1800; // 30 minutes

    /**
     * Execute the job.
     */
    public function handle(TranslationService $translationService): void
    {
        $batchSize = config('translation.batch.chunk_size', 10);

        Log::info('Starting translation processing job');

        // Get pending translations grouped by model
        $pendingTranslations = Translation::where(function ($query) {
                $query->pending()
                    ->orWhere(function ($q) {
                        $q->where('status', 'failed')
                            ->where('retry_count', '<', config('translation.rate_limiting.max_retries', 3));
                    });
            })
            ->orderBy('created_at')
            ->limit($batchSize * 5) // Get more to account for grouping
            ->get()
            ->groupBy(fn ($t) => $t->translatable_type . ':' . $t->translatable_id . ':' . $t->target_locale);

        $processedCount = 0;

        foreach ($pendingTranslations as $key => $translations) {
            if ($processedCount >= $batchSize) {
                break;
            }

            $firstTranslation = $translations->first();
            $model = $firstTranslation->translatable;

            if (!$model) {
                // Model was deleted, clean up orphaned translations
                Log::info('Cleaning up orphaned translations', [
                    'translatable_type' => $firstTranslation->translatable_type,
                    'translatable_id' => $firstTranslation->translatable_id,
                ]);

                Translation::where('translatable_type', $firstTranslation->translatable_type)
                    ->where('translatable_id', $firstTranslation->translatable_id)
                    ->delete();

                continue;
            }

            $targetLocale = $firstTranslation->target_locale;

            try {
                Log::info('Processing translation', [
                    'model' => $firstTranslation->translatable_type,
                    'id' => $firstTranslation->translatable_id,
                    'target_locale' => $targetLocale,
                ]);

                $translationService->translateModel($model, $targetLocale);
                $processedCount++;

            } catch (\Exception $e) {
                Log::error('Batch translation failed', [
                    'model' => $firstTranslation->translatable_type,
                    'id' => $firstTranslation->translatable_id,
                    'error' => $e->getMessage(),
                ]);
            }

            // Rate limiting pause between models
            usleep(500000); // 0.5 seconds
        }

        Log::info('Translation processing job completed', [
            'processed_count' => $processedCount,
        ]);
    }

    /**
     * Handle job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error('ProcessPendingTranslations job failed', [
            'error' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString(),
        ]);
    }
}
