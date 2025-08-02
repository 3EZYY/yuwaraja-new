<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\AbsensiMahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SpvAbsensiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Ambil semua absensi yang aktif
        $absensiList = Absensi::where('status', 'aktif')
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_mulai', 'desc')
            ->get();

        // Ambil request absensi dari mahasiswa yang dibimbing SPV ini
        $kelompokIds = $user->kelompokDibimbing->pluck('id');
        $mahasiswaIds = User::whereIn('kelompok_id', $kelompokIds)->pluck('id');
        
        $pendingRequests = AbsensiMahasiswa::with(['absensi', 'mahasiswa', 'mahasiswa.kelompok'])
            ->whereIn('user_id', $mahasiswaIds)
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        $approvedRequests = AbsensiMahasiswa::with(['absensi', 'mahasiswa', 'mahasiswa.kelompok'])
            ->whereIn('user_id', $mahasiswaIds)
            ->where('status', 'approved')
            ->orderBy('approved_at', 'desc')
            ->take(20)
            ->get();

        return view('spv.absensi.index', compact('absensiList', 'pendingRequests', 'approvedRequests'));
    }

    public function approve(Request $request, AbsensiMahasiswa $absensiMahasiswa)
    {
        // Pastikan mahasiswa ini dibimbing oleh SPV yang sedang login
        $user = Auth::user();
        $kelompokIds = $user->kelompokDibimbing->pluck('id');
        $mahasiswaIds = User::whereIn('kelompok_id', $kelompokIds)->pluck('id');
        
        if (!$mahasiswaIds->contains($absensiMahasiswa->user_id)) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menyetujui absensi mahasiswa ini.');
        }

        $absensiMahasiswa->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
            'keterangan' => $request->keterangan
        ]);

        return redirect()->back()->with('success', 'Absensi mahasiswa berhasil disetujui.');
    }

    public function reject(Request $request, AbsensiMahasiswa $absensiMahasiswa)
    {
        // Pastikan mahasiswa ini dibimbing oleh SPV yang sedang login
        $user = Auth::user();
        $kelompokIds = $user->kelompokDibimbing->pluck('id');
        $mahasiswaIds = User::whereIn('kelompok_id', $kelompokIds)->pluck('id');
        
        if (!$mahasiswaIds->contains($absensiMahasiswa->user_id)) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk menolak absensi mahasiswa ini.');
        }

        $absensiMahasiswa->update([
            'status' => 'rejected',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
            'keterangan' => $request->keterangan
        ]);

        return redirect()->back()->with('success', 'Absensi mahasiswa berhasil ditolak.');
    }

    public function show(Request $request, Absensi $absensi)
    {
        $user = Auth::user();
        $kelompokIds = $user->kelompokDibimbing->pluck('id');
        $mahasiswaIds = User::whereIn('kelompok_id', $kelompokIds)->pluck('id');
        
        // Filter berdasarkan status
        $statusFilter = $request->get('status', 'all');
        
        $query = AbsensiMahasiswa::with(['mahasiswa', 'mahasiswa.kelompok', 'approvedBy'])
            ->where('absensi_id', $absensi->id)
            ->whereIn('user_id', $mahasiswaIds);
            
        if ($statusFilter !== 'all') {
            $query->where('status', $statusFilter);
        }
        
        $requests = $query->orderBy('created_at', 'desc')->paginate(20);
        
        // Statistik
        $totalRequests = AbsensiMahasiswa::where('absensi_id', $absensi->id)
            ->whereIn('user_id', $mahasiswaIds)
            ->count();
            
        $approvedCount = AbsensiMahasiswa::where('absensi_id', $absensi->id)
            ->whereIn('user_id', $mahasiswaIds)
            ->where('status', 'approved')
            ->count();
            
        $pendingCount = AbsensiMahasiswa::where('absensi_id', $absensi->id)
            ->whereIn('user_id', $mahasiswaIds)
            ->where('status', 'pending')
            ->count();
            
        $rejectedCount = AbsensiMahasiswa::where('absensi_id', $absensi->id)
            ->whereIn('user_id', $mahasiswaIds)
            ->where('status', 'rejected')
            ->count();

        return view('spv.absensi.show', compact(
            'absensi', 
            'requests', 
            'totalRequests', 
            'approvedCount', 
            'pendingCount', 
            'rejectedCount'
        ));
    }
}