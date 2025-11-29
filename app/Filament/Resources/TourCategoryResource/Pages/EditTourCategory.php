<?php

namespace App\Filament\Resources\TourCategoryResource\Pages;

use App\Filament\Resources\TourCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;

class EditTourCategory extends EditRecord
{
    use Translatable;

    protected static string $resource = TourCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
