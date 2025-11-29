<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Destination;
use App\Models\Page;
use App\Models\Tour;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $tours = Tour::active()->select(['slug', 'updated_at'])->get();
        $destinations = Destination::active()->select(['slug', 'updated_at'])->get();
        $posts = BlogPost::active()->select(['slug', 'updated_at'])->get();
        $pages = Page::active()->select(['slug', 'updated_at'])->get();

        $content = view('sitemap.index', compact('tours', 'destinations', 'posts', 'pages'));

        return response($content)
            ->header('Content-Type', 'application/xml');
    }

    public function tours(): Response
    {
        $tours = Tour::active()->select(['slug', 'updated_at'])->get();

        $content = view('sitemap.tours', compact('tours'));

        return response($content)
            ->header('Content-Type', 'application/xml');
    }

    public function destinations(): Response
    {
        $destinations = Destination::active()->select(['slug', 'updated_at'])->get();

        $content = view('sitemap.destinations', compact('destinations'));

        return response($content)
            ->header('Content-Type', 'application/xml');
    }

    public function blog(): Response
    {
        $posts = BlogPost::active()->select(['slug', 'updated_at'])->get();

        $content = view('sitemap.blog', compact('posts'));

        return response($content)
            ->header('Content-Type', 'application/xml');
    }

    public function pages(): Response
    {
        $pages = Page::active()->select(['slug', 'updated_at'])->get();

        $content = view('sitemap.pages', compact('pages'));

        return response($content)
            ->header('Content-Type', 'application/xml');
    }
}
