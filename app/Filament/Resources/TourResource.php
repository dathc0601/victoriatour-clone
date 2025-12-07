<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TourResource\Pages;
use App\Models\Tour;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables;
use Filament\Tables\Table;

class TourResource extends Resource
{
    use Translatable;

    protected static ?string $model = Tour::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Tour')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Basic Info')
                            ->schema([
                                Forms\Components\Select::make('destination_id')
                                    ->relationship('destination', 'name')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->reactive(),
                                Forms\Components\Select::make('city_id')
                                    ->relationship('city', 'name', fn ($query, $get) =>
                                        $query->where('destination_id', $get('destination_id'))
                                    )
                                    ->searchable()
                                    ->preload(),
                                Forms\Components\TextInput::make('title')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('slug')
                                    ->maxLength(255)
                                    ->disabled()
                                    ->dehydrated(false),
                                Forms\Components\Textarea::make('excerpt')
                                    ->rows(2),
                                Forms\Components\RichEditor::make('description')
                                    ->columnSpanFull(),
                            ])->columns(2),
                        Forms\Components\Tabs\Tab::make('Pricing & Duration')
                            ->schema([
                                Forms\Components\TextInput::make('duration_days')
                                    ->numeric()
                                    ->default(1)
                                    ->required(),
                                Forms\Components\Select::make('price_type')
                                    ->options([
                                        'fixed' => 'Fixed Price',
                                        'from' => 'From Price',
                                        'contact' => 'Contact for Price',
                                    ])
                                    ->default('contact')
                                    ->required(),
                                Forms\Components\TextInput::make('price')
                                    ->numeric()
                                    ->prefix('$'),
                                Forms\Components\TextInput::make('rating')
                                    ->numeric()
                                    ->default(5.0)
                                    ->minValue(0)
                                    ->maxValue(5)
                                    ->step(0.1),
                            ])->columns(2),
                        Forms\Components\Tabs\Tab::make('Itinerary')
                            ->schema([
                                Forms\Components\RichEditor::make('itinerary')
                                    ->columnSpanFull(),
                            ]),
                        Forms\Components\Tabs\Tab::make('Inclusions/Exclusions')
                            ->schema([
                                Forms\Components\RichEditor::make('inclusions')
                                    ->label('What\'s Included'),
                                Forms\Components\RichEditor::make('exclusions')
                                    ->label('What\'s Not Included'),
                            ]),
                        Forms\Components\Tabs\Tab::make('Categories')
                            ->schema([
                                Forms\Components\Select::make('categories')
                                    ->relationship('categories', 'name')
                                    ->multiple()
                                    ->preload()
                                    ->searchable(),
                            ]),
                        Forms\Components\Tabs\Tab::make('Media')
                            ->schema([
                                Forms\Components\SpatieMediaLibraryFileUpload::make('featured_image')
                                    ->collection('featured_image')
                                    ->image()
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('16:9')
                                    ->label('Featured Image')
                                    ->helperText('Main image displayed in hero section and tour cards. Recommended: 1920x1080'),
                                Forms\Components\SpatieMediaLibraryFileUpload::make('gallery')
                                    ->collection('gallery')
                                    ->multiple()
                                    ->image()
                                    ->reorderable()
                                    ->label('Gallery Images')
                                    ->helperText('Additional images for the photo gallery section'),
                            ])->columns(1),
                        Forms\Components\Tabs\Tab::make('SEO')
                            ->schema([
                                Forms\Components\TextInput::make('meta_title')
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('meta_description')
                                    ->rows(2),
                            ]),
                    ])->columnSpanFull(),
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('destination.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration_days')
                    ->label('Days')
                    ->sortable(),
                Tables\Columns\TextColumn::make('formatted_price')
                    ->label('Price'),
                Tables\Columns\TextColumn::make('rating')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('destination')
                    ->relationship('destination', 'name'),
                Tables\Filters\SelectFilter::make('categories')
                    ->relationship('categories', 'name')
                    ->multiple(),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTours::route('/'),
            'create' => Pages\CreateTour::route('/create'),
            'edit' => Pages\EditTour::route('/{record}/edit'),
        ];
    }
}
