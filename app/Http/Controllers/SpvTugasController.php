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
        $spv = auth()->user();
        
        // Ambil kelompok yang di-supervisi oleh SPV ini
        $kelompokIds = \App\Models\Kelompok::where('spv_id', $spv->id)->pluck('id');
        
        // Ambil pengumpulan tugas hanya dari mahasiswa di kelompok yang di-supervisi
        $pengumpulans = PengumpulanTugas::with(['user', 'tugas', 'kelompok'])
            ->whereHas('user', function($query) use ($kelompokIds) {
                $query->whereIn('kelompok_id', $kelompokIds);
            })
            ->latest()
            ->paginate(10);
            
        return view('spv.pengumpulan.index', compact('pengumpulans'));
    }

    // Detail tugas dan semua pengumpulannya
    public function show($id)
    {
        $spv = auth()->user();
        $tugas = Tugas::findOrFail($id);
        
        // Ambil kelompok yang di-supervisi oleh SPV ini
        $kelompokIds = \App\Models\Kelompok::where('spv_id', $spv->id)->pluck('id');
        
        // Ambil pengumpulan tugas hanya dari mahasiswa di kelompok yang di-supervisi
        $pengumpulans = PengumpulanTugas::with(['user', 'kelompok'])
            ->where('tugas_id', $id)
            ->whereHas('user', function($query) use ($kelompokIds) {
                $query->whereIn('kelompok_id', $kelompokIds);
            })
            ->latest()
            ->paginate(10);
        
        return view('spv.tugas.show', compact('tugas', 'pengumpulans'));
    }

    // Detail pengumpulan tugas mahasiswa tertentu
    public function showPengumpulan($id)
    {
        $spv = auth()->user();
        
        // Ambil kelompok yang di-supervisi oleh SPV ini
        $kelompokIds = \App\Models\Kelompok::where('spv_id', $spv->id)->pluck('id');
        
        // Ambil pengumpulan tugas hanya jika mahasiswa ada di kelompok yang di-supervisi
        $pengumpulan = PengumpulanTugas::with(['user', 'tugas', 'kelompok'])
            ->whereHas('user', function($query) use ($kelompokIds) {
                $query->whereIn('kelompok_id', $kelompokIds);
            })
            ->findOrFail($id);
            
        return view('spv.tugas.detail-pengumpulan', compact('pengumpulan'));
    }

    // Approve tugas dan beri nilai/keterangan
    public function approve(Request $request, $id)
    {
        // Validate input
        $validated = $request->validate([
            'nilai' => 'nullable|integer|min:0|max:100',
            'keterangan' => 'nullable|string|max:1000',
            'status' => 'required|in:reviewed,approved,done,rejected'
        ]);

        // Additional validation: nilai is required when status is 'done'
        if ($validated['status'] === 'done' && empty($validated['nilai'])) {
            return back()->withErrors(['nilai' => 'Nilai wajib diisi ketika status adalah "Tugas Selesai".']);
        }

        // Additional validation: keterangan is required when status is 'rejected'
        if ($validated['status'] === 'rejected' && empty($validated['keterangan'])) {
            return back()->withErrors(['keterangan' => 'Keterangan wajib diisi ketika status adalah "Butuh Perbaikan".']);
        }
        
        $spv = auth()->user();
        
        // Ambil kelompok yang di-supervisi oleh SPV ini
        $kelompokIds = \App\Models\Kelompok::where('spv_id', $spv->id)->pluck('id');
        
        // Pastikan pengumpulan tugas adalah dari mahasiswa di kelompok yang di-supervisi
        $pengumpulan = PengumpulanTugas::whereHas('user', function($query) use ($kelompokIds) {
            $query->whereIn('kelompok_id', $kelompokIds);
        })->findOrFail($id);
        
        $pengumpulan->status = $validated['status'];
        
        // Only set nilai when status is 'done', otherwise reset to null
        if ($validated['status'] === 'done') {
            $pengumpulan->nilai = $validated['nilai'];
        } else {
            $pengumpulan->nilai = null;
        }
        
        $pengumpulan->keterangan = $validated['keterangan'];
        $pengumpulan->save();
        
        // Pesan sukses berdasarkan status
        $messages = [
            'reviewed' => 'Tugas telah ditandai sedang direview.',
            'approved' => 'Tugas telah disetujui.',
            'rejected' => 'Tugas telah ditolak dan mahasiswa dapat mengumpulkan kembali.',
            'done' => 'Tugas telah diselesaikan dan dinilai.'
        ];
        
        $message = $messages[$validated['status']] ?? 'Status tugas berhasil diperbarui.';
        
        // TODO: Trigger notifikasi ke mahasiswa jika status berubah
        return redirect()->back()->with('success', $message);
    }
}
