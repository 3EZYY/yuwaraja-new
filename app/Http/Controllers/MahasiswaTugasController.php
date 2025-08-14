<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use App\Models\PengumpulanTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

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

        // Cek apakah tugas sudah selesai (done) - tidak bisa mengumpulkan lagi
        if ($pengumpulan && $pengumpulan->status === 'done') {
            return redirect()->route('mahasiswa.tugas.show', $tugas)
                ->with('error', 'Tugas ini sudah selesai dan dinilai. Anda tidak dapat mengumpulkan lagi.');
        }

        // Jika status rejected, mahasiswa bisa mengumpulkan kembali
        $kerjakanMode = true;
        return view('mahasiswa.tugas.penugasan', compact('tugas', 'pengumpulan', 'kerjakanMode'));
    }

    public function submit(Request $request, Tugas $tugas)
    {
        $request->validate([
            'file' => 'nullable|file|mimes:pdf,doc,docx,zip,rar|max:10240', // Max 10MB
            'keterangan' => 'nullable|string|max:2000',
        ]);

        // Ambil kelompok_id dari user yang sedang login
        $user = Auth::user();
        $kelompokId = $user->kelompok_id;

        $pengumpulan = PengumpulanTugas::firstOrNew(
            [
                'user_id' => Auth::id(),
                'tugas_id' => $tugas->id,
            ]
        );

        // Cek apakah tugas sudah selesai (done) - tidak bisa mengumpulkan lagi
        if ($pengumpulan->exists && $pengumpulan->status === 'done') {
            return redirect()->route('mahasiswa.tugas.show', $tugas)
                ->with('error', 'Tugas ini sudah selesai dan dinilai. Anda tidak dapat mengumpulkan lagi.');
        }

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($pengumpulan->file_path) {
                Storage::disk('public')->delete($pengumpulan->file_path);
            }
            $filePath = $request->file('file')->store('pengumpulan', 'public');
            $pengumpulan->file_path = $filePath;
        }

        $pengumpulan->keterangan = $request->keterangan;
        $pengumpulan->status = 'submitted'; // Reset status ke submitted untuk review ulang
        $pengumpulan->submitted_at = now();
        
        // Pastikan kelompok_id tersimpan
        $pengumpulan->kelompok_id = $kelompokId;
        
        // Reset nilai dan feedback jika ini adalah resubmission
        if ($pengumpulan->exists) {
            $pengumpulan->nilai = null;
            $pengumpulan->feedback = null;
        }

        $pengumpulan->save();

        $message = $pengumpulan->wasRecentlyCreated 
            ? 'Tugas berhasil dikumpulkan!' 
            : 'Tugas berhasil dikumpulkan kembali dan akan direview ulang!';

        return redirect()->route('mahasiswa.tugas.show', $tugas)
            ->with('success', $message);
    }

    public function downloadTaskFile(Tugas $tugas)
    {
        // Cek apakah file tugas ada
        if (!$tugas->file_path) {
            abort(404, 'File tugas tidak ditemukan.');
        }

        $filePath = storage_path('app/public/' . $tugas->file_path);
        
        // Cek apakah file fisik ada
        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan di server.');
        }

        // Ambil informasi file
        $originalName = basename($tugas->file_path);
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        
        // Buat nama file yang lebih descriptive
        $downloadName = sprintf(
            '%s.%s',
            str_replace(' ', '_', $tugas->judul ?? 'tugas'),
            $extension
        );

        // Tentukan MIME type
        $mimeType = $this->getMimeType($extension);

        // Return file response dengan header yang benar
        return response()->download($filePath, $downloadName, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'attachment; filename="' . $downloadName . '"',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ]);
    }

    private function getMimeType($extension)
    {
        $mimeTypes = [
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'txt' => 'text/plain',
        ];

        return $mimeTypes[strtolower($extension)] ?? 'application/octet-stream';
    }

    public function downloadSubmission(PengumpulanTugas $pengumpulan)
    {
        // Pastikan pengumpulan adalah milik user yang sedang login
        if ($pengumpulan->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk mengunduh file ini.');
        }

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
            '%s_%s.%s',
            str_replace(' ', '_', $pengumpulan->tugas->judul ?? 'tugas'),
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
}
