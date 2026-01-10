<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    /**
     * Serve the robots.txt file from settings.
     */
    public function robots(): Response
    {
        $defaultContent = "User-agent: *\nAllow: /\n\nSitemap: " . url('/sitemap.xml');
        $content = Setting::get('seo_robots_txt', $defaultContent);

        return response($content)
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }
}
