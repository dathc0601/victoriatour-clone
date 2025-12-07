<?php

namespace App\Filament\Resources\MiceContentResource\Pages;

use App\Filament\Resources\MiceContentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMiceContent extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = MiceContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
