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
    public function pengumuman()
    {
        $pengumuman = Pengumuman::latest()->paginate(10);
        return view('spv.pengumuman.index', compact('pengumuman'));
    }

    public function showPengumuman(Pengumuman $pengumuman)
    {
        return view('spv.pengumuman-detail', compact('pengumuman'));
    }

    public function showJadwal(JadwalAcara $jadwal)
    {
        return view('spv.jadwal-detail', compact('jadwal'));
    }
    
    public function index()
    {
        $user = Auth::user();

        // Data untuk dashboard - selalu ambil data terbaru
        $kelompokDibimbing = Kelompok::where('spv_id', $user->id)
            ->orderBy('updated_at', 'desc')
            ->get();
        $mahasiswaDibimbing = User::whereIn('kelompok_id', $kelompokDibimbing->pluck('id'))->get();
        $pengumuman = Pengumuman::latest()->take(5)->get();
        $jadwal = JadwalAcara::where('tanggal_mulai', '>=', now())->orderBy('tanggal_mulai')->get();
        $tugas = Tugas::all();

        // Statistik
        $totalKelompok = $kelompokDibimbing->count();
        $totalMahasiswa = $kelompokDibimbing->sum(function ($kelompok) {
            return $kelompok->anggota->count();
        });
        $tugasSelesai = PengumpulanTugas::whereIn('kelompok_id', $kelompokDibimbing->pluck('id'))->count();

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
}
