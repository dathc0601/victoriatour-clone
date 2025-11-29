<?php

namespace App\Filament\Resources\DifferentiatorResource\Pages;

use App\Filament\Resources\DifferentiatorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;

class EditDifferentiator extends EditRecord
{
    use Translatable;

    protected static string $resource = DifferentiatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
