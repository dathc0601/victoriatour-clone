<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\MiceController;
use App\Http\Controllers\AboutController;
use Illuminate\Support\Facades\Route;

// Sitemap
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Tours
Route::get('/tours', [TourController::class, 'index'])->name('tours.index');
Route::get('/tours/destination/{destination}', [TourController::class, 'byDestination'])->name('tours.destination');
Route::get('/tours/{slug}', [TourController::class, 'show'])->name('tours.show');

// Destinations
Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/{destination}', [DestinationController::class, 'show'])->name('destinations.show');
Route::get('/destinations/{destination}/{city}', [DestinationController::class, 'showCity'])->name('destinations.city');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Contact
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// MICE (Meetings, Incentives, Conferences, Exhibitions)
Route::get('/mice', [MiceController::class, 'index'])->name('mice.index');

// About Page
Route::get('/about', [AboutController::class, 'show'])->name('about');

// Dynamic Pages (About, etc.) - MUST be last to avoid route conflicts
Route::get('/{slug}', [PageController::class, 'show'])->name('pages.show');
