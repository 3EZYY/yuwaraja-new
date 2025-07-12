<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class MahasiswaPengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::latest()->paginate(10);
        return view('mahasiswa.pengumuman.index', compact('pengumuman'));
    }

    public function show(Pengumuman $pengumuman)
    {
        return view('mahasiswa.pengumuman.show', compact('pengumuman'));
    }
}
