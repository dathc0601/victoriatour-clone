<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TourCategoryResource\Pages;
use App\Models\TourCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables;
use Filament\Tables\Table;

class TourCategoryResource extends Resource
{
    use Translatable;

    protected static ?string $model = TourCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?int $navigationSort = 3;

    public static function getNavigationGroup(): ?string
    {
        return __('admin.nav_groups.content');
    }

    public static function getModelLabel(): string
    {
        return __('admin.resources.tour_category.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.tour_category.plural');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.tour_category.navigation');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->maxLength(255)
                            ->disabled()
                            ->dehydrated(false),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('tours_count')
                    ->counts('tours')
                    ->label('Tours'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTourCategories::route('/'),
            'create' => Pages\CreateTourCategory::route('/create'),
            'edit' => Pages\EditTourCategory::route('/{record}/edit'),
        ];
    }
}
