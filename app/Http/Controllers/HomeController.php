<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\City;
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

        // Get cities ordered by their most recent tour's created_at
        $featuredCities = City::active()
            ->whereHas('tours', fn($q) => $q->active())
            ->with(['destination', 'tours' => fn($q) => $q->active()->latest()->limit(1)])
            ->withCount(['tours' => fn($q) => $q->active()])
            ->get()
            ->sortByDesc(fn($city) => $city->tours->first()?->created_at)
            ->take(6)
            ->values();

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
            'featuredCities',
            'featuredTours',
            'latestPosts'
        ));
    }
}
