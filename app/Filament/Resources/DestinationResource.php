<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DestinationResource\Pages;
use App\Filament\Resources\DestinationResource\RelationManagers;
use App\Models\Destination;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables;
use Filament\Tables\Table;

class DestinationResource extends Resource
{
    use Translatable;

    protected static ?string $model = Destination::class;

    protected static ?string $navigationIcon = 'heroicon-o-map';

    protected static ?int $navigationSort = 1;

    public static function getNavigationGroup(): ?string
    {
        return __('admin.nav_groups.content');
    }

    public static function getModelLabel(): string
    {
        return __('admin.resources.destination.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.destination.plural');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.destination.navigation');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated(false),
                        Forms\Components\Textarea::make('description')
                            ->rows(4),
                    ]),
                Forms\Components\Section::make('Hero Image')
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('hero_image')
                            ->collection('image')
                            ->image()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->label('Hero Image')
                            ->helperText('Recommended size: 1920x1080 pixels'),
                    ]),
                Forms\Components\Section::make('SEO')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('meta_description')
                            ->rows(2),
                    ])->collapsed(),
                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_featured')
                            ->default(false),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true),
                    ])->columns(3),
                Forms\Components\Section::make('Visa Information')
                    ->schema([
                        Forms\Components\Tabs::make('Visa Content')
                            ->tabs([
                                Forms\Components\Tabs\Tab::make('English')
                                    ->schema([
                                        Forms\Components\TextInput::make('visa.title_en')
                                            ->label('Title (English)')
                                            ->maxLength(255)
                                            ->afterStateHydrated(function ($component, $record) {
                                                if ($record?->visa) {
                                                    $component->state($record->visa->getTranslation('title', 'en') ?? '');
                                                }
                                            }),
                                        Forms\Components\RichEditor::make('visa.content_en')
                                            ->label('Content (English)')
                                            ->columnSpanFull()
                                            ->afterStateHydrated(function ($component, $record) {
                                                if ($record?->visa) {
                                                    $component->state($record->visa->getTranslation('content', 'en') ?? '');
                                                }
                                            }),
                                    ]),
                                Forms\Components\Tabs\Tab::make('Tiếng Việt')
                                    ->schema([
                                        Forms\Components\TextInput::make('visa.title_vi')
                                            ->label('Tiêu đề (Tiếng Việt)')
                                            ->maxLength(255)
                                            ->afterStateHydrated(function ($component, $record) {
                                                if ($record?->visa) {
                                                    $component->state($record->visa->getTranslation('title', 'vi') ?? '');
                                                }
                                            }),
                                        Forms\Components\RichEditor::make('visa.content_vi')
                                            ->label('Nội dung (Tiếng Việt)')
                                            ->columnSpanFull()
                                            ->afterStateHydrated(function ($component, $record) {
                                                if ($record?->visa) {
                                                    $component->state($record->visa->getTranslation('content', 'vi') ?? '');
                                                }
                                            }),
                                    ]),
                            ])->columnSpanFull(),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('visa.image')
                            ->collection('image')
                            ->image()
                            ->label('Visa Image')
                            ->model(fn ($record) => $record?->visa),
                        Forms\Components\Toggle::make('visa.is_active')
                            ->label('Active')
                            ->default(true)
                            ->afterStateHydrated(function ($component, $record) {
                                if ($record?->visa) {
                                    $component->state($record->visa->is_active);
                                }
                            }),
                    ])->collapsible(),
                Forms\Components\Section::make('Travel Policy')
                    ->schema([
                        Forms\Components\Tabs::make('Policy Content')
                            ->tabs([
                                Forms\Components\Tabs\Tab::make('English')
                                    ->schema([
                                        Forms\Components\TextInput::make('policy.title_en')
                                            ->label('Title (English)')
                                            ->maxLength(255)
                                            ->afterStateHydrated(function ($component, $record) {
                                                if ($record?->policy) {
                                                    $component->state($record->policy->getTranslation('title', 'en') ?? '');
                                                }
                                            }),
                                        Forms\Components\RichEditor::make('policy.content_en')
                                            ->label('Content (English)')
                                            ->columnSpanFull()
                                            ->afterStateHydrated(function ($component, $record) {
                                                if ($record?->policy) {
                                                    $component->state($record->policy->getTranslation('content', 'en') ?? '');
                                                }
                                            }),
                                    ]),
                                Forms\Components\Tabs\Tab::make('Tiếng Việt')
                                    ->schema([
                                        Forms\Components\TextInput::make('policy.title_vi')
                                            ->label('Tiêu đề (Tiếng Việt)')
                                            ->maxLength(255)
                                            ->afterStateHydrated(function ($component, $record) {
                                                if ($record?->policy) {
                                                    $component->state($record->policy->getTranslation('title', 'vi') ?? '');
                                                }
                                            }),
                                        Forms\Components\RichEditor::make('policy.content_vi')
                                            ->label('Nội dung (Tiếng Việt)')
                                            ->columnSpanFull()
                                            ->afterStateHydrated(function ($component, $record) {
                                                if ($record?->policy) {
                                                    $component->state($record->policy->getTranslation('content', 'vi') ?? '');
                                                }
                                            }),
                                    ]),
                            ])->columnSpanFull(),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('policy.image')
                            ->collection('image')
                            ->image()
                            ->label('Policy Image')
                            ->model(fn ($record) => $record?->policy),
                        Forms\Components\Toggle::make('policy.is_active')
                            ->label('Active')
                            ->default(true)
                            ->afterStateHydrated(function ($component, $record) {
                                if ($record?->policy) {
                                    $component->state($record->policy->is_active);
                                }
                            }),
                    ])->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('hero_image')
                    ->collection('image')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cities_count')
                    ->counts('cities')
                    ->label('Cities'),
                Tables\Columns\TextColumn::make('tours_count')
                    ->counts('tours')
                    ->label('Tours'),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
                Tables\Filters\TernaryFilter::make('is_featured'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->reorderable('order')
            ->defaultSort('order');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\CitiesRelationManager::class,
            RelationManagers\ToursRelationManager::class,
            RelationManagers\HotelsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDestinations::route('/'),
            'create' => Pages\CreateDestination::route('/create'),
            'edit' => Pages\EditDestination::route('/{record}/edit'),
        ];
    }
}
