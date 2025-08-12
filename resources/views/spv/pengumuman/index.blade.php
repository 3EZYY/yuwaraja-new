@extends('layouts.app')

@section('title', 'Pengumuman')

@section('content')
{{-- Mengimpor Google Fonts untuk Poppins dan Kanit --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@500;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<style>
    .font-poppins {
        font-family: 'Poppins', sans-serif;
    }

    .font-kanit {
        font-family: 'Kanit', sans-serif;
    }
</style>

<body class="bg-gradient-to-br from-[#0D1117] via-[#164e63] to-[#111827] text-white font-poppins">

    <div class="container mx-auto p-4 md:p-6 lg:p-8">

        <header class="mb-8 md:mb-10">
            <div class="bg-gray-800/60 border border-teal-400/30 rounded-xl p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="flex items-center gap-4">
                    {{-- SVG Ikon Megaphone yang Lebih Stylish --}}
                    <div class="w-16 h-16 bg-gradient-to-br from-teal-400 to-teal-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold font-kanit text-white">
                            PAPAN PENGUMUMAN
                        </h1>
                        <p class="text-gray-400 text-sm sm:text-base">Informasi penting dan terkini untuk seluruh mahasiswa.</p>
                    </div>
                </div>
                <div class="bg-gray-800/70 border border-gray-700 rounded-lg p-4 text-center w-full md:w-auto">
                    <div class="text-4xl font-bold font-kanit bg-gradient-to-r from-teal-400 to-amber-400 bg-clip-text text-transparent">{{ $pengumuman->total() }}</div>
                    <div class="text-sm text-gray-400 mt-1">Total Pengumuman</div>
                </div>
            </div>
        </header>

        <!-- Daftar Pengumuman -->
        <main>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($pengumuman as $item)
                <div class="bg-gray-800/60 rounded-xl border 
                @if($item->tipe === 'penting') border-red-400 
                @else border-teal-300/30 @endif
                p-6 transition-all duration-300 hover:shadow-xl hover:shadow-teal-500/10 hover:border-teal-400/70 transform hover:-translate-y-1 h-full flex flex-col">

                    <!-- Header Box -->
                    <div class="mb-4">
                        <div class="flex items-start justify-between mb-3">
                            <h3 class="text-lg font-bold font-kanit text-white line-clamp-2 flex-1">{{ $item->judul }}</h3>
                            @if($item->tipe === 'penting')
                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-red-500/10 text-red-400 text-xs font-semibold rounded-full border border-red-500/20 ml-2 flex-shrink-0">
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.21 3.03-1.742 3.03H4.42c-1.532 0-2.492-1.696-1.742-3.03l5.58-9.92zM10 13a1 1 0 110-2 1 1 0 010 2zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg> -->
                                PENTING
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-teal-500/10 text-teal-400 text-xs font-semibold rounded-full border border-teal-500/20 ml-2 flex-shrink-0">
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" clip-rule="evenodd" />
                                </svg> -->
                                UMUM
                            </span>
                            @endif
                        </div>
                    </div>

                    <!-- Content Box -->
                    <div class="flex-1 mb-4">
                        <p class="text-gray-300 text-sm leading-relaxed">
                            {{ Str::limit($item->konten, 120) }}
                        </p>
                    </div>

                    <!-- Footer Box -->
                    <div class="border-t border-gray-600/50 pt-4 mt-auto">
                        <div class="flex flex-col gap-3">
                            <div class="flex items-center justify-between text-xs text-gray-400">
                                <div class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </svg>
                                    <span>{{ $item->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                    <span>{{ $item->penulis ?? 'Admin' }}</span>
                                </div>
                            </div>
                            <a href="{{ route('spv.pengumuman.detail', $item) }}"
                                class="w-full inline-flex items-center justify-center gap-2 bg-gradient-to-br from-teal-500 to-teal-600 text-white font-poppins font-medium px-4 py-2 rounded-lg transition-all duration-300 hover:from-teal-600 hover:to-teal-700 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-teal-500/50 text-sm">
                                <span>Lihat Detail</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full">
                    <div class="bg-gray-800/60 border-2 border-dashed border-gray-700 rounded-xl p-12 text-center flex flex-col items-center">
                        <div class="text-gray-700 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 12h6m-1-5h.01" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold font-kanit text-white mb-2">Belum Ada Pengumuman</h3>
                        <p class="text-gray-500 max-w-xs">Saat informasi baru tersedia, semua akan ditampilkan lengkap di halaman ini.</p>
                    </div>
                </div>
                @endforelse
            </div>
        </main>

        <!-- Pagination -->
        @if($pengumuman->hasPages())
        <footer class="mt-10 flex justify-center">
            <div class="bg-gray-900 border border-gray-500 rounded-lg p-2">
                {{ $pengumuman->links() }}
            </div>
        </footer>
        @endif
    </div>

    @endsection