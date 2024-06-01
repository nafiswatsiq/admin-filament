<?php

namespace App\Filament\Resources\KategoriBarangResource\Widgets;

use App\Models\KategoriBarang;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class KategoriBarangStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Kategori Barang', KategoriBarang::query()->count())
                ->description(KategoriBarang::query()->count().' increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}
