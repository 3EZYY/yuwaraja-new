<?php

namespace App\Http\Controllers;

use App\Models\JadwalAcara;
use Illuminate\Http\Request;

class MahasiswaJadwalController extends Controller
{
    public function index()
    {
        $jadwal = JadwalAcara::orderBy('tanggal_mulai')->paginate(10);
        return view('mahasiswa.jadwal.index', compact('jadwal'));
    }

    public function show(JadwalAcara $jadwal)
    {
        return view('mahasiswa.jadwal.show', compact('jadwal'));
    }
}
