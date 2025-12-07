<?php

namespace App\Http\Controllers;

use App\Models\Destination;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::active()
            ->ordered()
            ->withCount(['tours' => function ($q) {
                $q->where('is_active', true);
            }])
            ->get();

        return view('destinations.index', compact('destinations'));
    }

    public function show(string $slug)
    {
        $destination = Destination::where('slug', $slug)
            ->active()
            ->with([
                'cities' => fn($q) => $q->where('is_active', true)->withCount(['tours' => fn($tq) => $tq->active()]),
                'visa',
                'policy',
            ])
            ->firstOrFail();

        $tours = $destination->tours()
            ->active()
            ->ordered()
            ->with('categories')
            ->take(12)
            ->get();

        $hotels = $destination->hotels()
            ->active()
            ->ordered()
            ->take(8)
            ->get();

        return view('destinations.show', compact('destination', 'tours', 'hotels'));
    }
}
