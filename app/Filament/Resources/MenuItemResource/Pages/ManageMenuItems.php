<?php

namespace App\Filament\Resources\MenuItemResource\Pages;

use App\Filament\Resources\MenuItemResource;
use App\Models\MenuItem;
use App\Models\Page;
use Filament\Actions\CreateAction;
use Filament\Forms;
use Illuminate\Database\Eloquent\Builder;
use SolutionForest\FilamentTree\Resources\Pages\TreePage;

class ManageMenuItems extends TreePage
{
    protected static string $resource = MenuItemResource::class;

    protected static int $maxDepth = 3;

    protected static string $view = 'filament.resources.menu-item-resource.pages.manage-menu-items';

    public function getTitle(): string
    {
        return 'Header Navigation';
    }

    protected function getTreeQuery(): Builder
    {
        return MenuItem::query()->where('location', 'header');
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('title')
                ->label('Title')
                ->required()
                ->maxLength(255),

            Forms\Components\Select::make('type')
                ->label('Link Type')
                ->options([
                    'url' => 'Custom URL',
                    'route' => 'Named Route',
                    'page' => 'CMS Page',
                ])
                ->required()
                ->default('url')
                ->live()
                ->afterStateUpdated(function (Forms\Set $set) {
                    $set('url', null);
                    $set('route_name', null);
                    $set('page_id', null);
                }),

            Forms\Components\TextInput::make('url')
                ->label('URL')
                ->placeholder('/path or https://example.com')
                ->visible(fn (Forms\Get $get) => $get('type') === 'url')
                ->required(fn (Forms\Get $get) => $get('type') === 'url'),

            Forms\Components\Select::make('route_name')
                ->label('Route')
                ->options([
                    'home' => 'Home',
                    'tours.index' => 'Tours',
                    'destinations.index' => 'Destinations',
                    'blog.index' => 'Blog',
                    'contact' => 'Contact',
                    'search' => 'Search',
                ])
                ->searchable()
                ->visible(fn (Forms\Get $get) => $get('type') === 'route')
                ->required(fn (Forms\Get $get) => $get('type') === 'route'),

            Forms\Components\Select::make('page_id')
                ->label('Page')
                ->options(fn () => Page::where('is_active', true)->pluck('title', 'id'))
                ->searchable()
                ->visible(fn (Forms\Get $get) => $get('type') === 'page')
                ->required(fn (Forms\Get $get) => $get('type') === 'page'),

            Forms\Components\TextInput::make('icon')
                ->label('Icon')
                ->placeholder('heroicon-o-home')
                ->helperText('Heroicon name (optional)'),

            Forms\Components\Select::make('target')
                ->label('Open In')
                ->options([
                    '_self' => 'Same Window',
                    '_blank' => 'New Tab',
                ])
                ->default('_self'),

            Forms\Components\Toggle::make('is_active')
                ->label('Active')
                ->default(true),
        ];
    }

    protected function afterConfiguredCreateAction(CreateAction $action): CreateAction
    {
        return $action->mutateFormDataUsing(function (array $data): array {
            $data['location'] = 'header';
            return $data;
        });
    }

    protected function hasDeleteAction(): bool
    {
        return true;
    }

    public function getTreeRecordTitle(?\Illuminate\Database\Eloquent\Model $record = null): string
    {
        if (!$record) {
            return '';
        }

        return $record->title ?? '';
    }

    public function getTreeRecordIcon(?\Illuminate\Database\Eloquent\Model $record = null): ?string
    {
        if (!$record) {
            return null;
        }

        if ($record->icon) {
            return $record->icon;
        }

        return $record->is_active ? 'heroicon-o-link' : 'heroicon-o-x-mark';
    }
}
