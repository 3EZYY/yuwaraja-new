@extends('layouts.mahasiswa')

@section('title', 'Riwayat Absensi')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Riwayat Absensi</h1>
            <p class="text-gray-600 mt-2">Lihat riwayat kehadiran Anda</p>
        </div>

        <!-- Absensi History -->
        <div class="bg-white rounded-xl shadow-sm border">
            @if($absensiHistory->count() > 0)
                <div class="divide-y divide-gray-200">
                    @foreach($absensiHistory as $history)
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $history->absensi->judul }}</h3>
                                @if($history->absensi->deskripsi)
                                    <p class="text-sm text-gray-600 mb-3">{{ $history->absensi->deskripsi }}</p>
                                @endif
                                
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wider">Waktu Absensi</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $history->absensi->jam_mulai->format('d/m/Y') }}</p>
                                        <p class="text-sm text-gray-600">{{ $history->absensi->jam_mulai->format('H:i') }} - {{ $history->absensi->jam_selesai->format('H:i') }}</p>
                                    </div>
                                    
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wider">Waktu Anda Absen</p>
                                        <p class="text-sm font-medium text-gray-900">{{ $history->waktu_absen->format('d/m/Y H:i:s') }}</p>
                                    </div>
                                    
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wider">Status</p>
                                        <div class="flex items-center space-x-2 mt-1">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Hadir
                                            </span>
                                            @php
                                                $isOnTime = $history->waktu_absen->between($history->absensi->jam_mulai, $history->absensi->jam_selesai);
                                            @endphp
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $isOnTime ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ $isOnTime ? 'Tepat Waktu' : 'Terlambat' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="ml-6 flex-shrink-0">
                                <div class="flex items-center justify-center w-12 h-12 bg-green-100 rounded-full">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                @if($absensiHistory->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $absensiHistory->links() }}
                </div>
                @endif
            @else
                <div class="p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada riwayat absensi</h3>
                    <p class="mt-1 text-sm text-gray-500">Anda belum pernah melakukan absensi.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection