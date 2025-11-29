<?php

namespace App\Filament\Resources\TourCategoryResource\Pages;

use App\Filament\Resources\TourCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;

class ListTourCategories extends ListRecords
{
    use Translatable;

    protected static string $resource = TourCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
