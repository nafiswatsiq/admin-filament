<?php

namespace App\Filament\Resources\DataScanResource\Pages;

use App\Filament\Resources\DataScanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataScan extends EditRecord
{
    protected static string $resource = DataScanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
