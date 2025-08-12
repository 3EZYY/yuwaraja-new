@extends('layouts.app')

@section('title', 'Daftar Pengumpulan Tugas')

@push('styles')
{{-- Menambahkan Font yang lebih modern dan profesional --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;600&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
<style>
    /* Menerapkan font dasar ke body. Ini adalah satu-satunya CSS kustom yang diperlukan. */
    body {
        font-family: 'Kanit', sans-serif;
        background-color: #0D1117;
        /* dark background */
    }

    .font-poppins {
        font-family: 'Poppins', sans-serif;
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#0D1117] via-[#111827] to-[#0a0a0a] text-white p-4 sm:p-6 lg:p-8">
    <div class="max-w-7xl mx-auto">

        <!-- Header Section -->
        <header class="mb-8 scroll-reveal">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="flex-shrink-0 bg-gray-800/70 p-3 rounded-lg border border-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="font-poppins text-2xl sm:text-3xl font-bold text-white">Pengumpulan Tugas</h1>
                        <p class="text-gray-400">Review dan evaluasi tugas yang dikumpulkan.</p>
                    </div>
                </div>
                <div class="bg-gray-800/70 p-3 rounded-lg border border-gray-700 text-center w-full sm:w-auto">
                    <div class="font-poppins text-3xl font-bold bg-gradient-to-r from-teal-400 to-amber-400 bg-clip-text text-transparent">{{ $pengumpulans->total() }}</div>
                    <div class="text-sm text-gray-400">Total Data</div>
                </div>
            </div>
        </header>

        <!-- Daftar Pengumpulan -->
        <div class="space-y-5">
            @forelse($pengumpulans as $index => $pengumpulan)
            <div class="scroll-reveal bg-gray-800/60 border border-gray-700 rounded-xl shadow-lg transition-all duration-300 hover:border-cyan-400/50 hover:shadow-cyan-500/10 hover:-translate-y-1"
                style="transition-delay: {{ $index * 50 }}ms">
                <div class="p-5 sm:p-6 relative">
                    <!-- Informasi Utama -->
                    <div class="mb-4">
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-2 mb-4">
                            <h3 class="font-poppins text-lg lg:text-xl font-bold text-white">{{ $pengumpulan->tugas->judul ?? 'Tugas Dihapus' }}</h3>
                            <span class="px-3 py-1 text-xs font-semibold uppercase tracking-wider rounded-full 
                                @if($pengumpulan->status == 'submitted') bg-amber-500/10 text-amber-400 
                                @elseif($pengumpulan->status == 'reviewed') bg-blue-500/10 text-blue-400
                                @elseif($pengumpulan->status == 'approved' || $pengumpulan->status == 'done') bg-green-500/10 text-green-400
                                @else bg-slate-500/10 text-slate-400 @endif">
                                {{ $pengumpulan->status }}
                            </span>
                        </div>

                        <!-- Detail Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-sm">
                            <div class="bg-gray-700/60 rounded-lg p-3">
                                <p class="text-xs text-gray-400 mb-1">Mahasiswa</p>
                                <p class="font-semibold text-white">{{ $pengumpulan->user->name ?? 'User Dihapus' }}</p>
                            </div>
                            <div class="bg-gray-700/60 rounded-lg p-3">
                                <p class="text-xs text-gray-400 mb-1">Dikumpulkan Pada</p>
                                <p class="font-semibold text-white">{{ $pengumpulan->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            <div class="bg-gray-700/60 rounded-lg p-3">
                                <p class="text-xs text-gray-400 mb-1">Nilai</p>
                                <p class="font-semibold {{ $pengumpulan->nilai ? 'text-cyan-400' : 'text-gray-500' }}">
                                    {{ $pengumpulan->nilai ? $pengumpulan->nilai . ' / 100' : 'Belum Dinilai' }}
                                </p>
                            </div>
                        </div>

                        @if($pengumpulan->file_path)
                        <div class="mt-5">
                            <a href="{{ asset('storage/' . $pengumpulan->file_path) }}" target="_blank"
                                class="inline-flex items-center gap-2 text-sm font-semibold text-cyan-400 hover:text-cyan-300 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Download File Lampiran
                            </a>
                        </div>
                        @endif
                    </div>

                    <!-- Tombol Aksi - Pojok Kanan Bawah -->
                    <div class="absolute bottom-5 right-5">
                        <a href="{{ route('spv.tugas.pengumpulan.show', $pengumpulan->id) }}"
                            class="flex items-center justify-center px-4 py-2 rounded-lg text-sm font-bold bg-gradient-to-br from-cyan-500 to-blue-500 text-white shadow-lg transition-all duration-300 hover:from-cyan-600 hover:to-blue-600 hover:shadow-xl hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-cyan-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Review & Nilai
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="scroll-reveal bg-gray-800/60 border border-dashed border-gray-700 rounded-xl p-12 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="font-poppins text-xl font-bold text-white mt-4">Belum Ada Pengumpulan</h3>
                <p class="text-gray-400 mt-1">Data akan muncul di sini saat mahasiswa mengumpulkan tugas.</p>
            </div>
            @endforelse
        </div>

        @if($pengumpulans->hasPages())
        <div class="mt-8 flex justify-center">
            {{-- Pastikan Anda sudah mem-publish pagination view untuk Tailwind --}}
            {{-- Jalankan: php artisan vendor:publish --tag=laravel-pagination --}}
            {{ $pengumpulans->links() }}
        </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                    entry.target.classList.remove('opacity-0', 'translate-y-5');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        document.querySelectorAll('.scroll-reveal').forEach(el => {
            el.classList.add('opacity-0', 'transform', 'translate-y-5', 'transition-all', 'duration-700', 'ease-out');
            observer.observe(el);
        });
    });
</script>
@endsection