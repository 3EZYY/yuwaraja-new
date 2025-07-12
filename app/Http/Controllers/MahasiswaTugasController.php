<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\PengumpulanTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaTugasController extends Controller
{
    public function index()
    {
        $tugas = Tugas::latest()->get();
        $pengumpulanTugas = PengumpulanTugas::where('user_id', Auth::id())
            ->get()
            ->keyBy('tugas_id');

        return view('mahasiswa.tugas.index', compact('tugas', 'pengumpulanTugas'));
    }

    public function show(Tugas $tugas)
    {
        $pengumpulan = PengumpulanTugas::where('user_id', Auth::id())
            ->where('tugas_id', $tugas->id)
            ->first();

        return view('mahasiswa.tugas.show', compact('tugas', 'pengumpulan'));
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

        return view('mahasiswa.tugas.kerjakan', compact('tugas', 'pengumpulan'));
    }

    public function submit(Request $request, Tugas $tugas)
    {
        $request->validate([
            'konten' => 'required|string',
            'file' => 'nullable|file|max:10240' // max 10MB
        ]);

        $pengumpulan = PengumpulanTugas::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'tugas_id' => $tugas->id,
            ],
            [
                'konten' => $request->konten,
                'status' => 'submitted'
            ]
        );

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('pengumpulan', $filename, 'public');
            $pengumpulan->file = $filename;
            $pengumpulan->save();
        }

        return redirect()->route('mahasiswa.tugas.show', $tugas)
            ->with('success', 'Tugas berhasil dikumpulkan dan menunggu review dari SPV.');
    }
}
