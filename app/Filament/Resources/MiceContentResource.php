<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MiceContentResource\Pages;
use App\Models\MiceContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables;
use Filament\Tables\Table;

class MiceContentResource extends Resource
{
    use Translatable;

    protected static ?string $model = MiceContent::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'Content';
    protected static ?string $navigationLabel = 'MICE Content';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('Tabs')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('Content')
                        ->schema([
                            Forms\Components\Section::make('Basic Information')
                                ->schema([
                                    Forms\Components\Select::make('destination_id')
                                        ->relationship('destination', 'name')
                                        ->required()
                                        ->searchable()
                                        ->preload()
                                        ->label('Country'),
                                    Forms\Components\TextInput::make('region')
                                        ->maxLength(255)
                                        ->placeholder('e.g., Bangkok, Phuket')
                                        ->helperText('Leave empty if content applies to entire country'),
                                    Forms\Components\TextInput::make('title')
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('subtitle')
                                        ->maxLength(255),
                                ])->columns(2),

                            Forms\Components\Section::make('Description')
                                ->schema([
                                    Forms\Components\RichEditor::make('description')
                                        ->required()
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    Forms\Components\Tabs\Tab::make('Features')
                        ->schema([
                            Forms\Components\Section::make('Capacity')
                                ->schema([
                                    Forms\Components\TextInput::make('min_delegates')
                                        ->numeric()
                                        ->default(0)
                                        ->label('Minimum Delegates'),
                                    Forms\Components\TextInput::make('max_delegates')
                                        ->numeric()
                                        ->nullable()
                                        ->label('Maximum Delegates')
                                        ->helperText('Leave empty for unlimited'),
                                ])->columns(2),

                            Forms\Components\Section::make('Venue Features & Services')
                                ->schema([
                                    Forms\Components\TagsInput::make('venue_features')
                                        ->placeholder('Add feature')
                                        ->suggestions([
                                            'Conference Rooms', 'Exhibition Halls', 'Banquet Facilities',
                                            'Outdoor Venues', 'Breakout Rooms', 'Business Center',
                                            'Auditorium', 'Theater', 'Ballroom',
                                        ]),
                                    Forms\Components\TagsInput::make('services_included')
                                        ->placeholder('Add service')
                                        ->suggestions([
                                            'Catering', 'AV Equipment', 'Event Planning',
                                            'Transportation', 'Accommodation', 'Team Building',
                                            'Interpretation', 'Registration', 'Security',
                                        ]),
                                ])->columns(2),

                            Forms\Components\Section::make('Highlights')
                                ->schema([
                                    Forms\Components\Textarea::make('highlights')
                                        ->rows(5)
                                        ->helperText('Enter each highlight on a new line')
                                        ->columnSpanFull(),
                                ]),
                        ]),

                    Forms\Components\Tabs\Tab::make('Media')
                        ->schema([
                            Forms\Components\Section::make('Images')
                                ->schema([
                                    Forms\Components\SpatieMediaLibraryFileUpload::make('featured_image')
                                        ->collection('featured_image')
                                        ->image()
                                        ->imageResizeMode('cover')
                                        ->imageCropAspectRatio('16:9')
                                        ->label('Featured Image'),
                                    Forms\Components\SpatieMediaLibraryFileUpload::make('gallery')
                                        ->collection('gallery')
                                        ->multiple()
                                        ->image()
                                        ->reorderable()
                                        ->label('Gallery Images'),
                                ])->columns(2),
                        ]),

                    Forms\Components\Tabs\Tab::make('Settings')
                        ->schema([
                            Forms\Components\Section::make('Display Settings')
                                ->schema([
                                    Forms\Components\TextInput::make('order')
                                        ->numeric()
                                        ->default(0),
                                    Forms\Components\Toggle::make('is_featured')
                                        ->default(false),
                                    Forms\Components\Toggle::make('is_active')
                                        ->default(true),
                                ])->columns(3),
                        ]),
                ])
                ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('destination.name')
                    ->sortable()
                    ->label('Country'),
                Tables\Columns\TextColumn::make('region')
                    ->searchable()
                    ->placeholder('All regions'),
                Tables\Columns\TextColumn::make('min_delegates')
                    ->label('Min')
                    ->sortable(),
                Tables\Columns\TextColumn::make('max_delegates')
                    ->label('Max')
                    ->placeholder('Unlimited'),
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
            'index' => Pages\ListMiceContents::route('/'),
            'create' => Pages\CreateMiceContent::route('/create'),
            'edit' => Pages\EditMiceContent::route('/{record}/edit'),
        ];
    }
}
