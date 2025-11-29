<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Destination;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q', '');
        $type = $request->input('type', 'all');
        $locale = app()->getLocale();

        $tours = collect();
        $destinations = collect();
        $posts = collect();

        if (strlen($query) >= 2) {
            $searchTerm = '%' . $query . '%';

            // Search Tours (search in both current locale and fallback)
            if ($type === 'all' || $type === 'tours') {
                $tours = Tour::active()
                    ->where(function ($q) use ($searchTerm, $locale) {
                        $q->whereRaw("json_extract(title, '$." . $locale . "') LIKE ?", [$searchTerm])
                          ->orWhereRaw("json_extract(excerpt, '$." . $locale . "') LIKE ?", [$searchTerm])
                          ->orWhereRaw("json_extract(description, '$." . $locale . "') LIKE ?", [$searchTerm])
                          ->orWhereRaw("json_extract(title, '$.en') LIKE ?", [$searchTerm])
                          ->orWhereRaw("json_extract(excerpt, '$.en') LIKE ?", [$searchTerm])
                          ->orWhereRaw("json_extract(description, '$.en') LIKE ?", [$searchTerm]);
                    })
                    ->with(['destination', 'categories'])
                    ->paginate(12)
                    ->appends($request->query());
            }

            // Search Destinations
            if ($type === 'all' || $type === 'destinations') {
                $destinations = Destination::active()
                    ->where(function ($q) use ($searchTerm, $locale) {
                        $q->whereRaw("json_extract(name, '$." . $locale . "') LIKE ?", [$searchTerm])
                          ->orWhereRaw("json_extract(description, '$." . $locale . "') LIKE ?", [$searchTerm])
                          ->orWhereRaw("json_extract(name, '$.en') LIKE ?", [$searchTerm])
                          ->orWhereRaw("json_extract(description, '$.en') LIKE ?", [$searchTerm]);
                    })
                    ->get();
            }

            // Search Blog Posts
            if ($type === 'all' || $type === 'blog') {
                $posts = BlogPost::active()
                    ->where(function ($q) use ($searchTerm, $locale) {
                        $q->whereRaw("json_extract(title, '$." . $locale . "') LIKE ?", [$searchTerm])
                          ->orWhereRaw("json_extract(excerpt, '$." . $locale . "') LIKE ?", [$searchTerm])
                          ->orWhereRaw("json_extract(content, '$." . $locale . "') LIKE ?", [$searchTerm])
                          ->orWhereRaw("json_extract(title, '$.en') LIKE ?", [$searchTerm])
                          ->orWhereRaw("json_extract(excerpt, '$.en') LIKE ?", [$searchTerm])
                          ->orWhereRaw("json_extract(content, '$.en') LIKE ?", [$searchTerm]);
                    })
                    ->with('category')
                    ->get();
            }
        }

        $totalResults = ($type === 'all' || $type === 'tours' ? ($tours instanceof \Illuminate\Pagination\LengthAwarePaginator ? $tours->total() : $tours->count()) : 0)
            + ($type === 'all' || $type === 'destinations' ? $destinations->count() : 0)
            + ($type === 'all' || $type === 'blog' ? $posts->count() : 0);

        return view('search', compact('query', 'type', 'tours', 'destinations', 'posts', 'totalResults'));
    }
}
