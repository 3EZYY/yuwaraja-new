<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\AbsensiMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    /**
     * Handle QR code scan
     */
    public function scan($qrCode)
    {
        // Find absensi by QR code
        $absensi = Absensi::where('qr_code', $qrCode)->first();

        if (!$absensi) {
            return view('absensi.scan')->with('error', 'QR Code tidak valid atau tidak ditemukan.');
        }

        // Check if user is authenticated
        if (!auth()->check()) {
            return view('absensi.scan', compact('absensi'))->with('error', 'Anda harus login terlebih dahulu untuk melakukan absensi.');
        }

        $user = auth()->user();

        // Check if user is mahasiswa
        if ($user->role !== 'mahasiswa') {
            return view('absensi.scan', compact('absensi'))->with('error', 'Hanya mahasiswa yang dapat melakukan absensi.');
        }

        // Check if absensi is active
        if (!$absensi->is_active) {
            return view('absensi.scan', compact('absensi'))->with('error', 'Sesi absensi ini sudah tidak aktif.');
        }

        // Check if current time is within absensi time range
        if (!$absensi->isCurrentlyActive()) {
            return view('absensi.scan', compact('absensi'))->with('error', 'Absensi hanya dapat dilakukan pada jam ' . $absensi->jam_mulai->format('H:i') . ' - ' . $absensi->jam_selesai->format('H:i') . '.');
        }

        // Check if user already attended
        $existingAbsensi = AbsensiMahasiswa::where('absensi_id', $absensi->id)
            ->where('user_id', $user->id)
            ->first();

        if ($existingAbsensi) {
            return view('absensi.scan', compact('absensi'))->with('error', 'Anda sudah melakukan absensi untuk sesi ini pada ' . $existingAbsensi->waktu_absen->format('d/m/Y H:i:s') . '.');
        }

        // Record attendance
        $absensiMahasiswa = AbsensiMahasiswa::create([
            'absensi_id' => $absensi->id,
            'user_id' => $user->id,
            'waktu_absen' => $now,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        $status = $absensiMahasiswa->isOnTime() ? 'Tepat Waktu' : 'Terlambat';

        return view('absensi.scan', compact('absensi'))->with([
            'success' => 'Absensi berhasil dicatat! Terima kasih.',
            'waktu_absen' => $absensiMahasiswa->waktu_absen->format('d/m/Y H:i:s'),
            'status' => $status
        ]);
    }

    /**
     * Show absensi history for mahasiswa
     */
    public function history()
    {
        $user = Auth::user();
        
        if ($user->role !== 'mahasiswa') {
            abort(403);
        }

        $absensiHistory = AbsensiMahasiswa::with('absensi')
            ->where('user_id', $user->id)
            ->latest('waktu_absen')
            ->paginate(10);

        return view('mahasiswa.absensi.history', compact('absensiHistory'));
    }

    /**
     * Show current active absensi for mahasiswa
     */
    public function current()
    {
        $user = Auth::user();
        
        if ($user->role !== 'mahasiswa') {
            abort(403);
        }

        $now = Carbon::now();
        $activeAbsensi = Absensi::where('is_active', true)
            ->where('jam_mulai', '<=', $now)
            ->where('jam_selesai', '>=', $now)
            ->with(['absensiMahasiswa' => function($query) use ($user) {
                $query->where('user_id', $user->id);
            }])
            ->get();

        return view('mahasiswa.absensi.current', compact('activeAbsensi'));
    }
}