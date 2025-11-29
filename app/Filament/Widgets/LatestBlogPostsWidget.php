<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\BlogPostResource;
use App\Models\BlogPost;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestBlogPostsWidget extends BaseWidget
{
    protected static ?int $sort = 5;

    protected int | string | array $columnSpan = 1;

    public function getHeading(): string
    {
        return __('admin.widgets.recent_blog_posts');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                BlogPost::query()
                    ->with(['category'])
                    ->latest('updated_at')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('')
                    ->circular()
                    ->defaultImageUrl(fn (BlogPost $record): string => 'https://picsum.photos/seed/blog-' . $record->id . '/100/100')
                    ->size(40),

                Tables\Columns\TextColumn::make('title')
                    ->limit(25)
                    ->searchable()
                    ->description(fn (BlogPost $record): string => $record->category?->name ?? ''),

                Tables\Columns\TextColumn::make('author')
                    ->limit(15)
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('published_at')
                    ->label(__('admin.labels.published'))
                    ->date()
                    ->placeholder(__('admin.labels.draft'))
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label(__('admin.labels.featured'))
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-minus')
                    ->trueColor('warning'),
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->label(__('admin.labels.edit'))
                    ->url(fn (BlogPost $record): string => BlogPostResource::getUrl('edit', ['record' => $record]))
                    ->icon('heroicon-m-pencil-square'),
            ])
            ->paginated(false)
            ->defaultSort('updated_at', 'desc');
    }
}
