<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\RequestException;

class GeminiService
{
    private string $apiKey;
    private string $model;
    private string $baseUrl = 'https://generativelanguage.googleapis.com/v1beta';

    public function __construct()
    {
        $this->apiKey = config('translation.gemini.api_key', '');
        $this->model = config('translation.gemini.model', 'gemini-2.0-flash');
    }

    /**
     * Translate text from source locale to target locale.
     */
    public function translate(string $text, string $sourceLocale, string $targetLocale, string $context = ''): ?string
    {
        if (empty(trim($text))) {
            return '';
        }

        if (empty($this->apiKey)) {
            throw new \Exception('Gemini API key is not configured');
        }

        $this->checkRateLimit();

        $prompt = $this->buildTranslationPrompt($text, $sourceLocale, $targetLocale, $context);

        try {
            $response = Http::timeout(120)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->post("{$this->baseUrl}/models/{$this->model}:generateContent?key={$this->apiKey}", [
                    'contents' => [
                        ['parts' => [['text' => $prompt]]]
                    ],
                    'generationConfig' => [
                        'temperature' => config('translation.gemini.temperature', 0.3),
                        'maxOutputTokens' => config('translation.gemini.max_tokens', 8192),
                    ],
                ]);

            if ($response->successful()) {
                $this->recordRequest();
                $translation = $this->extractTranslation($response->json());

                if ($translation === null) {
                    Log::warning('Gemini API returned empty translation', [
                        'source_locale' => $sourceLocale,
                        'target_locale' => $targetLocale,
                        'response' => $response->json(),
                    ]);
                }

                return $translation;
            }

            $errorBody = $response->json();
            $errorMessage = $errorBody['error']['message'] ?? $response->body();
            $errorStatus = $errorBody['error']['status'] ?? 'UNKNOWN';

            Log::error('Gemini API error', [
                'http_status' => $response->status(),
                'error_status' => $errorStatus,
                'error_message' => $errorMessage,
                'source_locale' => $sourceLocale,
                'target_locale' => $targetLocale,
                'text_length' => strlen($text),
                'model' => $this->model,
                'full_response' => $errorBody,
            ]);

            // Provide more specific error messages
            $statusMessage = match($response->status()) {
                429 => 'Rate limit exceeded. Please wait before retrying.',
                400 => 'Bad request: ' . $errorMessage,
                401 => 'Invalid API key. Please check your GEMINI_API_KEY.',
                403 => 'API key does not have permission for this operation.',
                404 => 'Model not found: ' . $this->model,
                500, 502, 503 => 'Gemini API server error. Please try again later.',
                default => $errorMessage,
            };

            throw new \Exception("Gemini API error ({$response->status()}): {$statusMessage}");

        } catch (RequestException $e) {
            Log::error('Gemini API request failed', [
                'error' => $e->getMessage(),
                'source_locale' => $sourceLocale,
                'target_locale' => $targetLocale,
                'text_length' => strlen($text),
            ]);
            throw $e;
        }
    }

    /**
     * Translate with automatic retry on rate limit.
     */
    public function translateWithRetry(string $text, string $sourceLocale, string $targetLocale, string $context = '', int $maxRetries = 3): ?string
    {
        $attempt = 0;
        $lastException = null;

        while ($attempt < $maxRetries) {
            try {
                return $this->translate($text, $sourceLocale, $targetLocale, $context);
            } catch (\Exception $e) {
                $lastException = $e;
                $attempt++;

                // If it's a rate limit error, wait and retry
                if (str_contains($e->getMessage(), '429') || str_contains($e->getMessage(), 'Rate limit')) {
                    $waitSeconds = min(60 * $attempt, 180); // 60s, 120s, 180s max
                    Log::warning("Rate limit hit, waiting {$waitSeconds}s before retry {$attempt}/{$maxRetries}");
                    sleep($waitSeconds);
                } else {
                    // For other errors, don't retry
                    throw $e;
                }
            }
        }

        throw $lastException;
    }

    /**
     * Build the translation prompt.
     */
    private function buildTranslationPrompt(string $text, string $source, string $target, string $context): string
    {
        $sourceLanguage = $this->getLanguageName($source);
        $targetLanguage = $this->getLanguageName($target);

        $contextNote = $context
            ? "You are translating {$context} for Victoria Tour, a travel/tourism company specializing in Vietnam tours."
            : "You are translating content for Victoria Tour, a travel/tourism company.";

        return <<<PROMPT
{$contextNote}

Translate the following from {$sourceLanguage} to {$targetLanguage}.

## CRITICAL RULES - MUST FOLLOW:

### 1. OUTPUT FORMAT
- Return ONLY the translated text
- Do NOT include phrases like "Here is the translation:", "Translation:", or any preamble
- Do NOT add notes, explanations, or commentary
- Do NOT wrap output in code blocks or quotes
- Maintain the EXACT same format as input (HTML stays HTML, plain text stays plain text)

### 2. HTML PRESERVATION (VERY IMPORTANT)
Preserve ALL HTML exactly, including:
- Tags: <p>, <div>, <span>, <strong>, <em>, <b>, <i>, <u>, <br>, <hr>
- Headings: <h1> through <h6>
- Lists: <ul>, <ol>, <li>
- Links: <a href="..."> - translate link text, keep href unchanged
- Images: <img src="..." alt="..."> - translate alt text only, keep src/class/style unchanged
- Tables: <table>, <thead>, <tbody>, <tr>, <th>, <td>
- Media: <iframe>, <video>, <audio> - keep completely unchanged
- Attributes: class, id, style, data-* - keep unchanged
- HTML entities: &nbsp; &amp; &lt; &gt; &quot; &#123; - keep as-is

### 3. DO NOT TRANSLATE (keep exactly as-is):
- URLs and links (http://, https://, mailto:, tel:)
- Email addresses
- Phone numbers (keep format: +84 xxx xxx xxx)
- Code snippets and technical markup
- File paths and filenames
- CSS class names and IDs
- JavaScript code
- Coordinates (21.0285° N, 105.8542° E)
- Social media handles (@username)

### 4. NUMBERS & MEASUREMENTS
- Keep numbers as-is: 100, 1,500, 3.5
- Keep currencies with original format: \$100, €50, 1,500,000 VND
- Keep measurements: 100km, 50m², 25°C, 1,200m
- Keep durations format: 3 days 2 nights, 4D3N
- Keep ratings: 4.5/5, ★★★★★, 9.2/10
- Keep dates in original format
- Keep flight numbers: VN123, QR456

### 5. TRAVEL/TOURISM TERMS
- Translate common terms naturally (tour, hotel, resort, beach, temple, etc.)
- Keep Vietnamese place names with proper diacritics:
  - Hà Nội (not Ha Noi or Hanoi when translating TO Vietnamese)
  - Hồ Chí Minh, Đà Nẵng, Huế, Hội An, Sapa, Phú Quốc, Nha Trang, Hạ Long
- Keep brand names: Victoria Tour, specific hotel names, airline names
- Keep UNESCO World Heritage Site names recognizable
- Translate visa terms appropriately (E-visa, Visa on Arrival → Thị thực điện tử, Thị thực tại sân bay)

### 6. LANGUAGE QUALITY
- Use natural, fluent {$targetLanguage} that sounds native
- Match the original tone (formal/informal, professional/friendly)
- For Vietnamese: ensure correct diacritics (ă, â, đ, ê, ô, ơ, ư, and tone marks)
- Preserve paragraph structure and line breaks
- Keep emoji and special symbols unchanged: 🌴 ✈️ 🏨 ⭐

### 7. EDGE CASES
- Empty alt="" attributes: keep empty
- Self-closing tags: <br/>, <hr/>, <img/> - preserve format
- Nested tags: translate text content only, preserve structure
- Mixed language content: translate what should be translated, keep what should stay

---
TEXT TO TRANSLATE:
{$text}
---
PROMPT;
    }

    /**
     * Extract translation from API response.
     */
    private function extractTranslation(array $response): ?string
    {
        return $response['candidates'][0]['content']['parts'][0]['text'] ?? null;
    }

    /**
     * Get human-readable language name.
     */
    private function getLanguageName(string $code): string
    {
        return match($code) {
            'en' => 'English',
            'vi' => 'Vietnamese',
            'zh' => 'Chinese',
            'ja' => 'Japanese',
            'ko' => 'Korean',
            'th' => 'Thai',
            'fr' => 'French',
            'de' => 'German',
            'es' => 'Spanish',
            'it' => 'Italian',
            'ru' => 'Russian',
            'ar' => 'Arabic',
            'id' => 'Indonesian',
            default => $code,
        };
    }

    /**
     * Check rate limit before making request.
     */
    private function checkRateLimit(): void
    {
        $key = 'gemini_requests_' . now()->format('Y-m-d-H-i');
        $requests = Cache::get($key, 0);
        $limit = config('translation.rate_limiting.requests_per_minute', 15);

        if ($requests >= $limit) {
            $waitSeconds = 60 - now()->second;
            Log::info("Rate limit reached, waiting {$waitSeconds} seconds");
            sleep($waitSeconds > 0 ? $waitSeconds : 1);
        }
    }

    /**
     * Record a request for rate limiting.
     */
    private function recordRequest(): void
    {
        $key = 'gemini_requests_' . now()->format('Y-m-d-H-i');
        Cache::put($key, Cache::get($key, 0) + 1, 120);
    }
}
