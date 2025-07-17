@extends('layouts.app')

@section('content')
    {{-- CSS Kustom Minimal untuk Font dan Efek Khusus --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&family=Poppins:wght@600;700;900&display=swap');
        
        .font-display { font-family: 'Poppins', sans-serif; }
        .font-body { font-family: 'Kanit', sans-serif; }
        
        /* Efek Glow untuk Teks */
        .text-glow-teal {
            text-shadow: 0 0 15px theme('colors.teal.500 / 0.5');
        }

        /* Animasi Background (opsional, jika ingin konsisten) */
        @keyframes scroll-grid {
            from { background-position: 0 0; }
            to { background-position: -500px -500px; }
        }
        .animated-grid-background {
            position: absolute; inset: 0; width: 100%; height: 100%; z-index: 0;
            background-image: linear-gradient(theme('colors.teal.500 / 0.1') 1px, transparent 1px),
                              linear-gradient(90deg, theme('colors.teal.500 / 0.1') 1px, transparent 1px);
            background-size: 3rem 3rem;
            animation: scroll-grid 45s linear infinite;
        }
    </style>

<div class="font-body bg-gray-900 min-h-screen py-12 sm:py-16 relative overflow-hidden">
    <div class="animated-grid-background opacity-20"></div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- Navigasi Kembali -->
        <div class="mb-8">
            <a href="{{ route('mahasiswa.pengumuman.index') }}" class="inline-flex items-center gap-2 text-teal-300 hover:text-amber-300 transition-colors group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
                Kembali ke Pusat Informasi
            </a>
        </div>
        
        <!-- Konten Detail Pengumuman -->
        <article class="bg-gray-950/70 backdrop-blur-xl shadow-2xl rounded-2xl border border-teal-500/20">
            <div class="p-6 sm:p-8 md:p-10">
                
                {{-- Header Pengumuman --}}
                <header class="mb-6 pb-6 border-b border-gray-700/50">
                    <h1 class="font-display text-3xl md:text-4xl font-bold text-teal-200 text-glow-teal mb-3">{{ $pengumuman->judul }}</h1>
                    <div class="flex items-center gap-2 text-sm text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        <span>Dipublikasikan pada: <span class="font-semibold text-amber-300">{{ $pengumuman->created_at->format('d F Y, H:i') }}</span></span>
                    </div>
                </header>

                {{-- Isi Konten --}}
                <div class="prose prose-invert prose-sm sm:prose-base max-w-none text-gray-300 prose-headings:text-teal-300 prose-a:text-amber-300 hover:prose-a:text-amber-200 prose-strong:text-white">
                    {!! $pengumuman->konten !!}
                </div>
            </div>
        </article>
        
    </div>
</div>
@endsection