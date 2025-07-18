@extends('layouts.app')

@section('content')
    {{-- CSS Kustom Minimal untuk Font dan Efek Khusus --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&family=Poppins:wght@600;700;900&display=swap');

        .font-display { font-family: 'Poppins', sans-serif; }
        .font-body { font-family: 'Kanit', sans-serif; }

        /* Efek Glow untuk Teks */
        .text-glow-teal { text-shadow: 0 0 12px theme('colors.teal.500 / 0.5'); }
        .text-glow-amber { text-shadow: 0 0 12px theme('colors.amber.400 / 0.5'); }
    </style>

<div class="font-body bg-gray-900 min-h-screen py-12 sm:py-16" style="background-image: radial-gradient(circle at top, #1a202c, #0a0f14);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <header class="bg-gray-950/50 backdrop-blur-xl p-6 rounded-2xl mb-8 border border-teal-500/20">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <h1 class="font-display text-2xl sm:text-3xl font-bold text-teal-300 text-glow-teal flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        Cluster Bimbingan
                    </h1>
                    <p class="text-gray-400 mt-1">SPV: <span class="text-white font-semibold">{{ auth()->user()->name }}</span></p>

                    <!-- Profile Cluster -->
                    <div class="mt-4 flex items-center gap-3">
                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-teal-400 to-cyan-500 p-1">
                            <div class="w-full h-full rounded-full bg-gray-900 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white">Profile Cluster</h3>
                            <p class="text-sm text-gray-400">Supervisor Network</p>
                        </div>
                    </div>
                </div>
                <a href="{{ route('spv.dashboard') }}" class="inline-flex items-center gap-2 text-sm text-amber-300 hover:text-amber-200 transition-colors group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" /></svg>
                    Kembali ke Dashboard
                </a>
            </div>
        </header>

        <!-- Alert Messages -->
        @if(session('success')) <div class="bg-green-500/10 border border-green-500/30 text-green-300 text-sm p-3 rounded-lg mb-6 flex items-center gap-3"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg><span>{{ session('success') }}</span></div> @endif
        @if(session('error')) <div class="bg-red-500/10 border border-red-500/30 text-red-300 text-sm p-3 rounded-lg mb-6 flex items-center gap-3"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg><span>{{ session('error') }}</span></div> @endif

        <div class="space-y-12">
            <!-- Filter Section -->
            @if(isset($prodiList) && count($prodiList) > 0)
            <div>
                <h2 class="font-display text-xl font-bold text-white mb-4 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z" /></svg>
                    Filter Prodi
                </h2>
                <div class="bg-gray-900/50 p-6 rounded-xl border border-gray-700/50">
                    <form method="GET" class="flex flex-wrap items-center gap-4">
                        <div class="flex items-center gap-2">
                            <label for="prodi" class="font-semibold text-gray-300">Pilih Prodi:</label>
                            <select name="prodi" id="prodi" class="bg-gray-800 border border-gray-600 text-white rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                <option value="">Semua Prodi</option>
                                @foreach($prodiList as $prodi)
                                    <option value="{{ $prodi }}" {{ (isset($filterProdi) && $filterProdi == $prodi) ? 'selected' : '' }}>{{ $prodi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-teal-500 hover:bg-teal-600 text-black font-bold rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z" /></svg>
                            Terapkan Filter
                        </button>
                    </form>
                </div>
            </div>
            @endif

            <!-- Cluster List Section -->
            <div>
                <h2 class="font-display text-xl font-bold text-white mb-4 flex items-center gap-3">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    Daftar Cluster
                </h2>
                @if(isset($kelompokDibimbing) && $kelompokDibimbing->count() > 0)
                    <div class="space-y-6">
                        @foreach($kelompokDibimbing as $kelompok)
                        <div class="bg-gray-900/50 p-6 rounded-xl border border-gray-700/50 hover:border-amber-400/50 hover:bg-gray-900 transition-all duration-300">
                            <div class="flex flex-col lg:flex-row gap-6">
                                <!-- Foto Cluster -->
                                @if($kelompok->photo)
                                <div class="lg:w-48 lg:flex-shrink-0">
                                    <img src="{{ asset('storage/' . $kelompok->photo) }}" alt="{{ $kelompok->nama_kelompok }}" class="w-full h-32 lg:h-40 object-cover rounded-lg border-2 border-amber-400/50">
                                </div>
                                @else
                                <div class="lg:w-48 lg:flex-shrink-0">
                                    <div class="w-full h-32 lg:h-40 rounded-lg bg-amber-400/20 flex items-center justify-center text-amber-300 font-bold text-3xl font-display border-2 border-amber-400/50">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                </div>
                                @endif

                                <div class="flex-1">
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <h3 class="text-xl font-bold text-white mb-2">{{ $kelompok->nama_kelompok }}</h3>
                                            <p class="text-gray-400 text-sm mb-2">{{ $kelompok->mahasiswa->count() }} Anggota</p>
                                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-semibold bg-green-500/10 text-green-400 border border-green-500/20">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                                Aktif
                                            </span>
                                        </div>
                                        <a href="{{ route('filament.admin.resources.cluster.edit', $kelompok->id) }}" class="inline-flex items-center gap-2 px-3 py-2 bg-amber-500/10 hover:bg-amber-500/20 border border-amber-500/30 hover:border-amber-500/50 text-amber-400 hover:text-amber-300 rounded-lg transition-all duration-200 text-sm font-medium">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                            Edit Cluster
                                        </a>
                                    </div>

                                    <!-- Anggota Cluster -->
                                    <div>
                                        <h4 class="font-display text-lg font-bold text-white mb-3 flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                            Anggota Cluster
                                        </h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                                            @foreach($kelompok->mahasiswa as $mahasiswa)
                                            <div class="bg-gray-800/50 p-4 rounded-lg border border-gray-700/50 hover:border-teal-400/50 hover:bg-gray-800 transition-all duration-300">
                                                <div class="flex items-center gap-3">
                                                    @if($mahasiswa->photo)
                                                        <img src="{{ asset('profile-pictures/' . $mahasiswa->photo) }}" alt="{{ $mahasiswa->name }}" class="w-12 h-12 rounded-full border-2 border-teal-400/50 object-cover">
                                                    @else
                                                        <div class="w-12 h-12 rounded-full bg-teal-400/20 flex items-center justify-center text-teal-300 font-bold text-lg font-display border-2 border-teal-400/50">{{ strtoupper(substr($mahasiswa->name, 0, 1)) }}</div>
                                                    @endif
                                                    <div class="flex-1 min-w-0">
                                                        <p class="text-white font-semibold text-sm truncate">{{ $mahasiswa->name }}</p>
                                                        <p class="text-gray-400 text-xs">{{ $mahasiswa->nim ?? 'NIM belum diisi' }}</p>
                                                        @if($mahasiswa->jurusan)
                                                        <p class="text-gray-400 text-xs">{{ $mahasiswa->jurusan }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-gray-900/50 p-8 text-center rounded-xl border border-gray-700/50">
                        <div class="text-6xl mb-4">🏢</div>
                        <h3 class="font-display text-2xl font-bold text-white mb-2">Belum Ada Cluster</h3>
                        <p class="text-gray-400">Anda belum diberi tanggung jawab untuk membimbing cluster manapun.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
