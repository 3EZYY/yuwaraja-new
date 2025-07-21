@extends('layouts.spv')

@section('title', 'Management Absensi')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Management Absensi</h1>
                    <p class="text-gray-600 mt-2">Kelola dan pantau absensi mahasiswa</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-white rounded-lg px-4 py-2 shadow-sm border">
                        <span class="text-sm text-gray-500">Total Mahasiswa</span>
                        <div class="text-2xl font-bold text-blue-600">{{ $totalMahasiswa }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Absensi -->
        @if($activeAbsensi->count() > 0)
        <div class="mb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Absensi Sedang Berlangsung</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($activeAbsensi as $absensi)
                <div class="bg-white rounded-xl shadow-sm border border-green-200 p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $absensi->judul }}</h3>
                            @if($absensi->deskripsi)
                                <p class="text-sm text-gray-600 mb-3">{{ $absensi->deskripsi }}</p>
                            @endif
                            <div class="space-y-2">
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $absensi->jam_mulai->format('H:i') }} - {{ $absensi->jam_selesai->format('H:i') }}
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-600">Kehadiran:</span>
                                    <div class="flex items-center space-x-2">
                                        <span class="text-sm font-medium text-green-600">{{ $absensi->total_hadir }}</span>
                                        <span class="text-sm text-gray-400">/</span>
                                        <span class="text-sm text-gray-600">{{ $totalMahasiswa }}</span>
                                    </div>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-600 h-2 rounded-full" style="width: {{ $totalMahasiswa > 0 ? ($absensi->total_hadir / $totalMahasiswa) * 100 : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Aktif
                        </span>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('spv.absensi.show', $absensi->id) }}" 
                           class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-500">
                            Lihat Detail
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- All Absensi -->
        <div class="bg-white rounded-xl shadow-sm border">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Semua Absensi</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Judul
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Waktu
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kehadiran
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($absensiList as $absensi)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $absensi->judul }}</div>
                                    @if($absensi->deskripsi)
                                        <div class="text-sm text-gray-500">{{ Str::limit($absensi->deskripsi, 50) }}</div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $absensi->jam_mulai->format('d/m/Y') }}</div>
                                <div class="text-sm text-gray-500">{{ $absensi->jam_mulai->format('H:i') }} - {{ $absensi->jam_selesai->format('H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($absensi->status_color === 'green') bg-green-100 text-green-800
                                    @elseif($absensi->status_color === 'yellow') bg-yellow-100 text-yellow-800
                                    @elseif($absensi->status_color === 'red') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ $absensi->status_text }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="text-sm font-medium text-gray-900">{{ $absensi->total_hadir }}/{{ $totalMahasiswa }}</div>
                                    <div class="ml-2 w-16 bg-gray-200 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $totalMahasiswa > 0 ? ($absensi->total_hadir / $totalMahasiswa) * 100 : 0 }}%"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('spv.absensi.show', $absensi->id) }}" 
                                       class="text-blue-600 hover:text-blue-900">
                                        Lihat Detail
                                    </a>
                                    <a href="{{ route('spv.absensi.export', $absensi->id) }}" 
                                       class="text-green-600 hover:text-green-900">
                                        Export
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="text-gray-500">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                    <p class="mt-2 text-sm">Belum ada data absensi</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($absensiList->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $absensiList->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection