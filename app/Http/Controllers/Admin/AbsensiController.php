<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class AbsensiController extends Controller
{
    public function downloadQr(Absensi $absensi)
    {
        try {
            // Generate QR code URL
            $qrUrl = route('absensi.scan', ['qrCode' => $absensi->qr_code]);
            
            // Generate QR code as SVG
            $qrCode = QrCode::format('svg')
                ->size(300)
                ->errorCorrection('M')
                ->generate($qrUrl);
            
            // Create safe filename
            $filename = 'QR_' . preg_replace('/[^A-Za-z0-9_\-]/', '_', $absensi->judul) . '_' . date('Y-m-d') . '.svg';
            
            // Return download response
            return response($qrCode, 200, [
                'Content-Type' => 'image/svg+xml',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0'
            ]);
            
        } catch (\Exception $e) {
            Log::error('QR Code download failed: ' . $e->getMessage());
            
            return response()->json([
                'error' => 'Gagal mengunduh QR Code. Silakan coba lagi.'
            ], 500);
        }
    }
}