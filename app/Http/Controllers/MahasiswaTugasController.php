<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\PengumpulanTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MahasiswaTugasController extends Controller
{
    public function index()
    {
        $tugas = Tugas::latest()->get();
        $pengumpulanTugas = PengumpulanTugas::where('user_id', Auth::id())
            ->get()
            ->keyBy('tugas_id');
        $listMode = true;
        return view('mahasiswa.tugas.penugasan', compact('tugas', 'pengumpulanTugas', 'listMode'));
    }

    public function show(Tugas $tugas)
    {
        $pengumpulan = PengumpulanTugas::where('user_id', Auth::id())
            ->where('tugas_id', $tugas->id)
            ->first();
        $detailMode = true;
        return view('mahasiswa.tugas.penugasan', compact('tugas', 'pengumpulan', 'detailMode'));
    }

    public function kerjakan(Tugas $tugas)
    {
        $pengumpulan = PengumpulanTugas::where('user_id', Auth::id())
            ->where('tugas_id', $tugas->id)
            ->first();

        if ($pengumpulan && $pengumpulan->status === 'done') {
            return redirect()->route('mahasiswa.tugas.show', $tugas)
                ->with('error', 'Tugas ini sudah selesai dan dinilai.');
        }

        return view('mahasiswa.tugas.penugasan', compact('tugas', 'pengumpulan', 'kerjakanMode'));
    }

    public function submit(Request $request, Tugas $tugas)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx,zip,rar|max:10240', // Max 10MB
            'keterangan' => 'nullable|string|max:2000',
        ]);

        $pengumpulan = PengumpulanTugas::firstOrNew(
            [
                'user_id' => Auth::id(),
                'tugas_id' => $tugas->id,
            ]
        );

        if ($request->hasFile('file')) {
            if ($pengumpulan->file_path) {
                Storage::disk('public')->delete($pengumpulan->file_path);
            }
            $filePath = $request->file('file')->store('pengumpulan', 'public');
            $pengumpulan->file_path = $filePath;
        }

        $pengumpulan->keterangan = $request->keterangan;
        $pengumpulan->status = 'submitted';
        $pengumpulan->submitted_at = now();

        $pengumpulan->save();

        return redirect()->route('mahasiswa.tugas.show', $tugas)
            ->with('success', 'Tugas berhasil dikumpulkan!');
    }
}
