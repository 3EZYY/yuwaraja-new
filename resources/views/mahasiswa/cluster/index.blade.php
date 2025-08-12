@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&family=Poppins:wght@600;700;900&display=swap');

    :root {
        --bg-main: #0a0a0a;
        --surface-card: #111827;
        --border-color: rgba(20, 184, 166, 0.25); 
        --brand-teal: #14b8a6;
        --brand-gold: #f59e0b;
        --text-primary: #d1d5db;
        --text-secondary: #6b7280;
    }

    body {
        background-color: var(--bg-main) !important;
        font-family: 'Kanit', sans-serif;
        color: var(--text-primary);
    }
    
    .font-display {
        font-family: 'Poppins', sans-serif;
    }

    .themed-card {
        background-color: var(--surface-card);
        border: 1px solid var(--border-color);
        border-radius: 0.75rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }
    .themed-card:hover {
        border-color: var(--brand-gold);
        box-shadow: 0 0 20px rgba(245, 158, 11, 0.15);
    }
</style>

<div class="min-h-screen" style="background-color: var(--bg-main);">
    <!-- Header -->
    <div class="bg-gradient-to-r from-teal-600 to-amber-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white font-display">Cluster Saya</h1>
                    <p class="text-amber-100 mt-2">Kelompok: {{ $kelompok->nama_kelompok }}</p>
                    <p class="text-amber-100">Kode: {{ $kelompok->kode_kelompok }}</p>
                </div>
                <div class="text-right">
                    <div class="text-white">
                        <div class="text-sm opacity-75">Total Anggota</div>
                        <div class="text-2xl font-bold">{{ $anggotaKelompok->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Cluster Photo Section -->
        @if($kelompok->photo)
        <div class="themed-card p-6 mb-8">
            <h2 class="text-xl font-bold text-white mb-4 font-display">Foto Cluster</h2>
            <div class="flex justify-center">
                <img src="{{ asset('storage/' . $kelompok->photo) }}" 
                     alt="Foto Cluster {{ $kelompok->nama_kelompok }}" 
                     class="max-w-md rounded-lg shadow-md">
            </div>
        </div>
        @endif

        <!-- Members Grid -->
        <div class="themed-card p-6">
            <h2 class="text-xl font-bold text-white mb-6 font-display">Anggota Cluster</h2>
            
            @if($anggotaKelompok->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($anggotaKelompok as $anggota)
                    <div class="bg-gray-800/60 rounded-lg p-4 hover:bg-gray-700/60 transition-all duration-200 border border-gray-700/50">
                        <div class="flex items-center space-x-4">
                            <!-- Profile Photo -->
                            <div class="flex-shrink-0">
                                @if($anggota->profile_photo)
                                    <img src="{{ asset('storage/' . $anggota->profile_photo) }}" 
                                         alt="{{ $anggota->name }}" 
                                         class="w-12 h-12 rounded-full object-cover border-2 border-gray-300">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-teal-400 to-amber-500 flex items-center justify-center text-white font-bold text-lg">
                                        {{ strtoupper(substr($anggota->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Member Info -->
                            <div class="flex-1 min-w-0">
                                <h3 class="text-sm font-semibold text-white truncate">
                                    {{ $anggota->name }}
                                    @if($anggota->id === $user->id)
                                        <span class="text-xs text-teal-400">(Anda)</span>
                                    @endif
                                </h3>
                                <p class="text-xs text-gray-400 truncate">{{ $anggota->nim ?? 'NIM tidak tersedia' }}</p>
                                <p class="text-xs text-gray-400 truncate">{{ $anggota->program_studi ?? 'Program studi tidak tersedia' }}</p>
                            </div>
                            
                            <!-- Status Indicator -->
                            <div class="flex-shrink-0">
                                <div class="w-3 h-3 bg-teal-400 rounded-full" title="Online"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <div class="text-gray-400">
                        <svg class="mx-auto h-12 w-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <p class="text-lg font-medium">Belum ada anggota lain</p>
                        <p class="text-sm">Anda adalah satu-satunya anggota dalam cluster ini.</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Cluster Info -->
        <div class="themed-card p-6 mt-8">
            <h2 class="text-xl font-bold text-white mb-4 font-display">Informasi Cluster</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="text-sm font-semibold text-gray-400 uppercase tracking-wide">Nama Kelompok</label>
                    <p class="text-lg text-white mt-1">{{ $kelompok->nama_kelompok }}</p>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-400 uppercase tracking-wide">Kode Kelompok</label>
                    <p class="text-lg text-white mt-1">{{ $kelompok->kode_kelompok }}</p>
                </div>
                @if($kelompok->spv)
                <div>
                    <label class="text-sm font-semibold text-gray-400 uppercase tracking-wide">Supervisor</label>
                    <p class="text-lg text-white mt-1">{{ $kelompok->spv->name }}</p>
                </div>
                @endif
                <div>
                    <label class="text-sm font-semibold text-gray-400 uppercase tracking-wide">Jumlah Anggota</label>
                    <p class="text-lg text-white mt-1">{{ $anggotaKelompok->count() }} orang</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection