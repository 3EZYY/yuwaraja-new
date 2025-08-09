<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengumpulanTugas;
use App\Models\Tugas;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

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
        $pengumpulans = PengumpulanTugas::with(['user.kelompok', 'tugas', 'kelompok'])
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
        $pengumpulans = PengumpulanTugas::with(['user.kelompok', 'kelompok'])
            ->where('tugas_id', $id)
            ->whereHas('user', function($query) use ($kelompokIds) {
                $query->whereIn('kelompok_id', $kelompokIds);
            })
            ->latest()
            ->paginate(10);
        
        // Check if this is an AJAX request for modal
        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'tugas' => $tugas,
                'pengumpulans' => $pengumpulans,
                'html' => view('spv.tugas.modal-content', compact('tugas', 'pengumpulans'))->render()
            ]);
        }
        
        return view('spv.tugas.show', compact('tugas', 'pengumpulans'));
    }

    // Detail pengumpulan tugas mahasiswa tertentu
    public function showPengumpulan($id)
    {
        $spv = auth()->user();
        
        // Ambil kelompok yang di-supervisi oleh SPV ini
        $kelompokIds = \App\Models\Kelompok::where('spv_id', $spv->id)->pluck('id');
        
        // Ambil pengumpulan tugas dengan eager loading yang benar
        $pengumpulan = PengumpulanTugas::with([
                'user.kelompok', // Relasi kelompok melalui user (data terbaru)
                'tugas',
                'kelompok' // Tetap load relasi kelompok langsung untuk backward compatibility
            ])
            ->whereHas('user', function($query) use ($kelompokIds) {
                $query->whereIn('kelompok_id', $kelompokIds);
            })
            ->findOrFail($id);
        
        // Sinkronkan kelompok_id jika tidak sesuai dengan user
        if ($pengumpulan->user && $pengumpulan->user->kelompok_id && 
            $pengumpulan->kelompok_id !== $pengumpulan->user->kelompok_id) {
            $pengumpulan->kelompok_id = $pengumpulan->user->kelompok_id;
            $pengumpulan->save();
            
            // Reload relasi kelompok setelah update
            $pengumpulan->load('kelompok');
        }
            
        return view('spv.tugas.detail-pengumpulan', compact('pengumpulan'));
    }

    // Approve tugas dan beri nilai/feedback
    public function approve(Request $request, $id)
    {
        // Validate input
        $validated = $request->validate([
            'nilai' => 'nullable|integer|min:0|max:100',
            'feedback' => 'nullable|string|max:1000',
            'status' => 'required|in:reviewed,approved,done,rejected'
        ]);

        // Additional validation: nilai is required when status is 'done'
        if ($validated['status'] === 'done' && empty($validated['nilai'])) {
            return back()->withErrors(['nilai' => 'Nilai wajib diisi ketika status adalah "Tugas Selesai".']);
        }

        // Additional validation: feedback is required when status is 'rejected'
        if ($validated['status'] === 'rejected' && empty($validated['feedback'])) {
            return back()->withErrors(['feedback' => 'Feedback wajib diisi ketika status adalah "Butuh Perbaikan".']);
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
        
        $pengumpulan->feedback = $validated['feedback'];
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
    
    // Download file pengumpulan tugas dengan validasi akses
    public function downloadFile($id)
    {
        $spv = auth()->user();
        
        // Ambil kelompok yang di-supervisi oleh SPV ini
        $kelompokIds = \App\Models\Kelompok::where('spv_id', $spv->id)->pluck('id');
        
        // Pastikan pengumpulan tugas adalah dari mahasiswa di kelompok yang di-supervisi
        $pengumpulan = PengumpulanTugas::with(['user', 'tugas'])
            ->whereHas('user', function($query) use ($kelompokIds) {
                $query->whereIn('kelompok_id', $kelompokIds);
            })
            ->findOrFail($id);
        
        // Cek apakah file exists
        if (!$pengumpulan->file_path) {
            abort(404, 'File tidak ditemukan.');
        }
        
        $filePath = storage_path('app/public/' . $pengumpulan->file_path);
        
        // Cek apakah file fisik ada
        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan di server.');
        }
        
        // Ambil informasi file
        $originalName = basename($pengumpulan->file_path);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        
        // Buat nama file yang lebih descriptive
        $downloadName = sprintf(
            '%s_%s_%s.%s',
            str_replace(' ', '_', $pengumpulan->tugas->judul ?? 'tugas'),
            str_replace(' ', '_', $pengumpulan->user->name ?? 'mahasiswa'),
            date('Y-m-d', strtotime($pengumpulan->created_at)),
            $extension
        );
        
        // Tentukan MIME type
        $mimeType = $this->getMimeType($extension);
        
        // Return file response dengan header yang benar
        return Response::download($filePath, $downloadName, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'attachment; filename="' . $downloadName . '"',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ]);
    }
    
    // Helper method untuk mendapatkan MIME type
    private function getMimeType($extension)
    {
        $mimeTypes = [
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls' => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'ppt' => 'application/vnd.ms-powerpoint',
            'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'txt' => 'text/plain',
            'rtf' => 'application/rtf',
            'odt' => 'application/vnd.oasis.opendocument.text',
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            '7z' => 'application/x-7z-compressed',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'svg' => 'image/svg+xml',
        ];
        
        return $mimeTypes[strtolower($extension)] ?? 'application/octet-stream';
    }
}
