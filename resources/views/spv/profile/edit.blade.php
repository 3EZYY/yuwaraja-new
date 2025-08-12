@extends('layouts.app')

@section('title', 'Pengaturan Profil SPV')

@section('content')
    {{-- CSS Kustom Minimal untuk Font --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&family=Poppins:wght@600;700;900&display=swap');

        .font-display { font-family: 'Poppins', sans-serif; }
        .font-body { font-family: 'Kanit', sans-serif; }
    </style>

<div class="font-body bg-gray-900 min-h-screen" style="background-image: radial-gradient(circle at top, #1a202c, #0a0f14);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">

        <!-- Header Profil -->
        <header class="flex flex-col sm:flex-row items-center gap-6 mb-12">
            <div class="relative">
                @if($user->photo)
                <img src="{{ asset('profile-pictures/' . $user->photo) }}" alt="Foto Profil" class="w-24 h-24 sm:w-32 sm:h-32 rounded-full border-4 border-teal-400 shadow-lg shadow-teal-400/20">
                @else
                <div class="w-24 h-24 sm:w-32 sm:h-32 rounded-full bg-gradient-to-br from-teal-400 to-cyan-500 flex items-center justify-center border-4 border-teal-400 shadow-lg shadow-teal-400/20">
                    <span class="font-display text-4xl font-bold text-white">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </div>
                @endif
            </div>
            <div>
                <h1 class="font-display text-3xl sm:text-4xl font-bold text-white text-center sm:text-left">
                    {{ Auth::user()->name }}
                </h1>
                <p class="text-teal-300 text-base sm:text-lg text-center sm:text-left">
                    Admin YUWARAJA XVII
                </p>
                <p class="text-gray-400 text-sm mt-1 text-center sm:text-left">
                    {{ Auth::user()->email }}
                </p>
            </div>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="space-y-8">
                <!-- Kartu Informasi Profil -->
                <section class="bg-gray-900/50 backdrop-blur-xl p-6 sm:p-8 rounded-2xl border border-teal-500/20">
                    <header class="mb-6">
                        <h2 class="font-display text-xl font-bold text-teal-300 flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            Informasi Profil
                        </h2>
                        <p class="text-gray-400 text-sm mt-1">Perbarui data diri dan alamat email Anda.</p>
                    </header>
                    @include('spv.profile.partials.update-profile-information-form')
                </section>

                <!-- Kartu Pembaruan Kata Sandi -->
                <section class="bg-gray-900/50 backdrop-blur-xl p-6 sm:p-8 rounded-2xl border border-teal-500/20">
                    <header class="mb-6">
                        <h2 class="font-display text-xl font-bold text-teal-300 flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            Ganti Kata Sandi
                        </h2>
                        <p class="text-gray-400 text-sm mt-1">Pastikan akun menggunakan kata sandi yang panjang dan acak agar tetap aman.</p>
                    </header>
                    @include('profile.partials.update-password-form')
                </section>
            </div>

            <div class="space-y-8">
                <!-- Kartu Informasi Cluster -->
                @if(Auth::user()->kelompok)
                <section class="bg-gray-900/50 backdrop-blur-xl p-6 sm:p-8 rounded-2xl border border-cyan-500/20">
                    <header class="mb-6">
                        <h2 class="font-display text-xl font-bold text-cyan-300 flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            Cluster yang Disupervisi
                        </h2>
                        <p class="text-gray-400 text-sm mt-1">Informasi cluster yang Anda supervisi.</p>
                    </header>
                    
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 p-4 bg-cyan-500/10 rounded-lg border border-cyan-500/20">
                            @if(Auth::user()->kelompok->foto_kelompok)
                                <img src="{{ asset('cluster-photos/' . Auth::user()->kelompok->foto_kelompok) }}" alt="Foto Cluster" class="w-16 h-16 rounded-full border-2 border-cyan-400">
                            @else
                                <div class="w-16 h-16 rounded-full bg-cyan-400/20 flex items-center justify-center border-2 border-cyan-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-cyan-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                    </svg>
                                </div>
                            @endif
                            <div class="flex-1">
                                <h3 class="font-semibold text-white">{{ Auth::user()->kelompok->nama_kelompok }}</h3>
                                <p class="text-sm text-cyan-400">Kode: {{ Auth::user()->kelompok->code }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ Auth::user()->kelompok->users->count() }} Anggota</p>
                            </div>
                        </div>
                        
                        <a href="{{ route('spv.cluster.index') }}" class="inline-flex items-center px-4 py-2 bg-cyan-500/10 hover:bg-cyan-500/20 text-cyan-300 rounded-lg transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                            Kelola Cluster
                        </a>
                    </div>
                </section>
                @endif

                <!-- Kartu Hapus Akun -->
                <section class="bg-gray-900/50 backdrop-blur-xl p-6 sm:p-8 rounded-2xl border border-red-500/20">
                    <header class="mb-6">
                        <h2 class="font-display text-xl font-bold text-red-400 flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" /></svg>
                            Hapus Akun
                        </h2>
                        <p class="text-red-300/80 text-sm mt-1">Setelah akun dihapus, semua data akan hilang selamanya.</p>
                    </header>
                    @include('profile.partials.delete-user-form')
                </section>
            </div>
        </div>
    </div>
</div>
@endsection