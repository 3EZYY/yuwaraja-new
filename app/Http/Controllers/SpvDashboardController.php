<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;
use App\Models\JadwalAcara;
use App\Models\Tugas;
use App\Models\PengumpulanTugas;
use App\Models\User;
use App\Models\Kelompok;
use Illuminate\Support\Facades\Auth;

class SpvDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Data untuk SPV
        $kelompokDibimbing = Kelompok::where('spv_id', $user->id)->get();
        $mahasiswaDibimbing = User::whereIn('kelompok_id', $kelompokDibimbing->pluck('id'))->get();
        $pengumuman = Pengumuman::latest()->take(5)->get();
        $jadwal = JadwalAcara::where('tanggal_mulai', '>=', now())->orderBy('tanggal_mulai')->get();
        $tugas = Tugas::all();
        
        // Statistik
        $totalKelompok = $kelompokDibimbing->count();
        $totalMahasiswa = $mahasiswaDibimbing->count();
        $tugasSelesai = PengumpulanTugas::whereIn('user_id', $mahasiswaDibimbing->pluck('id'))->count();

        return view('spv.dashboard', compact(
            'user', 
            'kelompokDibimbing', 
            'mahasiswaDibimbing',
            'pengumuman', 
            'jadwal', 
            'tugas',
            'totalKelompok',
            'totalMahasiswa',
            'tugasSelesai'
        ));
    }

    public function kelompok()
    {
        $user = Auth::user();
        $kelompokDibimbing = Kelompok::where('spv_id', $user->id)->with('mahasiswa')->get();
        
        return view('spv.kelompok', compact('kelompokDibimbing'));
    }

    public function tugasReview()
    {
        $user = Auth::user();
        $kelompokDibimbing = Kelompok::where('spv_id', $user->id)->get();
        $mahasiswaDibimbing = User::whereIn('kelompok_id', $kelompokDibimbing->pluck('id'))->get();
        
        $pengumpulanTugas = PengumpulanTugas::whereIn('user_id', $mahasiswaDibimbing->pluck('id'))
            ->with(['user', 'tugas'])
            ->latest()
            ->get();
        
        return view('spv.tugas-review', compact('pengumpulanTugas'));
    }
}
