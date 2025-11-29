<?php

namespace App\Filament\Resources\TourCategoryResource\Pages;

use App\Filament\Resources\TourCategoryResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateTourCategory extends CreateRecord
{
    use Translatable;

    protected static string $resource = TourCategoryResource::class;
}
