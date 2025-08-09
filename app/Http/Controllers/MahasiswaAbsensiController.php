<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\AbsensiMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MahasiswaAbsensiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Ambil absensi yang aktif dan masih dalam rentang waktu
        $absensiAktif = Absensi::where('status', 'aktif')
            ->where('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal', 'asc')
            ->orderBy('jam_mulai', 'asc')
            ->get();

        // Ambil riwayat absensi mahasiswa dengan pagination
        $riwayatAbsensi = AbsensiMahasiswa::with(['absensi', 'approvedBy'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('mahasiswa.absensi.index', compact('absensiAktif', 'riwayatAbsensi'));
    }

    public function request(Request $request, Absensi $absensi)
    {
        $user = Auth::user();
        
        // Cek apakah absensi masih aktif
        if ($absensi->status !== 'aktif') {
            return redirect()->back()->with('error', 'Absensi ini sudah tidak aktif.');
        }

        // Cek apakah masih dalam rentang waktu
        $now = now();
        $tanggalAbsensi = Carbon::parse($absensi->tanggal);
        
        // Format tanggal dan waktu dengan benar
        $tanggalString = $tanggalAbsensi->format('Y-m-d');
        $jamMulai = Carbon::parse($tanggalString . ' ' . $absensi->jam_mulai);
        $jamSelesai = Carbon::parse($tanggalString . ' ' . $absensi->jam_selesai);

        if ($now->toDateString() !== $tanggalAbsensi->toDateString()) {
            return redirect()->back()->with('error', 'Absensi hanya bisa dilakukan pada tanggal yang ditentukan.');
        }

        if ($now < $jamMulai || $now > $jamSelesai) {
            return redirect()->back()->with('error', 'Absensi hanya bisa dilakukan dalam rentang waktu yang ditentukan.');
        }

        // Cek apakah sudah pernah absen
        $existingAbsensi = AbsensiMahasiswa::where('absensi_id', $absensi->id)
            ->where('user_id', $user->id)
            ->first();

        if ($existingAbsensi) {
            return redirect()->back()->with('error', 'Anda sudah melakukan absensi untuk kegiatan ini.');
        }

        // Buat request absensi
        AbsensiMahasiswa::create([
            'absensi_id' => $absensi->id,
            'user_id' => $user->id,
            'status' => 'pending',
            'waktu_absen' => now(),
            'keterangan' => $request->keterangan
        ]);

        return redirect()->back()->with('success', 'absensi kamu masuk ke Kakak SPV yaaa ^^');
    }

    public function show(Absensi $absensi)
    {
        $user = Auth::user();
        
        // Ambil data absensi mahasiswa untuk absensi ini
        $absensiMahasiswa = AbsensiMahasiswa::where('absensi_id', $absensi->id)
            ->where('user_id', $user->id)
            ->first();

        return view('mahasiswa.absensi.show', compact('absensi', 'absensiMahasiswa'));
    }
}