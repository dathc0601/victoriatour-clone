<?php

namespace App\Filament\Resources\BlogPostResource\Pages;

use App\Filament\Resources\BlogPostResource;
use App\Jobs\TranslateModel;
use App\Models\Language;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;

class EditBlogPost extends EditRecord
{
    use Translatable;

    protected static string $resource = BlogPostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\Action::make('translate_now')
                ->label('Translate Now')
                ->icon('heroicon-o-language')
                ->color('info')
                ->requiresConfirmation()
                ->modalHeading('Trigger Translation')
                ->modalDescription('This will queue this content for immediate translation to all active languages.')
                ->action(function () {
                    $record = $this->record;
                    $sourceLocale = $record->source_locale ?? 'en';
                    $targetLocales = Language::active()
                        ->where('code', '!=', $sourceLocale)
                        ->pluck('code');

                    foreach ($targetLocales as $locale) {
                        TranslateModel::dispatch($record, $locale);
                    }

                    Notification::make()
                        ->title('Translation queued')
                        ->body('Content has been queued for translation.')
                        ->success()
                        ->send();
                }),
            Actions\DeleteAction::make(),
        ];
    }
}
