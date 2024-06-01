<?php

namespace App\Filament\Resources\BahanResource\Widgets;

use App\Models\Bahan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BahanOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // Stat::make('Total Bahan', $this->getPageTableQuery()->count()),
            Stat::make('Total Bahan', Bahan::query()->count())
                ->description(Bahan::query()->count().' increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}
