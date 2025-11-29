<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    public function show(string $slug)
    {
        $page = Page::findBySlug($slug);

        if (!$page) {
            abort(404);
        }

        // Use specific template if defined
        $template = $page->template ?? 'default';
        $view = "pages.{$template}";

        // Fall back to default template if specific one doesn't exist
        if (!view()->exists($view)) {
            $view = 'pages.show';
        }

        return view($view, compact('page'));
    }
}
