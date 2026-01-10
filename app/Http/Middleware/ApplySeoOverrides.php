<?php

namespace App\Http\Middleware;

use App\Models\SeoPageOverride;
use App\Models\SeoRedirect;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplySeoOverrides
{
    /**
     * Handle an incoming request.
     *
     * Priority:
     * 1. Check for redirects first
     * 2. Check for SEO overrides
     * 3. Share override data with views
     */
    public function handle(Request $request, Closure $next): Response
    {
        $path = '/' . ltrim($request->path(), '/');

        // Skip for admin panel and API routes
        if (str_starts_with($path, '/admin') || str_starts_with($path, '/api')) {
            return $next($request);
        }

        // Check for redirects first
        $redirect = SeoRedirect::findForPath($path);
        if ($redirect) {
            // Increment hit count
            $redirect->incrementHit();

            // Perform redirect
            return redirect($redirect->target_url, $redirect->status_code);
        }

        // Check for SEO overrides
        $seoOverride = SeoPageOverride::findForPath($path);
        if ($seoOverride) {
            // Share SEO override with all views
            view()->share('seoOverride', $seoOverride);
        }

        return $next($request);
    }
}
