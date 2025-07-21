<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\AbsensiMahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SpvAbsensiController extends Controller
{
    /**
     * Show absensi dashboard for SPV
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role !== 'spv') {
            abort(403);
        }

        // Get all absensi with statistics
        $absensiList = Absensi::withCount([
            'absensiMahasiswa as total_hadir'
        ])
        ->latest()
        ->paginate(10);

        // Get current active absensi
        $now = Carbon::now();
        $activeAbsensi = Absensi::where('is_active', true)
            ->where('jam_mulai', '<=', $now)
            ->where('jam_selesai', '>=', $now)
            ->withCount('absensiMahasiswa as total_hadir')
            ->get();

        // Get total mahasiswa
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();

        return view('spv.absensi.index', compact('absensiList', 'activeAbsensi', 'totalMahasiswa'));
    }

    /**
     * Show detailed absensi participants
     */
    public function show($id)
    {
        $user = Auth::user();
        
        if ($user->role !== 'spv') {
            abort(403);
        }

        $absensi = Absensi::findOrFail($id);

        // Get all mahasiswa with their attendance status
        $mahasiswa = User::where('role', 'mahasiswa')
            ->with(['kelompok'])
            ->leftJoin('absensi_mahasiswa', function ($join) use ($id) {
                $join->on('users.id', '=', 'absensi_mahasiswa.user_id')
                     ->where('absensi_mahasiswa.absensi_id', $id);
            })
            ->select('users.*', 'absensi_mahasiswa.waktu_absen')
            ->orderBy('users.name')
            ->paginate(20);

        // Statistics
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $totalHadir = AbsensiMahasiswa::where('absensi_id', $id)->count();
        $totalBelumHadir = $totalMahasiswa - $totalHadir;

        // Attendance by kelompok
        $attendanceByKelompok = User::where('role', 'mahasiswa')
            ->with('kelompok')
            ->leftJoin('absensi_mahasiswa', function ($join) use ($id) {
                $join->on('users.id', '=', 'absensi_mahasiswa.user_id')
                     ->where('absensi_mahasiswa.absensi_id', $id);
            })
            ->selectRaw('kelompok_id, 
                         COUNT(users.id) as total_mahasiswa,
                         COUNT(absensi_mahasiswa.id) as total_hadir')
            ->groupBy('kelompok_id')
            ->get()
            ->map(function ($item) {
                $kelompok = \App\Models\Kelompok::find($item->kelompok_id);
                return [
                    'kelompok' => $kelompok ? $kelompok->nama_kelompok : 'Tanpa Kelompok',
                    'total_mahasiswa' => $item->total_mahasiswa,
                    'total_hadir' => $item->total_hadir,
                    'total_belum_hadir' => $item->total_mahasiswa - $item->total_hadir,
                    'persentase' => $item->total_mahasiswa > 0 ? round(($item->total_hadir / $item->total_mahasiswa) * 100, 1) : 0
                ];
            });

        return view('spv.absensi.show', compact(
            'absensi', 
            'mahasiswa', 
            'totalMahasiswa', 
            'totalHadir', 
            'totalBelumHadir',
            'attendanceByKelompok'
        ));
    }

    /**
     * Export absensi data
     */
    public function export($id)
    {
        $user = Auth::user();
        
        if ($user->role !== 'spv') {
            abort(403);
        }

        $absensi = Absensi::findOrFail($id);

        // Get all mahasiswa with their attendance status
        $mahasiswa = User::where('role', 'mahasiswa')
            ->with(['kelompok'])
            ->leftJoin('absensi_mahasiswa', function ($join) use ($id) {
                $join->on('users.id', '=', 'absensi_mahasiswa.user_id')
                     ->where('absensi_mahasiswa.absensi_id', $id);
            })
            ->select('users.*', 'absensi_mahasiswa.waktu_absen')
            ->orderBy('users.name')
            ->get();

        $filename = 'absensi_' . str_replace(' ', '_', $absensi->judul) . '_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($mahasiswa, $absensi) {
            $file = fopen('php://output', 'w');
            
            // Header
            fputcsv($file, [
                'Nama',
                'NIM',
                'Kelompok',
                'Status',
                'Waktu Absen',
                'Ketepatan'
            ]);

            foreach ($mahasiswa as $mhs) {
                $status = $mhs->waktu_absen ? 'Hadir' : 'Belum Absen';
                $waktuAbsen = $mhs->waktu_absen ? Carbon::parse($mhs->waktu_absen)->format('d/m/Y H:i:s') : '-';
                
                $ketepatan = '-';
                if ($mhs->waktu_absen) {
                    $waktu = Carbon::parse($mhs->waktu_absen);
                    $isOnTime = $waktu->between($absensi->jam_mulai, $absensi->jam_selesai);
                    $ketepatan = $isOnTime ? 'Tepat Waktu' : 'Terlambat';
                }

                fputcsv($file, [
                    $mhs->name,
                    $mhs->nim,
                    $mhs->kelompok ? $mhs->kelompok->nama_kelompok : '-',
                    $status,
                    $waktuAbsen,
                    $ketepatan
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}