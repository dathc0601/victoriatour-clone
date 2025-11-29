<?php

namespace App\Filament\Resources\DifferentiatorResource\Pages;

use App\Filament\Resources\DifferentiatorResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateDifferentiator extends CreateRecord
{
    use Translatable;

    protected static string $resource = DifferentiatorResource::class;
}
