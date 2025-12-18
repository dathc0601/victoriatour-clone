<?php

namespace App\Filament\Widgets;

use App\Models\Translation;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TranslationStatusWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 10;

    protected static ?string $pollingInterval = '30s';

    protected function getStats(): array
    {
        $pendingCount = Translation::pending()->count();
        $inProgressCount = Translation::inProgress()->count();
        $completedTodayCount = Translation::completed()
            ->whereDate('translated_at', today())
            ->count();
        $failedCount = Translation::failed()->count();

        return [
            Stat::make('Pending Translations', $pendingCount)
                ->description('Awaiting processing')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning')
                ->chart($this->getChartData('pending')),

            Stat::make('In Progress', $inProgressCount)
                ->description('Currently translating')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('info'),

            Stat::make('Completed Today', $completedTodayCount)
                ->description('Successfully translated')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success')
                ->chart($this->getChartData('completed')),

            Stat::make('Failed', $failedCount)
                ->description('Need attention')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color($failedCount > 0 ? 'danger' : 'gray'),
        ];
    }

    protected function getChartData(string $status): array
    {
        // Get last 7 days data for chart
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();

            if ($status === 'pending') {
                $count = Translation::pending()
                    ->whereDate('created_at', $date)
                    ->count();
            } else {
                $count = Translation::completed()
                    ->whereDate('translated_at', $date)
                    ->count();
            }

            $data[] = $count;
        }

        return $data;
    }

    public static function canView(): bool
    {
        return true;
    }
}
