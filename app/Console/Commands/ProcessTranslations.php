<?php

namespace App\Console\Commands;

use App\Jobs\ProcessPendingTranslations;
use App\Models\Translation;
use Illuminate\Console\Command;

class ProcessTranslations extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'translations:process
                            {--force : Process even if another job is running}
                            {--status : Show translation status instead of processing}';

    /**
     * The console command description.
     */
    protected $description = 'Process pending translations via Gemini API';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        if ($this->option('status')) {
            return $this->showStatus();
        }

        $pendingCount = Translation::pending()->count();
        $failedCount = Translation::failed()
            ->where('retry_count', '<', config('translation.rate_limiting.max_retries', 3))
            ->count();

        $totalToProcess = $pendingCount + $failedCount;

        if ($totalToProcess === 0) {
            $this->info('No pending translations to process.');
            return Command::SUCCESS;
        }

        $this->info("Found {$pendingCount} pending and {$failedCount} retryable translations.");
        $this->info('Dispatching translation processing job...');

        ProcessPendingTranslations::dispatch();

        $this->info('Translation job dispatched successfully.');

        return Command::SUCCESS;
    }

    /**
     * Show translation status.
     */
    private function showStatus(): int
    {
        $stats = [
            'Pending' => Translation::pending()->count(),
            'In Progress' => Translation::inProgress()->count(),
            'Completed' => Translation::completed()->count(),
            'Failed' => Translation::failed()->count(),
            'Completed Today' => Translation::completed()
                ->whereDate('translated_at', today())
                ->count(),
        ];

        $this->table(['Status', 'Count'], collect($stats)->map(fn ($count, $status) => [$status, $count])->values());

        return Command::SUCCESS;
    }
}
