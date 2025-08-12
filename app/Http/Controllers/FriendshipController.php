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
        
        // Ambil permintaan pertemanan yang masuk (pending)
        $incomingRequests = $user->receivedFriendships()->pending()->with('user')->get();
        
        // Ambil permintaan pertemanan yang dikirim (pending)
        $outgoingRequests = $user->friendships()->pending()->with('friend')->get();

        return view('mahasiswa.friendship.index', compact('kelompokMembers', 'supervisor', 'friends', 'user', 'incomingRequests', 'outgoingRequests'));
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
            'status' => 'pending' // Menunggu persetujuan
        ]);

        return back()->with('success', 'Permintaan pertemanan berhasil dikirim ke ' . $targetUser->name . '!');
    }

    // Accept friendship request
    public function acceptRequest($friendshipId)
    {
        $friendship = Friendship::find($friendshipId);
        
        if (!$friendship || $friendship->friend_id != Auth::id()) {
            return back()->with('error', 'Permintaan pertemanan tidak ditemukan!');
        }

        $friendship->update(['status' => 'accepted']);
        
        $senderName = $friendship->user->name;
        return back()->with('success', 'Permintaan pertemanan dari ' . $senderName . ' berhasil diterima!');
    }

    // Reject friendship request
    public function rejectRequest($friendshipId)
    {
        $friendship = Friendship::find($friendshipId);
        
        if (!$friendship || $friendship->friend_id != Auth::id()) {
            return back()->with('error', 'Permintaan pertemanan tidak ditemukan!');
        }

        $senderName = $friendship->user->name;
        $friendship->delete();

        return back()->with('success', 'Permintaan pertemanan dari ' . $senderName . ' berhasil ditolak!');
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

    // Show detailed information about a friend
    public function showFriendDetail($friendId)
    {
        $user = Auth::user();
        $friend = User::find($friendId);
        
        // Check if friend exists and is in the same group
        if (!$friend || $friend->kelompok_id != $user->kelompok_id) {
            return back()->with('error', 'User tidak ditemukan atau bukan anggota kelompok yang sama!');
        }
        
        // Check if they are friends
        if (!$user->isFriendWith($friendId)) {
            return back()->with('error', 'Anda harus berteman terlebih dahulu untuk melihat detail informasi!');
        }
        
        return view('mahasiswa.friendship.detail', compact('friend', 'user'));
    }
}