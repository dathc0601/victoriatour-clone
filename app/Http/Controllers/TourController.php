<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Tour;
use App\Models\TourCategory;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index(Request $request)
    {
        // Redirect old query param URLs to new route structure
        if ($request->has('destination')) {
            return redirect()->route('tours.destination', $request->destination);
        }

        $destinations = Destination::active()->ordered()->get();
        $categories = TourCategory::active()->get();

        // Get featured tours for bento grid (only on main page)
        $featuredTours = Tour::active()
            ->featured()
            ->with(['destination', 'categories'])
            ->take(4)
            ->get();

        return view('tours.index', [
            'destinations' => $destinations,
            'categories' => $categories,
            'featuredTours' => $featuredTours,
            'activeDestination' => null,
        ]);
    }

    public function byDestination(string $destination)
    {
        $activeDestination = Destination::where('slug', $destination)
            ->active()
            ->firstOrFail();

        $destinations = Destination::active()->ordered()->get();
        $categories = TourCategory::active()->get();

        return view('tours.index', [
            'destinations' => $destinations,
            'categories' => $categories,
            'featuredTours' => collect(),
            'activeDestination' => $activeDestination,
        ]);
    }

    public function show(string $slug)
    {
        $tour = Tour::where('slug', $slug)
            ->active()
            ->with(['destination', 'city', 'categories'])
            ->firstOrFail();

        $relatedTours = Tour::active()
            ->where('id', '!=', $tour->id)
            ->where(function ($q) use ($tour) {
                $q->where('destination_id', $tour->destination_id)
                    ->orWhereHas('categories', function ($cq) use ($tour) {
                        $cq->whereIn('tour_categories.id', $tour->categories->pluck('id'));
                    });
            })
            ->take(4)
            ->get();

        return view('tours.show', compact('tour', 'relatedTours'));
    }
}
