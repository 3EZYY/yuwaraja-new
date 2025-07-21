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
                try {
                    // Generate the scan URL
                    $url = route('absensi.scan', ['qrCode' => $record->qr_code]);
                    
                    // Generate QR code as SVG
                    $qrCode = QrCode::format('svg')
                        ->size(300)
                        ->margin(2)
                        ->errorCorrection('M')
                        ->generate($url);

                    // Create safe filename
                    $safeTitle = preg_replace('/[^A-Za-z0-9\-_]/', '_', $record->judul);
                    $filename = 'QR_Code_' . $safeTitle . '_' . date('Y-m-d_H-i-s') . '.svg';

                    // Return the file download response
                    return Response::make($qrCode, 200, [
                        'Content-Type' => 'image/svg+xml',
                        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                        'Cache-Control' => 'no-cache, no-store, must-revalidate',
                        'Pragma' => 'no-cache',
                        'Expires' => '0',
                    ]);
                } catch (\Exception $e) {
                    // Log error and show notification
                    \Log::error('QR Code download error: ' . $e->getMessage());
                    
                    $this->failureNotification(
                        title: 'Error',
                        body: 'Gagal mengunduh QR Code. Silakan coba lagi.'
                    );
                    
                    return null;
                }
            });
    }
}