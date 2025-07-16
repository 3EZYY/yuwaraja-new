<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelompok;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class JoinKelompokController extends Controller
{
    public function showForm()
    {
        $user = Auth::user();
        
        // Jika sudah bergabung dengan kelompok, redirect ke dashboard
        if ($user->kelompok_id) {
            return redirect()->route('mahasiswa.dashboard')
                ->with('info', 'Anda sudah bergabung dengan kelompok.');
        }
        
        return view('mahasiswa.join-kelompok');
    }

    public function join(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:5',
        ]);

        $user = Auth::user();
        if ($user->kelompok_id) {
            return back()->withErrors(['code' => 'Kamu sudah tergabung dalam kelompok.']);
        }

        $kelompok = Kelompok::where('code', $request->code)->first();

        if (!$kelompok) {
            return back()->withErrors(['code' => 'Kode tidak ditemukan.']);
        }

        $user->kelompok_id = $kelompok->id;
        $user->save();

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Berhasil masuk ke kelompok!');
    }

    public function leave(Request $request)
    {
        $user = Auth::user();
        
        // Pastikan user sudah bergabung dengan kelompok
        if (!$user->kelompok_id) {
            return redirect()->route('mahasiswa.dashboard')
                ->with('error', 'Anda belum bergabung dengan kelompok.');
        }
        
        // Keluar dari kelompok
        $user->kelompok_id = null;
        $user->save();
        
        return redirect()->route('mahasiswa.join-kelompok')
            ->with('success', 'Berhasil keluar dari kelompok.');
    }
}
