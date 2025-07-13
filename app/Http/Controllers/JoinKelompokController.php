<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelompok;
use Illuminate\Support\Facades\Auth;

class JoinKelompokController extends Controller
{
    public function showForm()
    {
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

        return redirect()->route('dashboard')->with('success', 'Berhasil masuk ke kelompok!');
    }
}
