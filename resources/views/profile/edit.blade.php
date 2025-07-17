@extends('layouts.app')

@section('title', 'Pengaturan Profil')

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
            <div class="relative flex-shrink-0 group">
                {{-- Efek Glow untuk foto profil --}}
                <div class="absolute -inset-1 bg-gradient-to-r from-teal-400 to-amber-400 rounded-full blur-md opacity-60 group-hover:opacity-80 transition duration-500"></div>
                
                @if(Auth::user()->photo)
                <img src="{{ asset('storage/profile/'.Auth::user()->photo) }}" alt="Foto Profil" class="relative h-24 w-24 sm:h-28 sm:w-28 rounded-full object-cover border-2 border-gray-800">
                @else
                <div class="relative h-24 w-24 sm:h-28 sm:w-28 rounded-full bg-gray-800 flex items-center justify-center border-2 border-gray-700">
                    <span class="font-display text-4xl font-bold text-teal-300">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                </div>
                @endif
            </div>
            <div>
                <h1 class="font-display text-3xl sm:text-4xl font-bold text-white text-center sm:text-left">
                    {{ Auth::user()->name }}
                </h1>
                <p class="text-teal-300 text-base sm:text-lg text-center sm:text-left">
                    {{ Auth::user()->nim }}
                </p>
                <p class="text-gray-400 text-sm mt-1 text-center sm:text-left">
                    {{ Auth::user()->program_studi ?? 'Program Studi Belum Diatur' }}
                </p>
            </div>
        </header>

            <div class="lg:col-span-2 space-y-8 mb-12">
                <!-- Kartu Informasi Profil -->
                <section class="bg-gray-900/50 backdrop-blur-xl p-6 sm:p-8 rounded-2xl border border-teal-500/20">
                    <header class="mb-6">
                        <h2 class="font-display text-xl font-bold text-teal-300 flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            Informasi Profil
                        </h2>
                        <p class="text-gray-400 text-sm mt-1">Perbarui data diri dan alamat email Anda.</p>
                    </header>
                    @include('profile.partials.update-profile-information-form')
                </section>

                <!-- Kartu Pembaruan Kata Sandi -->
                <section class="bg-gray-900/50 backdrop-blur-xl p-6 sm:p-8 rounded-2xl border border-teal-500/20">
                    <header class="mb-6">
                        <h2 class="font-display text-xl font-bold text-teal-300 flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            Ganti Kata Sandi
                        </h2>
                        <p class="text-gray-400 text-sm mt-1">Gunakan kata sandi yang kuat untuk menjaga keamanan akun.</p>
                    </header>
                    @include('profile.partials.update-password-form')
                </section>
            </div>

            <div class="lg:col-span-1">
                <section class="bg-red-900/10 backdrop-blur-xl p-6 sm:p-8 rounded-2xl border border-red-500/20">
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
@endsection