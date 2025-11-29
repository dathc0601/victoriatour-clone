<?php

namespace App\Filament\Resources\DifferentiatorResource\Pages;

use App\Filament\Resources\DifferentiatorResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Concerns\Translatable;

class ListDifferentiators extends ListRecords
{
    use Translatable;

    protected static string $resource = DifferentiatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
