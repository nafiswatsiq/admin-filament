<?php

namespace App\Filament\Resources\BahanResource\Pages;

use App\Filament\Resources\BahanResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageBahans extends ManageRecords
{
    protected static string $resource = BahanResource::class;

    protected ?string $heading = 'Data Bahan';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Scan Bahan'),
            // Actions\CreateAction::make()
            //     ->label('Tambah Bahan'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            BahanResource\Widgets\BahanOverview::class,
        ];
    } 

}
