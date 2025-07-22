<?php

namespace App\Http\Controllers;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{
    // Tampilkan halaman anggota kelompok
    public function index()
    {
        $user = Auth::user();
        
        // Pastikan user punya kelompok
        if (!$user->kelompok) {
            return redirect()->route('mahasiswa.dashboard')->with('error', 'Kamu belum bergabung dengan kelompok!');
        }

        // Ambil semua anggota kelompok (termasuk diri sendiri)
        $kelompokMembers = User::where('kelompok_id', $user->kelompok_id)
                              ->where('role', 'mahasiswa')
                              ->orderByRaw('CASE WHEN id = ? THEN 0 ELSE 1 END', [$user->id])
                              ->orderBy('name')
                              ->get();

        // Ambil supervisor kelompok
        $supervisor = $user->kelompok->supervisor;

        // Ambil daftar teman yang sudah accepted
        $friends = $user->friends();

        return view('mahasiswa.friendship.index', compact('kelompokMembers', 'supervisor', 'friends', 'user'));
    }

    // Kirim permintaan pertemanan
    public function sendRequest(Request $request)
    {
        $user = Auth::user();
        $friendId = $request->friend_id;

        // Validasi
        if ($friendId == $user->id) {
            return back()->with('error', 'Tidak bisa berteman dengan diri sendiri!');
        }

        // Cek apakah target user ada dan satu kelompok
        $targetUser = User::find($friendId);
        if (!$targetUser || $targetUser->kelompok_id != $user->kelompok_id) {
            return back()->with('error', 'User tidak ditemukan atau bukan anggota kelompok yang sama!');
        }

        // Cek apakah sudah ada friendship request
        if ($user->hasFriendshipRequestWith($friendId)) {
            return back()->with('error', 'Permintaan pertemanan sudah ada!');
        }

        // Buat friendship request
        Friendship::create([
            'user_id' => $user->id,
            'friend_id' => $friendId,
            'status' => 'accepted' // Langsung accepted untuk simplicity
        ]);

        return back()->with('success', 'Berhasil berteman dengan ' . $targetUser->name . '!');
    }

    // Accept friendship request
    public function acceptRequest($friendshipId)
    {
        $friendship = Friendship::find($friendshipId);
        
        if (!$friendship || $friendship->friend_id != Auth::id()) {
            return back()->with('error', 'Permintaan pertemanan tidak ditemukan!');
        }

        $friendship->update(['status' => 'accepted']);

        return back()->with('success', 'Permintaan pertemanan diterima!');
    }

    // Reject friendship request
    public function rejectRequest($friendshipId)
    {
        $friendship = Friendship::find($friendshipId);
        
        if (!$friendship || $friendship->friend_id != Auth::id()) {
            return back()->with('error', 'Permintaan pertemanan tidak ditemukan!');
        }

        $friendship->delete();

        return back()->with('success', 'Permintaan pertemanan ditolak!');
    }

    // Remove friend
    public function removeFriend($friendId)
    {
        $user = Auth::user();
        
        $friendship = Friendship::where(function($query) use ($user, $friendId) {
            $query->where('user_id', $user->id)->where('friend_id', $friendId);
        })->orWhere(function($query) use ($user, $friendId) {
            $query->where('user_id', $friendId)->where('friend_id', $user->id);
        })->first();

        if ($friendship) {
            $friendship->delete();
            return back()->with('success', 'Pertemanan berhasil dihapus!');
        }

        return back()->with('error', 'Pertemanan tidak ditemukan!');
    }
}