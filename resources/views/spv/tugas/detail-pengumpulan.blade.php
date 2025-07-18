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
    .status-pending { background: rgba(245, 158, 11, 0.2); color: #f59e0b; }
    .status-submitted { background: rgba(59, 130, 246, 0.2); color: #3b82f6; }
    .status-reviewed { background: rgba(34, 197, 94, 0.2); color: #22c55e; }
    .status-approved { background: rgba(34, 197, 94, 0.2); color: #22c55e; }
    .status-done { background: rgba(168, 85, 247, 0.2); color: #a855f7; }
    
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
    <div class="max-w-4xl mx-auto">
        
        <!-- Header -->
        <header class="mb-8 scroll-reveal">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <h1 class="font-kanit text-3xl sm:text-4xl font-bold text-teal-400 tracking-wide">
                        Review Pengumpulan
                    </h1>
                    <p class="font-poppins text-gray-400 mt-1">
                        Detail dan penilaian pengumpulan tugas mahasiswa.
                    </p>
                </div>
                <a href="{{ route('spv.tugas.show', $pengumpulan->tugas->id) }}" 
                   class="inline-flex items-center gap-2 bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
            </div>
            <div class="h-px bg-gray-700/50 mt-6"></div>
        </header>

        <!-- Detail Tugas -->
        <div class="bg-gray-800/60 border border-gray-700 rounded-lg shadow-lg p-6 mb-8 scroll-reveal">
            <h2 class="font-kanit text-2xl font-bold text-teal-400 mb-4">
                {{ $pengumpulan->tugas->judul ?? 'Tugas Tidak Ditemukan' }}
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-400">Nama Mahasiswa</p>
                            <p class="text-white font-semibold">{{ $pengumpulan->user->name ?? 'Tidak tersedia' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857"/>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-400">Kelompok</p>
                            <p class="text-white font-semibold">{{ $pengumpulan->kelompok->nama ?? 'Belum ada kelompok' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-400">Email</p>
                            <p class="text-white font-semibold">{{ $pengumpulan->user->email ?? 'Tidak tersedia' }}</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-400">Status Saat Ini</p>
                            <span class="status-badge status-{{ strtolower($pengumpulan->status) }}">
                                {{ ucfirst($pengumpulan->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="text-sm text-gray-400">Waktu Pengumpulan</p>
                            <p class="text-white font-semibold">{{ $pengumpulan->submitted_at ? $pengumpulan->submitted_at->format('d M Y, H:i') : 'Belum dikumpulkan' }}</p>
                        </div>
                    </div>
                    @if($pengumpulan->file_path)
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <div>
                                <p class="text-sm text-gray-400">File Pengumpulan</p>
                                <a href="{{ asset('storage/' . $pengumpulan->file_path) }}" target="_blank" 
                                   class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-400 text-black px-3 py-1 rounded text-sm font-medium transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Download File
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Form Review -->
        <div class="bg-gray-800/60 border border-gray-700 rounded-lg shadow-lg p-6 scroll-reveal">
            <h3 class="font-kanit text-xl font-semibold text-white mb-6">Form Penilaian</h3>
            
            @if(session('success'))
                <div class="bg-green-500/20 border border-green-500/50 text-green-300 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-500/20 border border-red-500/50 text-red-300 px-4 py-3 rounded-lg mb-6">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('spv.tugas.approve', $pengumpulan->id) }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nilai" class="block text-sm font-semibold text-gray-300 mb-2">Nilai (0-100)</label>
                        <input type="number" name="nilai" id="nilai" class="form-input" 
                               value="{{ old('nilai', $pengumpulan->nilai) }}" min="0" max="100" required>
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-300 mb-2">Status</label>
                        <select name="status" id="status" class="form-input">
                            <option value="reviewed" {{ $pengumpulan->status == 'reviewed' ? 'selected' : '' }}>Perlu Diteliti</option>
                            <option value="approved" {{ $pengumpulan->status == 'approved' ? 'selected' : '' }}>Approve</option>
                            <option value="done" {{ $pengumpulan->status == 'done' ? 'selected' : '' }}>Done/Selesai</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="keterangan" class="block text-sm font-semibold text-gray-300 mb-2">Keterangan/Feedback</label>
                    <textarea name="keterangan" id="keterangan" rows="4" class="form-input" 
                              placeholder="Berikan feedback atau keterangan untuk mahasiswa...">{{ old('keterangan', $pengumpulan->keterangan) }}</textarea>
                </div>
                <div class="flex justify-end pt-6 border-t border-gray-700">
                    <button type="submit" class="submit-button">
                        <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Review
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const revealElements = document.querySelectorAll('.scroll-reveal');
    
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
});
</script>
@endsection