<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Destination;
use App\Models\Differentiator;
use App\Models\Slider;
use App\Models\Tour;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::active()->ordered()->get();

        $differentiators = Differentiator::active()->ordered()->get();

        $featuredDestinations = Destination::active()
            ->featured()
            ->ordered()
            ->take(6)
            ->get();

        $featuredTours = Tour::active()
            ->featured()
            ->ordered()
            ->with(['destination', 'categories'])
            ->take(8)
            ->get();

        $latestPosts = BlogPost::active()
            ->with('category')
            ->latest('published_at')
            ->take(4)
            ->get();

        return view('home', compact(
            'sliders',
            'differentiators',
            'featuredDestinations',
            'featuredTours',
            'latestPosts'
        ));
    }
}
