<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Translation extends Model
{
    protected $fillable = [
        'translatable_type',
        'translatable_id',
        'source_locale',
        'target_locale',
        'field',
        'status',
        'error_message',
        'retry_count',
        'translated_at',
    ];

    protected $casts = [
        'translated_at' => 'datetime',
        'retry_count' => 'integer',
    ];

    /**
     * Get the parent translatable model.
     */
    public function translatable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Scope for pending translations.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for failed translations.
     */
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    /**
     * Scope for retryable translations (failed but under max retries).
     */
    public function scopeRetryable($query)
    {
        return $query->where('status', 'failed')
            ->where('retry_count', '<', config('translation.rate_limiting.max_retries', 3));
    }

    /**
     * Scope for in-progress translations.
     */
    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    /**
     * Scope for completed translations.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Mark translation as in progress.
     */
    public function markInProgress(): void
    {
        $this->update(['status' => 'in_progress']);
    }

    /**
     * Mark translation as completed.
     */
    public function markCompleted(): void
    {
        $this->update([
            'status' => 'completed',
            'translated_at' => now(),
            'error_message' => null,
        ]);
    }

    /**
     * Mark translation as failed.
     */
    public function markFailed(string $error): void
    {
        $this->update([
            'status' => 'failed',
            'error_message' => $error,
            'retry_count' => $this->retry_count + 1,
        ]);
    }

    /**
     * Reset for retry.
     */
    public function resetForRetry(): void
    {
        $this->update(['status' => 'pending']);
    }
}
