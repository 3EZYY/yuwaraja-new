<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tugas;
use App\Models\PengumpulanTugas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TugasController extends Controller
{
    public function show(Tugas $tugas)
    {
        $user = Auth::user();
        
        // Cek apakah user sudah mengumpulkan tugas ini
        $pengumpulan = null;
        if ($user->kelompok_id) {
            $pengumpulan = PengumpulanTugas::where('tugas_id', $tugas->id)
                ->where('kelompok_id', $user->kelompok_id)
                ->first();
        }

        return view('tugas.show', compact('tugas', 'pengumpulan'));
    }

    public function submit(Request $request, Tugas $tugas)
    {
        $user = Auth::user();
        
        if (!$user->kelompok_id) {
            return back()->with('error', 'Anda belum tergabung dalam kelompok');
        }

        $request->validate([
            'file' => 'required|file|max:10240', // Max 10MB
            'keterangan' => 'nullable|string|max:1000'
        ]);

        // Upload file
        $filePath = $request->file('file')->store('pengumpulan-tugas', 'public');

        // Simpan atau update pengumpulan
        PengumpulanTugas::updateOrCreate(
            [
                'tugas_id' => $tugas->id,
                'kelompok_id' => $user->kelompok_id
            ],
            [
                'file_path' => $filePath,
                'keterangan' => $request->keterangan,
                'status' => 'submitted',
                'submitted_at' => now()
            ]
        );

        return back()->with('success', 'Tugas berhasil dikumpulkan!');
    }
}
