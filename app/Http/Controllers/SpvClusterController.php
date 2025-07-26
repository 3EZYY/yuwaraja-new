<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelompok;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SpvClusterController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Ambil semua prodi unik dari mahasiswa yang dibimbing
        $prodiList = \App\Models\User::whereIn('kelompok_id', function($q) use ($user) {
            $q->select('id')->from('kelompoks')->where('spv_id', $user->id);
        })->select('program_studi')->distinct()->pluck('program_studi');

        $filterProdi = $request->input('prodi');
        
        // Pastikan data kelompok selalu fresh dari database
        $kelompokDibimbing = Kelompok::where('spv_id', $user->id)
            ->with(['mahasiswa' => function($q) use ($filterProdi) {
                if ($filterProdi) {
                    $q->where('program_studi', $filterProdi);
                }
            }])
            ->orderBy('updated_at', 'desc') // Urutkan berdasarkan update terbaru
            ->get();

        return view('spv.cluster', compact('kelompokDibimbing', 'prodiList', 'filterProdi'));
    }

    public function showMahasiswa($id)
    {
        $user = Auth::user();
        $mahasiswa = User::findOrFail($id);
        
        // Pastikan SPV hanya bisa melihat mahasiswa di kelompok yang dia supervisi
        $kelompok = $mahasiswa->kelompok;
        if (!$kelompok || $kelompok->spv_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk melihat detail mahasiswa ini.'
            ], 403);
        }
        
        return response()->json([
            'success' => true,
            'mahasiswa' => $mahasiswa,
            'kelompok' => $kelompok
        ]);
    }

    public function uploadPhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB max
            'kelompok_id' => 'required|exists:kelompoks,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . $validator->errors()->first()
            ], 422);
        }

        try {
            $kelompok = Kelompok::findOrFail($request->kelompok_id);
            
            // Pastikan SPV hanya bisa upload foto untuk kelompok yang dibimbingnya
            if ($kelompok->spv_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses untuk mengubah foto kelompok ini.'
                ], 403);
            }

            // Hapus foto lama jika ada
            if ($kelompok->photo && Storage::disk('public')->exists($kelompok->photo)) {
                Storage::disk('public')->delete($kelompok->photo);
            }

            // Upload foto baru
            $file = $request->file('photo');
            $filename = 'cluster_' . $kelompok->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('cluster-photos', $filename, 'public');

            // Update database
            $kelompok->update(['photo' => $path]);

            return response()->json([
                'success' => true,
                'message' => 'Foto cluster berhasil diupload!',
                'photo_url' => asset('storage/' . $path)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengupload foto: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deletePhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kelompok_id' => 'required|exists:kelompoks,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . $validator->errors()->first()
            ], 422);
        }

        try {
            $kelompok = Kelompok::findOrFail($request->kelompok_id);
            
            // Pastikan SPV hanya bisa hapus foto untuk kelompok yang dibimbingnya
            if ($kelompok->spv_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses untuk mengubah foto kelompok ini.'
                ], 403);
            }

            // Hapus foto dari storage
            if ($kelompok->photo && Storage::disk('public')->exists($kelompok->photo)) {
                Storage::disk('public')->delete($kelompok->photo);
            }

            // Update database
            $kelompok->update(['photo' => null]);

            return response()->json([
                'success' => true,
                'message' => 'Foto cluster berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus foto: ' . $e->getMessage()
            ], 500);
        }
    }

    public function leaveCluster(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kelompok_id' => 'required|exists:kelompoks,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Validasi gagal: ' . $validator->errors()->first());
        }

        try {
            $kelompok = Kelompok::findOrFail($request->kelompok_id);
            
            // Pastikan SPV hanya bisa keluar dari kelompok yang dibimbingnya
            if ($kelompok->spv_id !== Auth::id()) {
                return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk keluar dari kelompok ini.');
            }

            // Hapus SPV dari kelompok (set spv_id menjadi null)
            $kelompok->update(['spv_id' => null]);

            return redirect()->route('spv.cluster.index')->with('success', 'Anda berhasil keluar dari cluster "' . $kelompok->nama_kelompok . '".');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat keluar dari cluster: ' . $e->getMessage());
        }
    }

    public function joinCluster(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cluster_code' => 'required|string|size:5'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Kode cluster harus terdiri dari 5 karakter.')->withInput();
        }

        try {
            $clusterCode = strtoupper($request->cluster_code);
            
            // Cari kelompok berdasarkan kode
            $kelompok = Kelompok::where('code', $clusterCode)->first();
            
            if (!$kelompok) {
                return redirect()->back()->with('error', 'Kode cluster "' . $clusterCode . '" tidak ditemukan.')->withInput();
            }

            // Cek apakah kelompok sudah memiliki SPV
            if ($kelompok->spv_id) {
                $currentSpv = User::find($kelompok->spv_id);
                return redirect()->back()->with('error', 'Cluster "' . $kelompok->nama_kelompok . '" sudah memiliki supervisor (' . ($currentSpv ? $currentSpv->name : 'Unknown') . ').')->withInput();
            }

            // Cek apakah SPV sudah membimbing kelompok lain
            $existingKelompok = Kelompok::where('spv_id', Auth::id())->first();
            if ($existingKelompok) {
                return redirect()->back()->with('error', 'Anda sudah membimbing cluster "' . $existingKelompok->nama_kelompok . '". Keluar dari cluster tersebut terlebih dahulu.')->withInput();
            }

            // Assign SPV ke kelompok
            $kelompok->update(['spv_id' => Auth::id()]);

            return redirect()->route('spv.cluster.index')->with('success', 'Berhasil bergabung dengan cluster "' . $kelompok->nama_kelompok . '" sebagai supervisor!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat bergabung dengan cluster: ' . $e->getMessage())->withInput();
        }
    }

    public function kickMember(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . $validator->errors()->first()
            ], 422);
        }

        try {
            $mahasiswa = User::findOrFail($request->user_id);
            
            // Pastikan mahasiswa memiliki kelompok
            if (!$mahasiswa->kelompok_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mahasiswa ini tidak tergabung dalam cluster manapun.'
                ], 400);
            }

            $kelompok = $mahasiswa->kelompok;
            
            // Pastikan SPV hanya bisa kick anggota dari kelompok yang dibimbingnya
            if ($kelompok->spv_id !== Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda tidak memiliki akses untuk mengeluarkan anggota dari cluster ini.'
                ], 403);
            }

            // Simpan nama untuk response
            $namaKelompok = $kelompok->nama_kelompok;
            $namaMahasiswa = $mahasiswa->name;

            // Keluarkan mahasiswa dari kelompok (set kelompok_id menjadi null)
            $mahasiswa->update(['kelompok_id' => null]);

            return response()->json([
                'success' => true,
                'message' => $namaMahasiswa . ' berhasil dikeluarkan dari cluster "' . $namaKelompok . '".'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengeluarkan anggota: ' . $e->getMessage()
            ], 500);
        }
    }
}