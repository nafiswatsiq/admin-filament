<?php

namespace App\Filament\Resources\DataScanResource\Pages;

use App\Filament\Resources\DataScanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataScans extends ListRecords
{
    protected static string $resource = DataScanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('Scan')
                ->label('Scan Data')
                ->url(DataScanResource::getUrl('scan')),
        ];
    }
}
