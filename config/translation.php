<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Translation Provider
    |--------------------------------------------------------------------------
    |
    | Specify which translation provider to use: 'gemini' or 'openrouter'
    |
    */
    'provider' => env('TRANSLATION_PROVIDER', 'gemini'),

    /*
    |--------------------------------------------------------------------------
    | Gemini API Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Google Gemini API used for automatic translations.
    |
    */
    'gemini' => [
        'api_key' => env('GEMINI_API_KEY'),
        'model' => env('GEMINI_MODEL', 'gemini-2.0-flash'),
        'max_tokens' => env('GEMINI_MAX_TOKENS', 8192),
        'temperature' => env('GEMINI_TEMPERATURE', 0.3),
    ],

    /*
    |--------------------------------------------------------------------------
    | OpenRouter API Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for OpenRouter API used for automatic translations.
    | OpenRouter provides access to multiple LLM models via a single API.
    |
    */
    'openrouter' => [
        'api_key' => env('OPENROUTER_API_KEY'),
        'model' => env('OPENROUTER_MODEL', 'google/gemini-2.0-flash-001'),
        'max_tokens' => env('OPENROUTER_MAX_TOKENS', 8192),
        'temperature' => env('OPENROUTER_TEMPERATURE', 0.3),
    ],

    /*
    |--------------------------------------------------------------------------
    | Rate Limiting
    |--------------------------------------------------------------------------
    |
    | Configure rate limiting to avoid hitting API limits.
    |
    */
    'rate_limiting' => [
        'requests_per_minute' => env('TRANSLATION_RPM', 15),
        'max_retries' => env('TRANSLATION_MAX_RETRIES', 3),
        'retry_delay_seconds' => env('TRANSLATION_RETRY_DELAY', 60),
    ],

    /*
    |--------------------------------------------------------------------------
    | Batch Processing
    |--------------------------------------------------------------------------
    |
    | Configure batch processing for scheduled translation jobs.
    |
    */
    'batch' => [
        'chunk_size' => env('TRANSLATION_BATCH_SIZE', 10),
    ],

    /*
    |--------------------------------------------------------------------------
    | Supported Locales
    |--------------------------------------------------------------------------
    |
    | List of locales supported for translation.
    |
    */
    'supported_locales' => ['en', 'vi'],

    /*
    |--------------------------------------------------------------------------
    | Default Source Locale
    |--------------------------------------------------------------------------
    |
    | The default language used when creating new content.
    |
    */
    'default_source_locale' => 'en',
];
