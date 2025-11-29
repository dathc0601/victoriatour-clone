<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\InquiryResource;
use App\Models\Inquiry;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestInquiriesWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    public function getHeading(): string
    {
        return __('admin.widgets.latest_inquiries');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Inquiry::query()
                    ->latest()
                    ->limit(8)
            )
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'contact' => 'primary',
                        'tour_booking' => 'success',
                        'newsletter' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'contact' => __('admin.inquiry.types.contact'),
                        'tour_booking' => __('admin.inquiry.types.tour_booking'),
                        'newsletter' => __('admin.inquiry.types.newsletter'),
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->limit(20),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->limit(25)
                    ->icon('heroicon-m-envelope'),

                Tables\Columns\TextColumn::make('tour.title')
                    ->label(__('admin.labels.tour'))
                    ->limit(20)
                    ->placeholder('-')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('status')
                    ->label(__('admin.labels.status'))
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new' => 'warning',
                        'read' => 'info',
                        'replied' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'new' => __('admin.inquiry.status.new'),
                        'read' => __('admin.inquiry.status.read'),
                        'replied' => __('admin.inquiry.status.replied'),
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin.labels.received'))
                    ->since()
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label(__('admin.labels.view'))
                    ->url(fn (Inquiry $record): string => InquiryResource::getUrl('edit', ['record' => $record]))
                    ->icon('heroicon-m-eye'),
            ])
            ->paginated(false)
            ->defaultSort('created_at', 'desc');
    }
}
