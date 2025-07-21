<?php

namespace App\Filament\Resources\AbsensiResource\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Response;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DownloadQrCodeAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'downloadQrCode';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Download QR Code')
            ->icon('heroicon-o-qr-code')
            ->color('success')
            ->action(function ($record) {
                $url = route('absensi.scan', ['qrCode' => $record->qr_code]);
                
                // Generate QR code as SVG
                $qrCode = QrCode::format('svg')
                    ->size(300)
                    ->margin(2)
                    ->generate($url);

                // Create filename
                $filename = 'QR_Code_' . str_replace(' ', '_', $record->judul) . '_' . date('Y-m-d') . '.svg';

                return Response::make($qrCode, 200, [
                    'Content-Type' => 'image/svg+xml',
                    'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                ]);
            });
    }
}