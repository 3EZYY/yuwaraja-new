@extends('layouts.app')

@section('content')
{{-- CSS Kustom Minimal untuk Font, Animasi Background, dan Paginasi --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&family=Poppins:wght@600;700;900&display=swap');

    .font-display {
        font-family: 'Poppins', sans-serif;
    }

    .font-body {
        font-family: 'Kanit', sans-serif;
    }

    /* Efek Glow untuk Teks */
    .text-glow-cyan {
        text-shadow: 0 0 15px theme('colors.cyan.400 / 0.6');
    }

    .text-glow-yellow {
        text-shadow: 0 0 15px theme('colors.yellow.400 / 0.6');
    }

    /* Animasi Background */
    @keyframes scroll-grid {
        from {
            background-position: 0 0;
        }

        to {
            background-position: -500px -500px;
        }
    }

    .animated-grid-background {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        z-index: 0;
        background-image: linear-gradient(theme('colors.cyan.400 / 0.1') 1px, transparent 1px),
            linear-gradient(90deg, theme('colors.cyan.400 / 0.1') 1px, transparent 1px);
        background-size: 3rem 3rem;
        animation: scroll-grid 45s linear infinite;
    }

    /* Styling Paginasi Laravel */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
    }

    .pagination li a,
    .pagination li span {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 0.75rem;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        background-color: theme('colors.gray.800 / 0.5');
        color: theme('colors.cyan.300');
        border: 1px solid theme('colors.gray.700');
        transition: all 0.2s ease-in-out;
    }

    .pagination li a:hover {
        background-color: theme('colors.cyan.500 / 0.2');
        border-color: theme('colors.cyan.400');
        color: theme('colors.white');
    }

    .pagination li.active span {
        background-color: theme('colors.cyan.500');
        border-color: theme('colors.cyan.400');
        color: theme('colors.black');
        cursor: default;
    }

    .pagination li.disabled span {
        background-color: theme('colors.gray.800 / 0.2');
        color: theme('colors.gray.600');
        cursor: not-allowed;
    }
</style>

<div class="font-body bg-gray-900 min-h-screen py-12 sm:py-16 relative overflow-hidden">
    <div class="animated-grid-background"></div>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 relative z-10">
        <!-- Header Utama -->
        <header class="text-center mb-12">
            <h1 class="font-display text-4xl sm:text-5xl font-bold text-white mb-2" style="text-shadow: 5px 3px 30px #4bfbea;">
                Pusat Informasi
            </h1>
            <p class="text-cyan-200/60 text-base sm:text-lg">Akses pengumuman & pembaruan penting</p>
            <div class="w-24 h-1 bg-gradient-to-r from-cyan-400 to-yellow-400 mx-auto mt-3 rounded-full"></div>
        </header>

        <!-- Kontainer Pengumuman -->
        <main class="bg-gray-950/70 backdrop-blur-xl shadow-2xl rounded-2xl mb-8 border border-cyan-500/20">
            <div class="p-6 sm:p-8 md:p-10">
                <!-- Header Internal -->
                <div class="mb-8 border-l-4 border-cyan-400 pl-4">
                    <h2 class="font-display text-2xl font-bold text-white flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                        </svg>
                        PENGUMUMAN
                    </h2>
                    <p class="text-gray-400 text-sm">Informasi penting untuk seluruh mahasiswa.</p>
                </div>

                <!-- Daftar Pengumuman -->
                <div class="mb-8">

                    @if($pengumuman->isEmpty())
                    <div class="text-center py-16">
                        <p class="text-gray-400 text-lg font-mono">Belum ada pengumuman aktif.</p>
                        <p class="text-gray-500 text-sm mt-2">Silakan periksa kembali nanti.</p>
                    </div>
                    @else
                    <div class="grid gap-6 md:grid-cols-1 lg:grid-cols-2">
                        @foreach($pengumuman as $item)
                        <a href="{{ route('mahasiswa.pengumuman.detail', $item->id) }}" class="group block">
                            <article class="bg-gradient-to-br from-gray-900 to-gray-800/80 h-full p-6 rounded-xl border border-gray-700/50 hover:border-cyan-400/50 hover:bg-gray-900 transition-all duration-300 shadow-lg hover:shadow-cyan-500/10 flex flex-col transform hover:-translate-y-1">
                                <div class="flex-grow">

                                    {{-- PERUBAHAN DI SINI: Judul sekarang menggunakan flexbox untuk menampung ikon --}}
                                    <h4 class="font-display text-xl font-bold text-yellow-300 group-hover:text-yellow-300 transition-colors duration-300 mb-3 flex items-center gap-x-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-cyan-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                        </svg>
                                        <span>{{ $item->judul }}</span>
                                    </h4>

                                    <div class="flex items-center space-x-4 text-xs text-gray-400 mb-4">
                                        <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full bg-cyan-500/10 text-cyan-300 border border-cyan-500/20">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                            </svg>
                                            PENGUMUMAN
                                        </span>
                                        <span class="inline-flex items-center gap-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span class="font-semibold text-white">{{ $item->created_at->format('d M Y') }}</span>
                                        </span>
                                    </div>
                                    <p class="text-gray-400 text-sm leading-relaxed line-clamp-3">{{ Str::limit(strip_tags($item->isi ?? $item->konten ?? 'Tidak ada konten tersedia'), 150) }}</p>
                                </div>
                                <footer class="mt-4 pt-4 border-t border-gray-800 flex justify-end">
                                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-cyan-600 to-blue-600 group-hover:from-cyan-500 group-hover:to-blue-500 text-white font-bold text-sm rounded-lg transition-all duration-300 shadow-lg group-hover:shadow-cyan-500/25">
                                        <span>Baca Selengkapnya</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>
                                    </div>
                                </footer>
                            </article>
                        </a>
                        @endforeach
                    </div>
                    @endif

                    <!-- Pagination Kustom -->
                    <nav class="mt-12" aria-label="Navigasi Halaman">
                        {{ $pengumuman->links() }}
                    </nav>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection