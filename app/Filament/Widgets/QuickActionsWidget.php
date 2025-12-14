<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\BlogPostResource;
use App\Filament\Resources\DestinationResource;
use App\Filament\Resources\InquiryResource;
use App\Filament\Resources\TourResource;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\Widget;

class QuickActionsWidget extends Widget
{
    use HasWidgetShield;

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected static string $view = 'filament.widgets.quick-actions-widget';

    public function getActions(): array
    {
        return [
            [
                'label' => __('admin.actions.add_new_tour'),
                'url' => TourResource::getUrl('create'),
                'icon' => 'heroicon-o-plus-circle',
                'color' => 'primary',
                'description' => __('admin.actions.create_tour_desc'),
            ],
            [
                'label' => __('admin.actions.add_blog_post'),
                'url' => BlogPostResource::getUrl('create'),
                'icon' => 'heroicon-o-document-plus',
                'color' => 'success',
                'description' => __('admin.actions.create_blog_desc'),
            ],
            [
                'label' => __('admin.actions.view_inquiries'),
                'url' => InquiryResource::getUrl('index'),
                'icon' => 'heroicon-o-inbox',
                'color' => 'warning',
                'description' => __('admin.actions.manage_inquiries_desc'),
            ],
            [
                'label' => __('admin.actions.add_destination'),
                'url' => DestinationResource::getUrl('create'),
                'icon' => 'heroicon-o-globe-alt',
                'color' => 'info',
                'description' => __('admin.actions.create_destination_desc'),
            ],
        ];
    }
}
