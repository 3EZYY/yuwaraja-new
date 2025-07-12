<?php

namespace App\Http\Controllers;

use App\Models\JadwalAcara;
use Illuminate\Http\Request;

class MahasiswaJadwalController extends Controller
{

    public function index()
    {
        $jadwal = JadwalAcara::orderBy('tanggal_mulai')->paginate(10);
        $listMode = true;
        return view('mahasiswa.jadwal.jadwal', compact('jadwal', 'listMode'));
    }

    public function show(JadwalAcara $jadwal)
    {
        $detailMode = true;
        return view('mahasiswa.jadwal.jadwal', compact('jadwal', 'detailMode'));
    }
}
