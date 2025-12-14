<?php

namespace App\Filament\Widgets;

use App\Models\BlogPost;
use App\Models\Destination;
use App\Models\Inquiry;
use App\Models\Page;
use App\Models\Tour;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $newInquiries = Inquiry::new()->count();
        $totalInquiries = Inquiry::count();
        $tourBookings = Inquiry::tourBooking()->count();
        $newsletterSignups = Inquiry::newsletter()->count();

        $activeTours = Tour::active()->count();
        $activeDestinations = Destination::active()->count();
        $publishedPosts = BlogPost::published()->count();
        $activePages = Page::where('is_active', true)->count();

        return [
            // Row 1 - Inquiries (Business Critical)
            Stat::make(__('admin.stats.new_inquiries'), $newInquiries)
                ->description(__('admin.stats.pending_response'))
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning')
                ->chart([7, 3, 4, 5, 6, 3, 5])
                ->url(route('filament.admin.resources.inquiries.index', ['tableFilters[status][value]' => 'new'])),

            Stat::make(__('admin.stats.total_inquiries'), $totalInquiries)
                ->description(__('admin.stats.all_time'))
                ->descriptionIcon('heroicon-m-inbox')
                ->color('primary')
                ->url(route('filament.admin.resources.inquiries.index')),

            Stat::make(__('admin.stats.tour_bookings'), $tourBookings)
                ->description(__('admin.stats.booking_requests'))
                ->descriptionIcon('heroicon-m-ticket')
                ->color('success')
                ->url(route('filament.admin.resources.inquiries.index', ['tableFilters[type][value]' => 'tour_booking'])),

            Stat::make(__('admin.stats.newsletter_signups'), $newsletterSignups)
                ->description(__('admin.stats.subscribers'))
                ->descriptionIcon('heroicon-m-envelope')
                ->color('info')
                ->url(route('filament.admin.resources.inquiries.index', ['tableFilters[type][value]' => 'newsletter'])),

            // Row 2 - Content Stats
            Stat::make(__('admin.stats.active_tours'), $activeTours)
                ->description(Tour::featured()->count() . ' ' . __('admin.stats.featured'))
                ->descriptionIcon('heroicon-m-map')
                ->color('primary')
                ->url(route('filament.admin.resources.tours.index')),

            Stat::make(__('admin.stats.destinations'), $activeDestinations)
                ->description(Destination::featured()->count() . ' ' . __('admin.stats.featured'))
                ->descriptionIcon('heroicon-m-globe-alt')
                ->color('primary')
                ->url(route('filament.admin.resources.destinations.index')),

            Stat::make(__('admin.stats.blog_posts'), $publishedPosts)
                ->description(BlogPost::featured()->count() . ' ' . __('admin.stats.featured'))
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary')
                ->url(route('filament.admin.resources.blog-posts.index')),

            Stat::make(__('admin.stats.pages'), $activePages)
                ->description(__('admin.stats.active_pages'))
                ->descriptionIcon('heroicon-m-document')
                ->color('gray')
                ->url(route('filament.admin.resources.pages.index')),
        ];
    }
}
