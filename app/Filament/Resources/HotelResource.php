<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HotelResource\Pages;
use App\Models\Hotel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables;
use Filament\Tables\Table;

class HotelResource extends Resource
{
    use Translatable;

    protected static ?string $model = Hotel::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?int $navigationSort = 5;

    public static function getNavigationGroup(): ?string
    {
        return __('admin.nav_groups.content');
    }

    public static function getModelLabel(): string
    {
        return __('admin.resources.hotel.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.hotel.plural');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.hotel.navigation');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Info')
                    ->schema([
                        Forms\Components\Select::make('destination_id')
                            ->relationship('destination', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated(false),
                        Forms\Components\TextInput::make('address')
                            ->maxLength(255),
                        Forms\Components\RichEditor::make('description')
                            ->columnSpanFull(),
                    ])->columns(2),

                Forms\Components\Section::make('Pricing & Rating')
                    ->schema([
                        Forms\Components\TextInput::make('rating')
                            ->numeric()
                            ->default(4.5)
                            ->minValue(0)
                            ->maxValue(5)
                            ->step(0.1),
                        Forms\Components\TextInput::make('price_per_night')
                            ->numeric()
                            ->prefix('$')
                            ->label('Price per Night'),
                    ])->columns(2),

                Forms\Components\Section::make('Room Types')
                    ->schema([
                        Forms\Components\Repeater::make('room_types')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->label('Room Type'),
                                Forms\Components\TextInput::make('capacity')
                                    ->numeric()
                                    ->default(2)
                                    ->label('Capacity'),
                            ])
                            ->columns(2)
                            ->collapsible()
                            ->cloneable()
                            ->defaultItems(1),
                    ]),

                Forms\Components\Section::make('Amenities')
                    ->schema([
                        Forms\Components\TagsInput::make('amenities')
                            ->placeholder('Add amenity')
                            ->suggestions([
                                'WiFi',
                                'Swimming Pool',
                                'Spa',
                                'Restaurant',
                                'Gym',
                                'Room Service',
                                'Airport Shuttle',
                                'Parking',
                                'Air Conditioning',
                                'Breakfast Included',
                            ]),
                    ]),

                Forms\Components\Section::make('Media')
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('featured_image')
                            ->collection('featured_image')
                            ->image()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('4:3'),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('gallery')
                            ->collection('gallery')
                            ->multiple()
                            ->image()
                            ->reorderable(),
                    ])->columns(2),

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
                Tables\Columns\SpatieMediaLibraryImageColumn::make('featured_image')
                    ->collection('featured_image')
                    ->circular()
                    ->label(''),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('destination.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('rating')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => number_format($state, 1) . ' ★'),
                Tables\Columns\TextColumn::make('formatted_price')
                    ->label('Price/Night'),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('destination')
                    ->relationship('destination', 'name'),
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
            'index' => Pages\ListHotels::route('/'),
            'create' => Pages\CreateHotel::route('/create'),
            'edit' => Pages\EditHotel::route('/{record}/edit'),
        ];
    }
}
