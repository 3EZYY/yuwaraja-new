@extends('layouts.app')

@section('title', 'Review Pengumpulan Tugas')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #0D1117;
    }

    .font-kanit {
        font-family: 'Kanit', sans-serif;
    }

    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #0D1117;
    }

    ::-webkit-scrollbar-thumb {
        background-color: #164e63;
        border-radius: 10px;
        border: 2px solid #0D1117;
    }

    ::-webkit-scrollbar-thumb:hover {
        background-color: #0e7490;
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .status-pending {
        background: rgba(245, 158, 11, 0.2);
        color: #f59e0b;
    }

    .status-submitted {
        background: rgba(59, 130, 246, 0.2);
        color: #3b82f6;
    }

    .status-reviewed {
        background: rgba(34, 197, 94, 0.2);
        color: #22c55e;
    }

    .status-approved {
        background: rgba(34, 197, 94, 0.2);
        color: #22c55e;
    }

    .status-rejected {
        background: rgba(239, 68, 68, 0.2);
        color: #ef4444;
    }

    .status-done {
        background: rgba(168, 85, 247, 0.2);
        color: #a855f7;
    }

    .form-input {
        background-color: rgba(17, 24, 39, 0.8);
        border: 1px solid rgba(20, 184, 166, 0.25);
        border-radius: 0.5rem;
        color: #d1d5db;
        padding: 0.75rem 1rem;
        width: 100%;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: #14b8a6;
        box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
    }

    .submit-button {
        background: linear-gradient(135deg, #14b8a6, #0d9488);
        color: #000;
        font-weight: 700;
        text-transform: uppercase;
        padding: 0.75rem 2rem;
        border-radius: 0.5rem;
        border: none;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .submit-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(20, 184, 166, 0.3);
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#0D1117] to-[#111827] text-white p-4 sm:p-6 lg:p-8">
    <div class="max-w-7xl mx-auto">

        <!-- Header -->
        <header class="bg-gray-800/70 backdrop-blur-sm border border-gray-700/50 rounded-2xl p-6 mb-8 scroll-reveal">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <h1 class="font-kanit text-3xl sm:text-4xl font-bold bg-gradient-to-r from-cyan-400 to-sky-400 bg-clip-text text-transparent tracking-wide">
                        Review Pengumpulan
                    </h1>
                    <p class="font-poppins text-gray-400 mt-1">
                        Detail dan penilaian pengumpulan tugas mahasiswa.
                    </p>
                </div>
                <a href="{{ route('spv.pengumpulan.index') }}"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-gray-700 to-gray-600 hover:from-gray-600 hover:to-gray-500 text-white px-4 py-2 rounded-lg transition-all duration-300 transform hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>
        </header>

        <!-- Detail Tugas -->
        <div class="bg-gray-800/60 border border-gray-700 rounded-lg shadow-lg p-6 mb-8 scroll-reveal">
            <h2 class="font-kanit text-2xl font-bold bg-gradient-to-r from-cyan-400 to-sky-400 bg-clip-text text-transparent mb-4">
                {{ $pengumpulan->tugas->judul ?? 'Tugas Tidak Ditemukan' }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                <div class="space-y-4">
                    <div class="bg-gray-700/60 rounded-lg p-4">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <div>
                                <p class="text-sm text-gray-400">Nama Mahasiswa</p>
                                <p class="text-white font-semibold">{{ $pengumpulan->user->name ?? 'Tidak tersedia' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-700/60 rounded-lg p-4">
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                            </svg>
                            <div>
                                <p class="text-sm text-gray-400">Cluster</p>
                                <p class="text-white font-semibold">
                                    @if($pengumpulan->user && $pengumpulan->user->kelompok)
                                    {{ $pengumpulan->user->kelompok->nama_kelompok }}
                                    @elseif($pengumpulan->kelompok)
                                    {{ $pengumpulan->kelompok->nama_kelompok }}
                                    @else
                                    <span class="text-gray-500">Belum ada Cluster</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-700/60 rounded-lg p-4">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <p class="text-sm text-gray-400">Email</p>
                                <p class="text-white font-semibold">{{ $pengumpulan->user->email ?? 'Tidak tersedia' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="bg-gray-700/60 rounded-lg p-4">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <div>
                                <p class="text-sm text-gray-400">Status Saat Ini</p>
                                <span class="status-badge status-{{ strtolower($pengumpulan->status) }}">
                                    {{ ucfirst($pengumpulan->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-700/60 rounded-lg p-4">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="text-sm text-gray-400">Waktu Pengumpulan</p>
                                <p class="text-white font-semibold">{{ $pengumpulan->submitted_at ? $pengumpulan->submitted_at->format('d M Y, H:i') : 'Belum dikumpulkan' }}</p>
                            </div>
                        </div>
                    </div>
                    @if($pengumpulan->file_path)
                    <div class="bg-gray-700/60 rounded-lg p-4">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <div>
                                <p class="text-sm text-gray-400 mb-1">File Pengumpulan</p>
                                <a href="{{ route('spv.tugas.pengumpulan.download', $pengumpulan->id) }}"
                                    class="inline-flex items-center gap-2 bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 text-white px-3 py-1 rounded-lg text-sm font-medium transition-all duration-300 transform hover:scale-105">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Download File
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <!-- Student Description Section -->
            @if($pengumpulan)
            <div class="bg-gradient-to-r from-blue-500/10 to-cyan-500/10 border border-blue-500/30 rounded-lg p-6 my-5 scroll-reveal">
                <div class="flex items-start gap-3">
                    <div class="p-2 bg-blue-500/20 rounded-lg">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h3 class="font-kanit text-lg font-bold text-blue-300 mb-2">Deskripsi dari Mahasiswa</h3>
                        @if($pengumpulan->keterangan)
                        <p class="text-gray-300 leading-relaxed">{{ $pengumpulan->keterangan }}</p>
                        @else
                        <p class="text-gray-500 italic">Mahasiswa tidak memberikan deskripsi tambahan.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- Form Review -->
        <div class="bg-gradient-to-br from-gray-800/80 to-gray-900/80 backdrop-blur-sm border border-gray-700/50 rounded-2xl shadow-2xl p-8 scroll-reveal">
            <div class="flex items-center gap-3 mb-8">
                <div class="p-3 bg-gradient-to-r from-teal-500 to-cyan-500 rounded-xl">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-kanit text-2xl font-bold text-white">Form Penilaian</h3>
                    <p class="text-gray-400 text-sm">Berikan penilaian dan feedback untuk mahasiswa</p>
                </div>
            </div>
        
            @if(session('success'))
            <div class="bg-gradient-to-r from-green-500/20 to-emerald-500/20 border border-green-500/30 text-green-300 px-6 py-4 rounded-xl mb-6 flex items-center gap-3">
                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ session('success') }}
            </div>
            @endif
        
            @if($errors->any())
            <div class="bg-gradient-to-r from-red-500/20 to-pink-500/20 border border-red-500/30 text-red-300 px-6 py-4 rounded-xl mb-6">
                <div class="flex items-center gap-3 mb-2">
                    <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-semibold">Terdapat kesalahan:</span>
                </div>
                <ul class="list-disc list-inside space-y-1 ml-8">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        
            <form action="{{ route('spv.tugas.approve', $pengumpulan->id) }}" method="POST" class="space-y-8">
                @csrf
        
                <!-- Grid Layout for Form Fields -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
                    <!-- Nilai Input - Only show when status is "done" -->
                    <div class="space-y-3" id="score-section" style="display: none;">
                        <label for="nilai" class="flex items-center gap-2 text-sm font-semibold text-gray-200">
                            <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            Nilai (0-100)
                        </label>
                        <div class="relative">
                            <input type="number" name="nilai" id="nilai"
                                class="w-full bg-gray-900/50 border-2 border-gray-600/50 rounded-xl px-4 py-3 text-white placeholder-gray-400 focus:border-teal-500 focus:ring-4 focus:ring-teal-500/20 transition-all duration-300 text-lg font-semibold"
                                value="{{ old('nilai', $pengumpulan->nilai) }}"
                                min="0" max="100"
                                placeholder="Masukkan nilai 0-100">
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm">
                                /100
                            </div>
                        </div>
                    </div>
        
                    <!-- Status Select -->
                    <div class="space-y-3">
                        <label for="status" class="flex items-center gap-2 text-sm font-semibold text-gray-200">
                            <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Status Penilaian
                        </label>
                        <div class="relative">
                            <select name="status" id="status"
                                class="w-full bg-gray-900/50 border-2 border-gray-600/50 rounded-xl px-4 py-3 text-white focus:border-teal-500 focus:ring-4 focus:ring-teal-500/20 transition-all duration-300 text-lg font-semibold appearance-none cursor-pointer">
                                <option value="reviewed" {{ $pengumpulan->status == 'reviewed' ? 'selected' : '' }}>
                                    🔍 Sedang Direview SPV
                                </option>
                                <option value="rejected" {{ $pengumpulan->status == 'rejected' ? 'selected' : '' }}>
                                    ❌ Butuh Perbaikan
                                </option>
                                <option value="done" {{ $pengumpulan->status == 'done' ? 'selected' : '' }}>
                                    ✅ Tugas Selesai
                                </option>
                            </select>
                            <div class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
        
                        <!-- Status Description -->
                        <div id="status-description" class="mt-3 p-4 rounded-lg text-sm">
                            <!-- Description will be updated by JavaScript -->
                        </div>
                    </div>
                </div>
        
                <!-- Feedback Textarea -->
                <div class="space-y-3">
                    <label for="feedback" class="flex items-center gap-2 text-sm font-semibold text-gray-200">
                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        Feedback SPV untuk Mahasiswa
                    </label>
                    <div class="relative">
                        <textarea name="feedback" id="feedback" rows="5"
                            class="w-full bg-gray-900/50 border-2 border-gray-600/50 rounded-xl px-4 py-3 text-white placeholder-gray-400 focus:border-teal-500 focus:ring-4 focus:ring-teal-500/20 transition-all duration-300 resize-none"
                            placeholder="Berikan feedback konstruktif untuk membantu mahasiswa berkembang...">{{ old('feedback', $pengumpulan->feedback) }}</textarea>
                        <div class="absolute bottom-3 right-3 text-gray-500 text-xs">
                            <span id="char-count">0</span> karakter
                        </div>
                    </div>
                </div>
        
                <!-- Submit Button -->
                <div class="flex flex-col sm:flex-row items-center justify-between pt-8 border-t border-gray-700/50 gap-4">
                    <div class="text-sm text-gray-400">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Pastikan penilaian sudah sesuai sebelum menyimpan
                    </div>
                    <button type="submit"
                        class="group relative px-8 py-4 bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white font-bold rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl hover:shadow-teal-500/25 focus:outline-none focus:ring-4 focus:ring-teal-500/50">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-lg">Simpan Penilaian</span>
                        </div>
                        <div class="absolute inset-0 bg-white/20 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>

    @endif
</div>

</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const revealElements = document.querySelectorAll('.scroll-reveal');
        const statusSelect = document.getElementById('status');
        const statusDescription = document.getElementById('status-description');
        const feedbackTextarea = document.getElementById('feedback');
        const charCount = document.getElementById('char-count');

        // Scroll reveal animation
        revealElements.forEach(el => {
            el.classList.add('opacity-0', 'transform', 'translate-y-5');
            el.classList.add('transition-all', 'duration-700', 'ease-out');
        });

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.remove('opacity-0', 'translate-y-5');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        revealElements.forEach(el => {
            observer.observe(el);
        });

        // Status descriptions
        const statusDescriptions = {
            'reviewed': {
                text: 'Tugas sedang dalam tahap review oleh SPV. Mahasiswa akan menerima notifikasi bahwa tugas mereka sedang diperiksa.',
                class: 'bg-blue-500/10 border border-blue-500/30 text-blue-300'
            },
            'rejected': {
                text: 'Tugas membutuhkan perbaikan. Mahasiswa dapat mengumpulkan tugas kembali setelah melakukan revisi sesuai feedback.',
                class: 'bg-red-500/10 border border-red-500/30 text-red-300'
            },
            'done': {
                text: 'Tugas telah selesai dan dinilai. Mahasiswa tidak dapat lagi mengumpulkan tugas untuk assignment ini.',
                class: 'bg-green-500/10 border border-green-500/30 text-green-300'
            }
        };

        // Update status description and score section visibility
        function updateStatusDescription() {
            const selectedStatus = statusSelect.value;
            const description = statusDescriptions[selectedStatus];
            const scoreSection = document.getElementById('score-section');
            const nilaiInput = document.getElementById('nilai');

            if (description) {
                statusDescription.className = `mt-3 p-4 rounded-lg text-sm ${description.class}`;
                statusDescription.innerHTML = `
                <div class="flex items-start gap-2">
                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>${description.text}</span>
                </div>
            `;
            }

            // Show/hide score section based on status
            if (selectedStatus === 'done') {
                scoreSection.style.display = 'block';
                nilaiInput.required = true;
            } else {
                scoreSection.style.display = 'none';
                nilaiInput.required = false;
                nilaiInput.value = '';
            }
        }

        // Character counter for textarea
        function updateCharCount() {
            const count = feedbackTextarea.value.length;
            charCount.textContent = count;

            if (count > 500) {
                charCount.parentElement.classList.add('text-red-400');
            } else if (count > 300) {
                charCount.parentElement.classList.add('text-yellow-400');
                charCount.parentElement.classList.remove('text-red-400');
            } else {
                charCount.parentElement.classList.remove('text-red-400', 'text-yellow-400');
            }
        }

        // Event listeners
        statusSelect.addEventListener('change', updateStatusDescription);
        feedbackTextarea.addEventListener('input', updateCharCount);

        // Initialize
        updateStatusDescription();
        updateCharCount();

        // Show score section if current status is 'done'
        if (statusSelect.value === 'done') {
            document.getElementById('score-section').style.display = 'block';
            document.getElementById('nilai').required = true;
        }

        // Form validation
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const nilai = document.getElementById('nilai').value;
            const status = statusSelect.value;

            if (!nilai || nilai < 0 || nilai > 100) {
                e.preventDefault();
                alert('Nilai harus diisi dan berada dalam rentang 0-100');
                return;
            }

            if (status === 'done' && (!feedbackTextarea.value.trim())) {
                const confirm = window.confirm('Anda akan menyelesaikan tugas tanpa memberikan feedback. Apakah Anda yakin?');
                if (!confirm) {
                    e.preventDefault();
                    return;
                }
            }

            if (status === 'rejected' && (!feedbackTextarea.value.trim())) {
                e.preventDefault();
                alert('Feedback wajib diisi ketika tugas membutuhkan perbaikan');
                feedbackTextarea.focus();
                return;
            }
        });
    });
</script>
@endsection