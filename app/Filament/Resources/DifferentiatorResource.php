<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DifferentiatorResource\Pages;
use App\Models\Differentiator;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Concerns\Translatable;
use Filament\Tables;
use Filament\Tables\Table;

class DifferentiatorResource extends Resource
{
    use Translatable;

    protected static ?string $model = Differentiator::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';

    protected static ?int $navigationSort = 3;

    public static function getNavigationGroup(): ?string
    {
        return __('admin.nav_groups.pages');
    }

    public static function getModelLabel(): string
    {
        return __('admin.resources.differentiator.label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.resources.differentiator.plural');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.resources.differentiator.navigation');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Content')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->rows(3),
                        Forms\Components\TextInput::make('icon')
                            ->maxLength(255)
                            ->helperText('Heroicon name (e.g., heroicon-o-star) or emoji'),
                    ]),
                Forms\Components\Section::make('Settings')
                    ->schema([
                        Forms\Components\TextInput::make('order')
                            ->numeric()
                            ->default(0),
                        Forms\Components\Toggle::make('is_active')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('icon')
                    ->limit(20),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(40),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('order')
                    ->sortable(),
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
            'index' => Pages\ListDifferentiators::route('/'),
            'create' => Pages\CreateDifferentiator::route('/create'),
            'edit' => Pages\EditDifferentiator::route('/{record}/edit'),
        ];
    }
}
