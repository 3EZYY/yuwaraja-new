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

        $kerjakanMode = true;
        return view('mahasiswa.tugas.penugasan', compact('tugas', 'pengumpulan', 'kerjakanMode'));
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
