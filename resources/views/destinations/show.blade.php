@extends('layouts.app')

@section('title', $destination->name)
@section('meta_description', $destination->meta_description ?? Str::limit(strip_tags($destination->description), 160))

@section('content')
    <!-- Hero -->
    <section class="relative h-[50vh] min-h-[400px]">
        <div class="absolute inset-0">
            @if($destination->getFirstMediaUrl('image'))
                <img src="{{ $destination->getFirstMediaUrl('image') }}" alt="{{ $destination->name }}" class="w-full h-full object-cover">
            @else
                <img src="https://picsum.photos/seed/dest{{ $destination->id }}/1920/800" alt="{{ $destination->name }}" class="w-full h-full object-cover">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 pb-12">
            <div class="container mx-auto px-4 text-white">
                <h1 class="text-4xl md:text-5xl font-heading font-bold mb-4">{{ $destination->name }}</h1>
                <p class="text-xl text-gray-200">{{ $tours->total() }} {{ __('messages.tours_available') }}</p>
            </div>
        </div>
    </section>

    <!-- Breadcrumbs -->
    <div class="container mx-auto px-4">
        <x-breadcrumbs :items="[
            ['name' => __('navigation.destinations'), 'url' => route('destinations.index')],
            ['name' => $destination->name]
        ]" />
    </div>

    <!-- Description -->
    @if($destination->description)
        <section class="py-12 bg-white">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto prose prose-lg">
                    {!! $destination->description !!}
                </div>
            </div>
        </section>
    @endif

    <!-- Cities -->
    @if($destination->cities->count())
        <section class="py-12 bg-gray-50">
            <div class="container mx-auto px-4">
                <h2 class="text-2xl font-heading font-bold text-gray-900 mb-8">Popular Cities</h2>
                <div class="flex flex-wrap gap-4">
                    @foreach($destination->cities as $city)
                        <a href="{{ route('tours.index', ['destination' => $destination->slug]) }}" class="px-6 py-3 bg-white rounded-lg shadow-md hover:shadow-lg transition flex items-center gap-2">
                            <svg class="w-5 h-5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            {{ $city->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Tours -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl font-heading font-bold text-gray-900 mb-8">Tours in {{ $destination->name }}</h2>

            @if($tours->count())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($tours as $tour)
                        <x-tour-card :tour="$tour" />
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $tours->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-500 mb-4">No tours available for this destination yet.</p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-500 text-white font-medium rounded-lg hover:bg-primary-600 transition">
                        Request a Custom Tour
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection
