<?php

namespace App\Filament\Resources\MiceContentResource\Pages;

use App\Filament\Resources\MiceContentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMiceContents extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = MiceContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
