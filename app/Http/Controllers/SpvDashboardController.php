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

        // Data untuk SPV
        $kelompokDibimbing = Kelompok::where('spv_id', $user->id)->get();
        $mahasiswaDibimbing = User::whereIn('kelompok_id', $kelompokDibimbing->pluck('id'))->get();
        $pengumuman = Pengumuman::latest()->take(5)->get();
        $jadwal = JadwalAcara::where('tanggal_mulai', '>=', now())->orderBy('tanggal_mulai')->get();
        $tugas = Tugas::all();

        // Statistik
        $totalKelompok = $kelompokDibimbing->count();
        $totalMahasiswa = $mahasiswaDibimbing->count();
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

    public function cluster(Request $request)
    {
        $user = Auth::user();
        // Ambil semua prodi unik dari mahasiswa yang dibimbing
        $prodiList = User::whereIn('kelompok_id', function($q) use ($user) {
            $q->select('id')->from('kelompoks')->where('spv_id', $user->id);
        })->select('program_studi')->distinct()->pluck('program_studi');

        $filterProdi = $request->input('prodi');
        $kelompokDibimbing = Kelompok::where('spv_id', $user->id)
            ->with(['mahasiswa' => function($q) use ($filterProdi) {
                if ($filterProdi) {
                    $q->where('program_studi', $filterProdi);
                }
            }])
            ->get();

        return view('spv.cluster', compact('kelompokDibimbing', 'prodiList', 'filterProdi'));
    }
}
