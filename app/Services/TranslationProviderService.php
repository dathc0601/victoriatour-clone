<?php

namespace App\Services;

use App\Contracts\TranslationProviderInterface;
use App\Services\Providers\GeminiProvider;
use App\Services\Providers\OpenRouterProvider;
use InvalidArgumentException;

class TranslationProviderService implements TranslationProviderInterface
{
    private TranslationProviderInterface $provider;

    public function __construct()
    {
        $this->provider = $this->resolveProvider();
    }

    /**
     * Resolve the configured translation provider.
     */
    private function resolveProvider(): TranslationProviderInterface
    {
        $providerName = config('translation.provider', 'gemini');

        return match ($providerName) {
            'gemini' => new GeminiProvider(),
            'openrouter' => new OpenRouterProvider(),
            default => throw new InvalidArgumentException(
                "Unsupported translation provider: {$providerName}. Supported providers: gemini, openrouter"
            ),
        };
    }

    /**
     * Get the current provider name.
     */
    public function getProviderName(): string
    {
        return $this->provider->getProviderName();
    }

    /**
     * Translate text from source locale to target locale.
     */
    public function translate(string $text, string $sourceLocale, string $targetLocale, string $context = ''): ?string
    {
        return $this->provider->translate($text, $sourceLocale, $targetLocale, $context);
    }

    /**
     * Translate with automatic retry on rate limit.
     */
    public function translateWithRetry(string $text, string $sourceLocale, string $targetLocale, string $context = '', int $maxRetries = 3): ?string
    {
        return $this->provider->translateWithRetry($text, $sourceLocale, $targetLocale, $context, $maxRetries);
    }

    /**
     * Get the underlying provider instance.
     */
    public function getProvider(): TranslationProviderInterface
    {
        return $this->provider;
    }
}
