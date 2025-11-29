<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Priority: 1. Query param, 2. Session, 3. Default language
        $locale = $request->query('lang');

        if ($locale) {
            // Validate against active languages
            $validLocale = Language::where('code', $locale)
                ->where('is_active', true)
                ->exists();

            if ($validLocale) {
                session(['locale' => $locale]);
            } else {
                $locale = null;
            }
        }

        // Fall back to session
        if (!$locale) {
            $locale = session('locale');
        }

        // Fall back to default language
        if (!$locale) {
            $defaultLanguage = Language::where('is_default', true)
                ->where('is_active', true)
                ->first();

            $locale = $defaultLanguage?->code ?? config('app.locale', 'en');
        }

        // Set the application locale
        app()->setLocale($locale);

        // Share current language with all views
        $currentLanguage = Language::where('code', $locale)->first();
        view()->share('currentLocale', $locale);
        view()->share('currentLanguage', $currentLanguage);

        return $next($request);
    }
}
