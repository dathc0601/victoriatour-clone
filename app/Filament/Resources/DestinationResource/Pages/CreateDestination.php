<?php

namespace App\Filament\Resources\DestinationResource\Pages;

use App\Filament\Resources\DestinationResource;
use App\Models\DestinationVisa;
use App\Models\DestinationPolicy;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\Translatable;

class CreateDestination extends CreateRecord
{
    use Translatable;

    protected static string $resource = DestinationResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Remove visa and policy data from main destination data
        unset($data['visa']);
        unset($data['policy']);

        return $data;
    }

    protected function afterCreate(): void
    {
        $formData = $this->form->getState();

        // Save Visa data
        if (isset($formData['visa'])) {
            $visaData = $formData['visa'];
            $visa = new DestinationVisa(['destination_id' => $this->record->id]);

            $visa->setTranslation('title', 'en', $visaData['title_en'] ?? '');
            $visa->setTranslation('title', 'vi', $visaData['title_vi'] ?? '');
            $visa->setTranslation('content', 'en', $visaData['content_en'] ?? '');
            $visa->setTranslation('content', 'vi', $visaData['content_vi'] ?? '');
            $visa->is_active = $visaData['is_active'] ?? true;
            $visa->save();

            // Handle image upload
            if (!empty($visaData['image'])) {
                $visa->clearMediaCollection('image');
                $visa->addMediaFromDisk($visaData['image'], 'public')
                    ->toMediaCollection('image');
            }
        }

        // Save Policy data
        if (isset($formData['policy'])) {
            $policyData = $formData['policy'];
            $policy = new DestinationPolicy(['destination_id' => $this->record->id]);

            $policy->setTranslation('title', 'en', $policyData['title_en'] ?? '');
            $policy->setTranslation('title', 'vi', $policyData['title_vi'] ?? '');
            $policy->setTranslation('content', 'en', $policyData['content_en'] ?? '');
            $policy->setTranslation('content', 'vi', $policyData['content_vi'] ?? '');
            $policy->is_active = $policyData['is_active'] ?? true;
            $policy->save();

            // Handle image upload
            if (!empty($policyData['image'])) {
                $policy->clearMediaCollection('image');
                $policy->addMediaFromDisk($policyData['image'], 'public')
                    ->toMediaCollection('image');
            }
        }
    }
}
