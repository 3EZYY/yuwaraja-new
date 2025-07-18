<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelompok;
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
        $kelompokDibimbing = Kelompok::where('spv_id', $user->id)
            ->with(['mahasiswa' => function($q) use ($filterProdi) {
                if ($filterProdi) {
                    $q->where('program_studi', $filterProdi);
                }
            }])
            ->get();

        return view('spv.cluster', compact('kelompokDibimbing', 'prodiList', 'filterProdi'));
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
}