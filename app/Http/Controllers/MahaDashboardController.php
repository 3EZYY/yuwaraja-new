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
        
        // Validasi request
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx|max:5120', // max 5MB
        ], [
            'file.required' => 'File tugas wajib diupload.',
            'file.mimes' => 'File harus berformat PDF, DOC, atau DOCX.',
            'file.max' => 'File tidak boleh lebih dari 5MB.',
        ]);

        // Cek apakah sudah melewati deadline
        if (now() > $tugas->deadline) {
            return back()->with('error', 'Waktu pengumpulan tugas sudah berakhir.');
        }

        // Cek apakah sudah pernah mengumpulkan
        $existingPengumpulan = PengumpulanTugas::where('user_id', $user->id)
            ->where('tugas_id', $tugas->id)
            ->first();

        if ($existingPengumpulan) {
            return back()->with('error', 'Anda sudah mengumpulkan tugas ini sebelumnya.');
        }

        // Upload file
        $file = $request->file('file');
        $fileName = time() . '_' . $user->nim . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('tugas', $fileName, 'public');

        // Simpan ke database
        PengumpulanTugas::create([
            'user_id' => $user->id,
            'tugas_id' => $tugas->id,
            'file_path' => $filePath,
            'tanggal_submit' => now(),
        ]);

        return back()->with('success', 'Tugas berhasil dikumpulkan!');
    }
}
