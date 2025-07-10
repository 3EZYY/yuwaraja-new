<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelompok;
use App\Models\Tugas;
use App\Models\Pengumuman;
use App\Models\JadwalAcara;
use App\Models\PengumpulanTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $totalSupervisor = User::where('role', 'spv')->count();
        $totalKelompok = Kelompok::count();
        
        $pengumumanTerbaru = Pengumuman::latest()->take(5)->get();
        $jadwalTerbaru = JadwalAcara::latest()->take(5)->get();
        
        return view('admin.dashboard', compact(
            'totalUsers', 
            'totalMahasiswa', 
            'totalSupervisor', 
            'totalKelompok',
            'pengumumanTerbaru',
            'jadwalTerbaru'
        ));
    }

    public function users()
    {
        $users = User::with('kelompok')->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function kelompok()
    {
        $kelompoks = Kelompok::with(['members', 'supervisor'])->paginate(20);
        return view('admin.kelompok', compact('kelompoks'));
    }

    public function tugas()
    {
        $tugas = Tugas::withCount('pengumpulan')->paginate(20);
        return view('admin.tugas', compact('tugas'));
    }

    public function pengumuman()
    {
        $pengumumans = Pengumuman::latest()->paginate(20);
        return view('admin.pengumuman', compact('pengumumans'));
    }

    public function jadwal()
    {
        $jadwals = JadwalAcara::latest()->paginate(20);
        return view('admin.jadwal', compact('jadwals'));
    }
}
