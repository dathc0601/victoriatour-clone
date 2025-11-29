@extends('layouts.app')

@section('title', 'Travel Blog')
@section('meta_description', 'Travel tips, guides, and inspiration from Victoria Tour. Discover the best of Southeast Asia.')

@section('content')
    <!-- Page Header -->
    <section class="bg-primary-500 py-16">
        <div class="container mx-auto px-4 text-center text-white">
            <h1 class="text-4xl md:text-5xl font-heading font-bold mb-4">{{ __('navigation.blog') }}</h1>
            <p class="text-xl text-gray-200 max-w-2xl mx-auto">Tips, stories, and guides to inspire your next adventure</p>
        </div>
    </section>

    <!-- Breadcrumbs -->
    <div class="container mx-auto px-4">
        <x-breadcrumbs :items="[
            ['name' => __('navigation.blog')]
        ]" />
    </div>

    <!-- Blog Content -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-3">
                    @if($posts->count())
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($posts as $post)
                                <x-blog-card :post="$post" />
                            @endforeach
                        </div>

                        <div class="mt-12">
                            {{ $posts->withQueryString()->links() }}
                        </div>
                    @else
                        <div class="text-center py-16 bg-white rounded-xl">
                            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            <h3 class="text-xl font-semibold text-gray-700 mb-2">No posts found</h3>
                            <p class="text-gray-500">Check back later for new articles</p>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Categories -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-heading font-bold text-gray-900 mb-4">Categories</h3>
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('blog.index') }}" class="flex items-center justify-between text-gray-600 hover:text-primary-500 transition {{ !request('category') ? 'text-primary-500 font-medium' : '' }}">
                                    All Posts
                                    <span class="text-sm text-gray-400">{{ $posts->total() }}</span>
                                </a>
                            </li>
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('blog.index', ['category' => $category->slug]) }}" class="flex items-center justify-between text-gray-600 hover:text-primary-500 transition {{ request('category') === $category->slug ? 'text-primary-500 font-medium' : '' }}">
                                        {{ $category->name }}
                                        <span class="text-sm text-gray-400">{{ $category->posts_count }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Newsletter -->
                    <div class="bg-primary-500 rounded-xl shadow-md p-6 text-white">
                        <h3 class="text-lg font-heading font-bold mb-2">Newsletter</h3>
                        <p class="text-gray-200 text-sm mb-4">Subscribe for travel tips and exclusive offers</p>
                        <livewire:newsletter-form />
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
