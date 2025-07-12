<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengumpulanTugas;
use App\Models\Tugas;
use App\Models\User;

class SpvTugasController extends Controller
{
    // Daftar semua pengumpulan tugas mahasiswa
    public function index()
    {
        $pengumpulans = PengumpulanTugas::with(['user', 'tugas'])->get();
        return view('spv.tugas.index', compact('pengumpulans'));
    }

    // Detail pengumpulan tugas mahasiswa
    public function show($id)
    {
        $pengumpulan = PengumpulanTugas::with(['user', 'tugas'])->findOrFail($id);
        return view('spv.tugas.show', compact('pengumpulan'));
    }

    // Approve tugas dan beri nilai/keterangan
    public function approve(Request $request, $id)
    {
        $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:reviewed,approved,done',
        ]);
        $pengumpulan = PengumpulanTugas::findOrFail($id);
        $pengumpulan->status = $request->input('status');
        $pengumpulan->nilai = $request->input('nilai');
        $pengumpulan->keterangan = $request->input('keterangan');
        $pengumpulan->save();
        // TODO: Trigger notifikasi ke mahasiswa jika status berubah
        return redirect()->back()->with('success', 'Status tugas dan nilai berhasil diperbarui.');
    }
}
