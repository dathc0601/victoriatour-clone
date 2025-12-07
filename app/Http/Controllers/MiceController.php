<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\MiceContent;

class MiceController extends Controller
{
    public function index()
    {
        // Get all destinations that have MICE content
        $destinations = Destination::active()
            ->ordered()
            ->whereHas('miceContents', fn($q) => $q->active())
            ->get();

        // Get unique regions for the filter dropdown
        $regions = MiceContent::active()
            ->whereNotNull('region')
            ->where('region', '!=', '')
            ->distinct()
            ->pluck('region')
            ->sort()
            ->values();

        // Delegates filter options
        $delegateRanges = [
            '10-50' => '10 - 50',
            '50-100' => '50 - 100',
            '100-300' => '100 - 300',
            '300-500' => '300 - 500',
            '500+' => '500+',
        ];

        return view('pages.mice', compact('destinations', 'regions', 'delegateRanges'));
    }
}
