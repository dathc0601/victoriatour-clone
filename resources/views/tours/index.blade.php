@extends('layouts.app')

@section('title', 'Tours')
@section('meta_description', 'Explore our curated collection of tours across Southeast Asia. Find your perfect adventure with Victoria Tour.')

@section('content')
    <!-- Page Header -->
    <section class="bg-primary-500 py-16">
        <div class="container mx-auto px-4 text-center text-white">
            <h1 class="text-4xl md:text-5xl font-heading font-bold mb-4">{{ __('navigation.tours') }}</h1>
            <p class="text-xl text-gray-200 max-w-2xl mx-auto">Discover handcrafted journeys designed to give you extraordinary travel experiences</p>
        </div>
    </section>

    <!-- Breadcrumbs -->
    <div class="container mx-auto px-4">
        <x-breadcrumbs :items="[
            ['name' => __('navigation.tours')]
        ]" />
    </div>

    <!-- Filters & Tours -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <livewire:tour-filter />
        </div>
    </section>
@endsection
