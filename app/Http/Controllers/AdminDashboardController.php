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

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Data untuk Admin
        $totalUsers = User::count();
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $totalSpv = User::where('role', 'spv')->count();
        $totalKelompok = Kelompok::count();
        $totalTugas = Tugas::count();
        $totalPengumuman = Pengumuman::count();
        $totalJadwal = JadwalAcara::count();
        $totalPengumpulan = PengumpulanTugas::count();
        
        // Data terbaru
        $pengumumanTerbaru = Pengumuman::latest()->take(5)->get();
        $jadwalTerbaru = JadwalAcara::latest()->take(5)->get();
        $pengumpulanTerbaru = PengumpulanTugas::with(['user', 'tugas'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'user',
            'totalUsers',
            'totalMahasiswa',
            'totalSpv',
            'totalKelompok',
            'totalTugas',
            'totalPengumuman',
            'totalJadwal',
            'totalPengumpulan',
            'pengumumanTerbaru',
            'jadwalTerbaru',
            'pengumpulanTerbaru'
        ));
    }

    public function users()
    {
        $users = User::with('kelompok')->latest()->get();
        return view('admin.users', compact('users'));
    }

    public function kelompok()
    {
        $kelompok = Kelompok::with(['spv', 'mahasiswa'])->latest()->get();
        return view('admin.kelompok', compact('kelompok'));
    }

    public function tugas()
    {
        $tugas = Tugas::with('pengumpulan')->latest()->get();
        return view('admin.tugas', compact('tugas'));
    }

    public function pengumuman()
    {
        $pengumuman = Pengumuman::latest()->get();
        return view('admin.pengumuman', compact('pengumuman'));
    }

    public function jadwal()
    {
        $jadwal = JadwalAcara::latest()->get();
        return view('admin.jadwal', compact('jadwal'));
    }
}
