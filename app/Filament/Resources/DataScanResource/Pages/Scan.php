<?php

namespace App\Filament\Resources\DataScanResource\Pages;

use Livewire\Attributes\On;
use Filament\Resources\Pages\Page;
use Filament\Notifications\Notification;
use App\Filament\Resources\DataScanResource;
use App\Models\DataScan;

class Scan extends Page
{
    protected static string $resource = DataScanResource::class;

    protected static string $view = 'filament.resources.data-scan-resource.pages.scan';

    #[On('qr-scanned')]
    public function qrCodeScanned($qr)
    {
        $save = DataScan::create([
            'data' => $qr,
        ]);

        Notification::make()
            ->title('Scan successfully')
            ->success()
            ->send();

        return redirect(DataScanResource::getUrl('scan'));
    }
}
