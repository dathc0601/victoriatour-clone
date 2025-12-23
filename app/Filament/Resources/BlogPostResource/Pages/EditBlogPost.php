<?php

namespace App\Filament\Resources\BlogPostResource\Pages;

use App\Filament\Resources\BlogPostResource;
use App\Jobs\TranslateModel;
use App\Models\Language;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\EditRecord\Concerns\Translatable;
use Illuminate\Support\Facades\Log;

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
                    try {
                        Log::info('Translate Now button clicked', ['record_id' => $this->record->id]);

                        $record = $this->record;
                        $sourceLocale = $record->source_locale ?? 'en';
                        $targetLocales = Language::active()
                            ->where('code', '!=', $sourceLocale)
                            ->pluck('code');

                        Log::info('Target locales', ['locales' => $targetLocales->toArray()]);

                        foreach ($targetLocales as $locale) {
                            TranslateModel::dispatch($record, $locale, force: true);
                            Log::info('Dispatched translation job', ['locale' => $locale]);
                        }

                        Notification::make()
                            ->title('Translation queued')
                            ->body('Content has been queued for translation.')
                            ->success()
                            ->send();
                    } catch (\Exception $e) {
                        Log::error('Translate Now button error', [
                            'error' => $e->getMessage(),
                            'trace' => $e->getTraceAsString(),
                        ]);

                        Notification::make()
                            ->title('Translation failed')
                            ->body($e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
            Actions\DeleteAction::make(),
        ];
    }
}
