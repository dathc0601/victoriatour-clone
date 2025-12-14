<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuItemResource\Pages;
use App\Models\MenuItem;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Concerns\Translatable;

class MenuItemResource extends Resource
{
    use Translatable;

    protected static ?string $model = MenuItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3';

    protected static ?int $navigationSort = 1;

    protected static ?string $slug = 'navigation';

    public static function getNavigationGroup(): ?string
    {
        return __('admin.nav_groups.settings');
    }

    public static function getModelLabel(): string
    {
        return __('admin.resources.menu_item.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.menu_item.plural');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.menu_item.navigation');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Menu Item Details')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Title')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\Select::make('location')
                        ->label('Menu Location')
                        ->options([
                            'header' => 'Header Menu',
                            'footer' => 'Footer Menu',
                        ])
                        ->required()
                        ->default('header'),

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
                        ->options(self::getAvailableRoutes())
                        ->searchable()
                        ->visible(fn (Forms\Get $get) => $get('type') === 'route')
                        ->required(fn (Forms\Get $get) => $get('type') === 'route'),

                    Forms\Components\Select::make('page_id')
                        ->label('Page')
                        ->options(fn () => Page::where('is_active', true)->pluck('title', 'id'))
                        ->searchable()
                        ->visible(fn (Forms\Get $get) => $get('type') === 'page')
                        ->required(fn (Forms\Get $get) => $get('type') === 'page'),
                ])->columns(2),

            Forms\Components\Section::make('Additional Options')
                ->schema([
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
                ])->columns(3),
        ]);
    }

    protected static function getAvailableRoutes(): array
    {
        return [
            'home' => 'Home',
            'tours.index' => 'Tours',
            'destinations.index' => 'Destinations',
            'blog.index' => 'Blog',
            'contact' => 'Contact',
            'search' => 'Search',
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMenuItems::route('/'),
        ];
    }
}
