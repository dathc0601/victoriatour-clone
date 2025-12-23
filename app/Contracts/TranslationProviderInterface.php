<?php

namespace App\Contracts;

interface TranslationProviderInterface
{
    /**
     * Translate text from source locale to target locale.
     */
    public function translate(string $text, string $sourceLocale, string $targetLocale, string $context = ''): ?string;

    /**
     * Translate with automatic retry on rate limit.
     */
    public function translateWithRetry(string $text, string $sourceLocale, string $targetLocale, string $context = '', int $maxRetries = 3): ?string;

    /**
     * Get the provider name for logging purposes.
     */
    public function getProviderName(): string;
}
