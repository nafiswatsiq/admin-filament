<?php

namespace App\Forms\Components;

use Livewire\Attributes\On;
use Filament\Forms\Components\Field;

class ScannerBarang extends Field
{
    public string $qrScanned = '';

    protected string $view = 'forms.components.scanner-barang';

    #[On('qr-scanned')]
    public function qrCodeScanned($qr)
    {
        $this->qrScanned = $qr;
        dd($qr);
    }
}
