<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Kelompok;

class ClusterController extends Controller
{
    /**
     * Display the cluster page for mahasiswa
     */
    public function index()
    {
        $user = Auth::user()->load(['kelompok.users', 'kelompok.anggota']);
        
        // Check if student has joined a group
        if (!$user->kelompok_id) {
            return redirect()->route('mahasiswa.join-kelompok')
                ->with('info', 'Silakan bergabung dengan kelompok terlebih dahulu untuk mengakses halaman cluster.');
        }
        
        $kelompok = $user->kelompok;
        $anggotaKelompok = $kelompok->anggota ?? collect();
        
        return view('mahasiswa.cluster.index', compact('user', 'kelompok', 'anggotaKelompok'));
    }
    
    /**
     * Show details of a specific cluster member
     */
    public function showMember($id)
    {
        $user = Auth::user();
        $member = User::findOrFail($id);
        
        // Ensure student can only view members from their own group
        if (!$user->kelompok_id || $member->kelompok_id !== $user->kelompok_id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk melihat detail anggota ini.'
            ], 403);
        }
        
        return response()->json([
            'success' => true,
            'member' => $member,
            'kelompok' => $member->kelompok
        ]);
    }
}