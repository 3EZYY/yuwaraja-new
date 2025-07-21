@extends('layouts.spv')

@section('title', 'Detail Absensi - ' . $absensi->judul)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <nav class="flex items-center space-x-2 text-sm text-gray-500 mb-2">
                        <a href="{{ route('spv.absensi.index') }}" class="hover:text-gray-700">Absensi</a>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <span class="text-gray-900">{{ $absensi->judul }}</span>
                    </nav>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $absensi->judul }}</h1>
                    @if($absensi->deskripsi)
                        <p class="text-gray-600 mt-2">{{ $absensi->deskripsi }}</p>
                    @endif
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('spv.absensi.export', $absensi->id) }}" 
                       class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Export CSV
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-sm border p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Total Mahasiswa</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalMahasiswa }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Hadir</p>
                        <p class="text-2xl font-bold text-green-600">{{ $totalHadir }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-red-100 rounded-lg">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Belum Absen</p>
                        <p class="text-2xl font-bold text-red-600">{{ $totalBelumHadir }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border p-6">
                <div class="flex items-center">
                    <div class="p-2 bg-purple-100 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-gray-600">Persentase</p>
                        <p class="text-2xl font-bold text-purple-600">{{ $totalMahasiswa > 0 ? round(($totalHadir / $totalMahasiswa) * 100, 1) : 0 }}%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Absensi Info -->
        <div class="bg-white rounded-xl shadow-sm border p-6 mb-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Absensi</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <p class="text-sm text-gray-600">Waktu Mulai</p>
                    <p class="text-lg font-medium text-gray-900">{{ $absensi->jam_mulai->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Waktu Selesai</p>
                    <p class="text-lg font-medium text-gray-900">{{ $absensi->jam_selesai->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Status</p>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium
                        @if($absensi->status_color === 'green') bg-green-100 text-green-800
                        @elseif($absensi->status_color === 'yellow') bg-yellow-100 text-yellow-800
                        @elseif($absensi->status_color === 'red') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                        {{ $absensi->status_text }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Attendance by Kelompok -->
        @if($attendanceByKelompok->count() > 0)
        <div class="bg-white rounded-xl shadow-sm border p-6 mb-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Kehadiran per Kelompok</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($attendanceByKelompok as $kelompok)
                <div class="border rounded-lg p-4">
                    <h3 class="font-medium text-gray-900 mb-2">{{ $kelompok['kelompok'] }}</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Hadir:</span>
                            <span class="font-medium text-green-600">{{ $kelompok['total_hadir'] }}/{{ $kelompok['total_mahasiswa'] }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-600 h-2 rounded-full" style="width: {{ $kelompok['persentase'] }}%"></div>
                        </div>
                        <div class="text-center text-sm font-medium text-gray-900">{{ $kelompok['persentase'] }}%</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Participants Table -->
        <div class="bg-white rounded-xl shadow-sm border">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Daftar Peserta</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Mahasiswa
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                NIM
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kelompok
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Waktu Absen
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ketepatan
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($mahasiswa as $mhs)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if($mhs->photo)
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset($mhs->photo) }}" alt="{{ $mhs->name }}">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                                <span class="text-sm font-medium text-gray-700">{{ substr($mhs->name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $mhs->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $mhs->nim }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $mhs->kelompok ? $mhs->kelompok->nama_kelompok : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($mhs->waktu_absen)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Hadir
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Belum Absen
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $mhs->waktu_absen ? \Carbon\Carbon::parse($mhs->waktu_absen)->format('d/m/Y H:i:s') : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($mhs->waktu_absen)
                                    @php
                                        $waktu = \Carbon\Carbon::parse($mhs->waktu_absen);
                                        $isOnTime = $waktu->between($absensi->jam_mulai, $absensi->jam_selesai);
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $isOnTime ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $isOnTime ? 'Tepat Waktu' : 'Terlambat' }}
                                    </span>
                                @else
                                    <span class="text-sm text-gray-400">-</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($mahasiswa->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $mahasiswa->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection