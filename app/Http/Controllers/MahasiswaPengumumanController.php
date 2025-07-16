<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class MahasiswaPengumumanController extends Controller
{

    public function index()
    {
        $pengumuman = Pengumuman::latest()->paginate(10);
        $listMode = true;
        return view('mahasiswa.pengumuman.pengumuman', compact('pengumuman', 'listMode'));
    }

    public function show(Pengumuman $pengumuman)
    {
        return view('mahasiswa.pengumuman-detail', compact('pengumuman'));
    }
}
