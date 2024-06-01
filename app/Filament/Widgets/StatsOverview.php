<?php

namespace App\Filament\Widgets;

use App\Models\Bahan;
use App\Models\Barang;
use App\Models\KategoriBarang;
use Filament\Widgets\StatsOverviewWidget\Stat;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    use HasWidgetShield;
    
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Bahan', Bahan::query()->count())
                ->description(Bahan::query()->count().' increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Total Barang', Barang::query()->count())
                ->description(Barang::query()->count().' increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Total Kategori Barang', KategoriBarang::query()->count())
                ->description(KategoriBarang::query()->count().' increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}
