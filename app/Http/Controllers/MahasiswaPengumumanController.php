<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class MahasiswaPengumumanController extends Controller
{

    public function index()
    {
        $pengumuman = Pengumuman::where('is_published', true)
                                ->orderByRaw('COALESCE(published_at, updated_at) DESC')
                                ->paginate(10);
        
        $listMode = true;
        return view('mahasiswa.pengumuman.pengumuman', compact('pengumuman', 'listMode'));
    }

    public function show(Pengumuman $pengumuman)
    {
        return view('mahasiswa.pengumuman-detail', compact('pengumuman'));
    }
}
