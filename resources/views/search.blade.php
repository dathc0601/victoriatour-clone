@extends('layouts.app')

@section('title', 'Search Results' . ($query ? ': ' . $query : ''))
@section('meta_description', 'Search results for tours, destinations, and travel blog posts.')

@section('content')
    <!-- Page Header -->
    <section class="bg-primary-500 py-12">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl md:text-4xl font-heading font-bold text-white mb-4">{{ __('navigation.search_results') }}</h1>
            @if($query)
                <p class="text-xl text-gray-200">
                    {{ $totalResults }} result{{ $totalResults !== 1 ? 's' : '' }} for "<span class="text-accent-400">{{ $query }}</span>"
                </p>
            @endif

            <!-- Search Form -->
            <div class="mt-6 max-w-xl">
                <form action="{{ route('search') }}" method="GET" class="flex gap-2">
                    <input
                        type="text"
                        name="q"
                        value="{{ $query }}"
                        placeholder="Search tours, destinations, blog posts..."
                        class="flex-1 px-4 py-3 rounded-lg border-0 focus:ring-2 focus:ring-accent-500"
                    >
                    <button type="submit" class="px-6 py-3 bg-accent-500 text-white font-medium rounded-lg hover:bg-accent-600 transition">
                        Search
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Breadcrumbs -->
    <div class="container mx-auto px-4">
        <x-breadcrumbs :items="[
            ['name' => __('navigation.search')]
        ]" />
    </div>

    <!-- Results -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            @if($query && strlen($query) >= 2)
                <!-- Filter Tabs -->
                <div class="flex flex-wrap gap-2 mb-8">
                    <a href="{{ route('search', ['q' => $query, 'type' => 'all']) }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition {{ $type === 'all' ? 'bg-primary-500 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                        All Results ({{ $totalResults }})
                    </a>
                    <a href="{{ route('search', ['q' => $query, 'type' => 'tours']) }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition {{ $type === 'tours' ? 'bg-primary-500 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                        Tours ({{ $tours instanceof \Illuminate\Pagination\LengthAwarePaginator ? $tours->total() : $tours->count() }})
                    </a>
                    <a href="{{ route('search', ['q' => $query, 'type' => 'destinations']) }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition {{ $type === 'destinations' ? 'bg-primary-500 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                        Destinations ({{ $destinations->count() }})
                    </a>
                    <a href="{{ route('search', ['q' => $query, 'type' => 'blog']) }}"
                       class="px-4 py-2 rounded-full text-sm font-medium transition {{ $type === 'blog' ? 'bg-primary-500 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                        Blog Posts ({{ $posts->count() }})
                    </a>
                </div>

                @if($totalResults > 0)
                    <!-- Destinations Section -->
                    @if(($type === 'all' || $type === 'destinations') && $destinations->count())
                        <div class="mb-12">
                            <h2 class="text-2xl font-heading font-bold text-gray-900 mb-6">Destinations</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($destinations as $destination)
                                    <x-destination-card :destination="$destination" />
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Tours Section -->
                    @if(($type === 'all' || $type === 'tours') && $tours->count())
                        <div class="mb-12">
                            <h2 class="text-2xl font-heading font-bold text-gray-900 mb-6">Tours</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                @foreach($tours as $tour)
                                    <x-tour-card :tour="$tour" />
                                @endforeach
                            </div>
                            @if($tours instanceof \Illuminate\Pagination\LengthAwarePaginator && $tours->hasPages())
                                <div class="mt-8">
                                    {{ $tours->links() }}
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Blog Posts Section -->
                    @if(($type === 'all' || $type === 'blog') && $posts->count())
                        <div class="mb-12">
                            <h2 class="text-2xl font-heading font-bold text-gray-900 mb-6">Blog Posts</h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                @foreach($posts as $post)
                                    <x-blog-card :post="$post" />
                                @endforeach
                            </div>
                        </div>
                    @endif
                @else
                    <!-- No Results -->
                    <div class="text-center py-16">
                        <svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <h2 class="text-2xl font-heading font-bold text-gray-900 mb-2">No results found</h2>
                        <p class="text-gray-500 mb-6">We couldn't find anything matching "{{ $query }}"</p>
                        <div class="space-y-2 text-sm text-gray-500">
                            <p>Suggestions:</p>
                            <ul class="list-disc list-inside">
                                <li>Check your spelling</li>
                                <li>Try different keywords</li>
                                <li>Try more general terms</li>
                            </ul>
                        </div>
                        <div class="mt-8">
                            <a href="{{ route('tours.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-500 text-white font-medium rounded-lg hover:bg-primary-600 transition">
                                Browse All Tours
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endif
            @else
                <!-- No Query -->
                <div class="text-center py-16">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <h2 class="text-2xl font-heading font-bold text-gray-900 mb-2">Start your search</h2>
                    <p class="text-gray-500 mb-6">Enter at least 2 characters to search for tours, destinations, and blog posts.</p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <a href="{{ route('tours.index') }}" class="px-6 py-3 bg-primary-500 text-white font-medium rounded-lg hover:bg-primary-600 transition">
                            Browse Tours
                        </a>
                        <a href="{{ route('destinations.index') }}" class="px-6 py-3 border-2 border-primary-500 text-primary-500 font-medium rounded-lg hover:bg-primary-500 hover:text-white transition">
                            Explore Destinations
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
