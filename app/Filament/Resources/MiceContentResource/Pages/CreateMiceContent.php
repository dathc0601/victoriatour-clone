<?php

namespace App\Filament\Resources\MiceContentResource\Pages;

use App\Filament\Resources\MiceContentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMiceContent extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = MiceContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
