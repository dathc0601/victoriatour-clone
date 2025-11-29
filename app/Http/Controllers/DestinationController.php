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
            ->with(['cities' => function ($q) {
                $q->where('is_active', true);
            }])
            ->firstOrFail();

        $tours = $destination->tours()
            ->active()
            ->ordered()
            ->with('categories')
            ->paginate(12);

        return view('destinations.show', compact('destination', 'tours'));
    }
}
