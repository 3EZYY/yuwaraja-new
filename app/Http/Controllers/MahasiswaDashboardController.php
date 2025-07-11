<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;
use App\Models\JadwalAcara;
use App\Models\Tugas;
use App\Models\PengumpulanTugas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

class MahasiswaDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pengumuman = Pengumuman::latest()->take(5)->get();
        $jadwal = JadwalAcara::where('tanggal_mulai', '>=', now())->orderBy('tanggal_mulai')->get();
        $tugas = Tugas::all();

        return view('mahasiswa.dashboard', compact('user', 'pengumuman', 'jadwal', 'tugas'));
    }

    public function showTugas(Tugas $tugas)
    {
        $user = Auth::user();

        // Cek apakah mahasiswa sudah mengumpulkan tugas ini
        $pengumpulan = PengumpulanTugas::where('user_id', $user->id)
            ->where('tugas_id', $tugas->id)
            ->first();

        return view('mahasiswa.show-tugas', compact('tugas', 'pengumpulan'));
    }

    public function submitTugas(Request $request, Tugas $tugas): RedirectResponse
    {
        $user = Auth::user();

        Log::info('Memulai submitTugas untuk tugas ID: ' . $tugas->id . ' oleh user ID: ' . $user->id);

        // Validasi request
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx|max:5120', // max 5MB
        ], [
            'file.required' => 'File tugas wajib diupload.',
            'file.mimes' => 'File harus berformat PDF, DOC, atau DOCX.',
            'file.max' => 'File tidak boleh lebih dari 5MB.',
        ]);
        Log::info('Validasi request berhasil.');

        // Cek apakah sudah melewati deadline
        if (now() > $tugas->deadline) {
            Log::warning('Pengumpulan tugas gagal: Deadline terlampaui untuk tugas ID: ' . $tugas->id);
            return back()->with('error', 'Waktu pengumpulan tugas sudah berakhir.');
        }
        Log::info('Deadline belum terlampaui.');

        // Cek apakah sudah pernah mengumpulkan
        $existingPengumpulan = PengumpulanTugas::where('user_id', $user->id)
            ->where('tugas_id', $tugas->id)
            ->first();

        if ($existingPengumpulan) {
            Log::warning('Pengumpulan tugas gagal: Tugas sudah pernah dikumpulkan oleh user ID: ' . $user->id . ' untuk tugas ID: ' . $tugas->id);
            return back()->with('error', 'Anda sudah mengumpulkan tugas ini sebelumnya.');
        }
        Log::info('Tugas belum pernah dikumpulkan sebelumnya.');

        // Upload file
        $file = $request->file('file');
        $fileName = time() . '_' . $user->nim . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('tugas', $fileName, 'public');
        Log::info('File berhasil diupload ke: ' . $filePath);

        // Simpan ke database
        PengumpulanTugas::create([
            'user_id' => $user->id,
            'tugas_id' => $tugas->id,
            'kelompok_id' => $user->kelompok_id, // tambahkan kelompok_id
            'file_path' => $filePath,
            'submitted_at' => now(),
        ]);
        Log::info('Data pengumpulan tugas berhasil disimpan ke database.');

        return back()->with('success', 'Tugas berhasil dikumpulkan!');
    }
}
