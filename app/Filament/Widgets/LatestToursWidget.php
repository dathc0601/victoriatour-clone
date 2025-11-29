<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\TourResource;
use App\Models\Tour;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestToursWidget extends BaseWidget
{
    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 1;

    public function getHeading(): string
    {
        return __('admin.widgets.recent_tours');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Tour::query()
                    ->with(['destination'])
                    ->latest('updated_at')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('')
                    ->circular()
                    ->defaultImageUrl(fn (Tour $record): string => 'https://picsum.photos/seed/' . $record->id . '/100/100')
                    ->size(40),

                Tables\Columns\TextColumn::make('title')
                    ->limit(25)
                    ->searchable()
                    ->description(fn (Tour $record): string => $record->destination?->name ?? ''),

                Tables\Columns\TextColumn::make('price')
                    ->money('USD')
                    ->placeholder(__('admin.labels.contact_price'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('rating')
                    ->badge()
                    ->color('warning')
                    ->formatStateUsing(fn ($state): string => number_format($state, 1) . ' ★'),

                Tables\Columns\IconColumn::make('is_active')
                    ->label(__('admin.labels.status'))
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->label(__('admin.labels.edit'))
                    ->url(fn (Tour $record): string => TourResource::getUrl('edit', ['record' => $record]))
                    ->icon('heroicon-m-pencil-square'),
            ])
            ->paginated(false)
            ->defaultSort('updated_at', 'desc');
    }
}
