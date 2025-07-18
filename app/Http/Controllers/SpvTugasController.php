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
        $tugas = Tugas::latest()->paginate(10);
        return view('spv.tugas.index', compact('tugas'));
    }

    // Daftar pengumpulan tugas mahasiswa
    public function pengumpulan()
    {
        $pengumpulans = PengumpulanTugas::with(['user', 'tugas'])->latest()->paginate(10);
        return view('spv.pengumpulan.index', compact('pengumpulans'));
    }

    // Detail tugas dan semua pengumpulannya
    public function show($id)
    {
        $tugas = Tugas::findOrFail($id);
        $pengumpulans = PengumpulanTugas::with(['user', 'kelompok'])
            ->where('tugas_id', $id)
            ->latest()
            ->paginate(10);
        
        return view('spv.tugas.show', compact('tugas', 'pengumpulans'));
    }

    // Detail pengumpulan tugas mahasiswa tertentu
    public function showPengumpulan($id)
    {
        $pengumpulan = PengumpulanTugas::with(['user', 'tugas', 'kelompok'])->findOrFail($id);
        return view('spv.tugas.detail-pengumpulan', compact('pengumpulan'));
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
