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
        $tours = Tour::active()
            ->ordered()
            ->with(['destination', 'categories']);

        // Filter by destination
        if ($request->filled('destination')) {
            $tours->whereHas('destination', function ($q) use ($request) {
                $q->where('slug', $request->destination);
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $tours->whereHas('categories', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Filter by duration
        if ($request->filled('duration')) {
            match ($request->duration) {
                '1-3' => $tours->whereBetween('duration_days', [1, 3]),
                '4-7' => $tours->whereBetween('duration_days', [4, 7]),
                '8-14' => $tours->whereBetween('duration_days', [8, 14]),
                '15+' => $tours->where('duration_days', '>=', 15),
                default => null,
            };
        }

        $tours = $tours->paginate(12);

        $destinations = Destination::active()->ordered()->get();
        $categories = TourCategory::active()->get();

        return view('tours.index', compact('tours', 'destinations', 'categories'));
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
