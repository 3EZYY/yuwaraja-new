@extends('layouts.app')

@section('content')
{{-- CSS Kustom Minimal untuk Font dan Efek Khusus --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&family=Poppins:wght@600;700;900&display=swap');

    .font-display {
        font-family: 'Poppins', sans-serif;
    }

    .font-body {
        font-family: 'Kanit', sans-serif;
    }

    /* Efek Glow untuk Teks */
    .text-glow-teal {
        text-shadow: 0 0 12px theme('colors.teal.500 / 0.5');
    }

    .text-glow-amber {
        text-shadow: 0 0 12px theme('colors.amber.400 / 0.5');
    }
</style>

<div class="font-body bg-gray-900 min-h-screen py-12 sm:py-16" style="background-image: radial-gradient(circle at top, #1a202c, #0a0f14);">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <header class="bg-gray-950/50 backdrop-blur-xl p-6 rounded-2xl mb-8 border border-teal-500/20">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <h1 class="font-display text-2xl sm:text-3xl font-bold text-teal-300 text-glow-teal flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Detail Informasi Teman
                    </h1>
                    <p class="text-gray-400 mt-1">Informasi lengkap tentang <span class="text-white font-semibold">{{ $friend->name }}</span></p>
                </div>
                <a href="{{ route('mahasiswa.friendship.index') }}" class="inline-flex items-center gap-2 text-sm text-amber-300 hover:text-amber-200 transition-colors group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                    </svg>
                    Kembali ke Jaringan Kelompok
                </a>
            </div>
        </header>

        <!-- Alert Messages -->
        @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/30 text-green-300 text-sm p-3 rounded-lg mb-6 flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-500/10 border border-red-500/30 text-red-300 text-sm p-3 rounded-lg mb-6 flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        <!-- Friend Detail Card -->
        <div class="bg-gray-900/50 backdrop-blur-xl rounded-2xl border border-gray-700/50 overflow-hidden">
            <!-- Profile Header -->
            <div class="bg-gradient-to-r from-teal-600/20 via-teal-700/20 to-amber-600/20 p-8 border-b border-gray-700/50">
                <div class="flex flex-col md:flex-row items-center gap-6">
                    <!-- Profile Picture -->
                    <div class="relative">
                        <div class="w-32 h-32 rounded-full bg-gradient-to-br from-teal-400 to-amber-500 p-1 shadow-2xl">
                            @if($friend->photo)
                            <img src="{{ asset('profile-pictures/' . $friend->photo) }}"
                                alt="{{ $friend->name }}"
                                class="w-full h-full rounded-full object-cover bg-gray-900">
                            @else
                            <div class="w-full h-full rounded-full bg-gray-900 flex items-center justify-center">
                                <span class="text-4xl font-bold text-teal-300 font-display">{{ strtoupper(substr($friend->name, 0, 1)) }}</span>
                            </div>
                            @endif
                        </div>
                        <!-- Online Status -->
                        <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full border-4 border-gray-900 flex items-center justify-center">
                            <div class="w-3 h-3 bg-white rounded-full animate-pulse"></div>
                        </div>
                    </div>

                    <!-- Basic Info -->
                    <div class="text-center md:text-left flex-1">
                        <h2 class="text-3xl font-bold text-white text-glow-teal mb-2">{{ $friend->name }}</h2>
                        <div class="flex flex-col md:flex-row gap-4 text-gray-300">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V4a2 2 0 114 0v2m-4 0a2 2 0 104 0m-4 0v2m0 0h4" />
                                </svg>
                                <span class="font-semibold">{{ $friend->nim }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>{{ $friend->kelompok->nama_kelompok }}</span>
                            </div>
                        </div>

                        <!-- Friendship Badge -->
                        <div class="mt-4">
                            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold bg-green-500/10 text-green-400 border border-green-500/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Sudah Berteman
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detailed Information -->
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Personal Information -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Informasi Personal
                        </h3>

                        <div class="space-y-4">
                            <div class="bg-gray-800/50 p-4 rounded-lg border border-gray-700/50">
                                <label class="text-sm text-gray-400 uppercase tracking-wide">Nama Lengkap</label>
                                <p class="text-white font-semibold mt-1">{{ $friend->name }}</p>
                            </div>

                            <div class="bg-gray-800/50 p-4 rounded-lg border border-gray-700/50">
                                <label class="text-sm text-gray-400 uppercase tracking-wide">NIM</label>
                                <p class="text-white font-semibold mt-1">{{ $friend->nim }}</p>
                            </div>

                            <div class="bg-gray-800/50 p-4 rounded-lg border border-gray-700/50">
                                <label class="text-sm text-gray-400 uppercase tracking-wide">Email</label>
                                <p class="text-white font-semibold mt-1">{{ $friend->email }}</p>
                            </div>

                            @if($friend->program_studi)
                            <div class="bg-gray-800/50 p-4 rounded-lg border border-gray-700/50">
                                <label class="text-sm text-gray-400 uppercase tracking-wide">Program Studi</label>
                                <p class="text-white font-semibold mt-1">{{ $friend->program_studi }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Group Information -->
                    <div class="space-y-6">
                        <h3 class="text-xl font-bold text-white mb-4 flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Informasi Kelompok
                        </h3>

                        <div class="space-y-4">
                            <div class="bg-gray-800/50 p-4 rounded-lg border border-gray-700/50">
                                <label class="text-sm text-gray-400 uppercase tracking-wide">Nama Kelompok</label>
                                <p class="text-white font-semibold mt-1">{{ $friend->kelompok->nama_kelompok }}</p>
                            </div>

                            @if($friend->kelompok->deskripsi)
                            <div class="bg-gray-800/50 p-4 rounded-lg border border-gray-700/50">
                                <label class="text-sm text-gray-400 uppercase tracking-wide">Deskripsi Kelompok</label>
                                <p class="text-gray-300 mt-1">{{ $friend->kelompok->deskripsi }}</p>
                            </div>
                            @endif

                            @if($friend->kelompok->supervisor)
                            <div class="bg-gray-800/50 p-4 rounded-lg border border-gray-700/50">
                                <label class="text-sm text-gray-400 uppercase tracking-wide">Supervisor</label>
                                <p class="text-white font-semibold mt-1">{{ $friend->kelompok->supervisor->name }}</p>
                            </div>
                            @endif

                            <div class="bg-gray-800/50 p-4 rounded-lg border border-gray-700/50">
                                <label class="text-sm text-gray-400 uppercase tracking-wide">Bergabung Sejak</label>
                                <p class="text-white font-semibold mt-1">{{ $friend->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 pt-6 border-t border-gray-700/50">
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('mahasiswa.friendship.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 text-white font-semibold rounded-lg transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-[1.02] border border-teal-500/30">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M7.28 7.72a.75.75 0 0 1 0 1.06l-2.47 2.47H21a.75.75 0 0 1 0 1.5H4.81l2.47 2.47a.75.75 0 1 1-1.06 1.06l-3.75-3.75a.75.75 0 0 1 0-1.06l3.75-3.75a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                            </svg>

                            Kembali ke Jaringan Kelompok
                        </a>

                        <form action="{{ route('mahasiswa.friendship.remove', $friend->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pertemanan dengan {{ $friend->name }}?')" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/20 font-semibold rounded-lg transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Batalkan Pertemanan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection