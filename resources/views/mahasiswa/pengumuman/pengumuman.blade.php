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
                <div class="space-y-6">
                    @forelse($pengumuman as $item)
                    <div class="bg-gradient-to-br from-gray-900 to-black rounded-xl border-l-4 
                        @if(isset($item->prioritas))
                            @if($item->prioritas === 'tinggi') border-yellow-500 
                            @elseif($item->prioritas === 'sedang') border-cyan-600 
                            @else border-cyan-300 @endif
                        @else border-cyan-400 @endif
                        p-6 transition-all duration-300 hover:shadow-xl hover:shadow-cyan-500/10 hover:border-cyan-500 transform hover:-translate-y-1">
                        
                        <div class="flex flex-col md:flex-row items-start justify-between gap-6">
                            <div class="flex-1">
                                <div class="mb-3">
                                    <h3 class="text-xl font-bold font-display text-white mb-2">{{ $item->judul }}</h3>
                                    @if(isset($item->prioritas))
                                        @if($item->prioritas === 'tinggi')
                                            <span class="inline-flex items-center gap-2 px-3 py-1 bg-yellow-500/10 text-yellow-500 text-xs font-semibold rounded-full border border-yellow-500/20">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.21 3.03-1.742 3.03H4.42c-1.532 0-2.492-1.696-1.742-3.03l5.58-9.92zM10 13a1 1 0 110-2 1 1 0 010 2zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                                                PRIORITAS TINGGI
                                            </span>
                                        @elseif($item->prioritas === 'sedang')
                                            <span class="inline-flex items-center gap-2 px-3 py-1 bg-cyan-400/10 text-cyan-400 text-xs font-semibold rounded-full border border-cyan-400/20">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" /></svg>
                                                PRIORITAS SEDANG
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-2 px-3 py-1 bg-gray-500/10 text-gray-400 text-xs font-semibold rounded-full border border-gray-500/20">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                                PRIORITAS RENDAH
                                            </span>
                                        @endif
                                    @else
                                        <span class="inline-flex items-center gap-2 px-3 py-1 bg-cyan-500/10 text-cyan-300 text-xs font-semibold rounded-full border border-cyan-500/20">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                            </svg>
                                            PENGUMUMAN
                                        </span>
                                    @endif
                                </div>
                                
                                <p class="text-gray-300 mb-5 leading-relaxed">
                                    {{ Str::limit(strip_tags($item->isi ?? $item->konten ?? 'Tidak ada konten tersedia'), 180) }}
                                </p>
                                
                                {{-- Metadata dengan ikon dan layout yang rapi --}}
                                <div class="flex justify-between flex-col sm:flex-row sm:items-center gap-4 sm:gap-6 text-sm text-gray-400 border-t border-gray-700 pt-4">
                                  <div class="flex items-center gap-4">
                                      <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" /></svg>
                                        <span>{{ ($item->published_at ?? $item->created_at)->format('d M Y, H:i') }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                         <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" /></svg>
                                        <span>{{ $item->penulis ?? 'Admin' }}</span>
                                    </div>
                                  </div>
                                    {{-- Tombol Aksi Utama dengan warna Cyan --}}
                                    <div class="flex-shrink-0 w-full md:w-auto">
                                        <a href="{{ route('mahasiswa.pengumuman.detail', $item->id) }}" 
                                           class="w-full inline-flex items-center justify-center gap-2 bg-cyan-500 text-black font-display font-bold px-5 py-2.5 rounded-lg transition-all duration-300 hover:bg-cyan-400 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-cyan-500/50">
                                            <span>Lihat Detail</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    @empty
                    <div class="bg-gray-900/50 border-2 border-dashed border-gray-700 rounded-xl p-12 text-center flex flex-col items-center">
                         <div class="text-gray-700 mb-4">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h6m-1-5h.01" />
                             </svg>
                         </div>
                        <h3 class="text-xl font-bold font-display text-white mb-2">Belum Ada Pengumuman</h3>
                        <p class="text-gray-500 max-w-xs">Saat informasi baru tersedia, semua akan ditampilkan lengkap di halaman ini.</p>
                    </div>
                    @endforelse

                    <!-- Pagination Kustom -->
                    @if($pengumuman->hasPages())
                    <div class="mt-10 flex justify-center">
                        <div class="bg-gray-900 border border-gray-700 rounded-lg p-2">
                            {{ $pengumuman->links() }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</div>
@endsection