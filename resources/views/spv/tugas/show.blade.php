@extends('layouts.app')

@section('title', 'Detail Tugas')

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
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#0D1117] to-[#111827] text-white p-4 sm:p-6 lg:p-8">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header -->
        <header class="mb-8 scroll-reveal">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <h1 class="font-kanit text-3xl sm:text-4xl font-bold text-teal-400 tracking-wide">
                        Detail Tugas
                    </h1>
                    <p class="font-poppins text-gray-400 mt-1">
                        Informasi lengkap tugas dan pengumpulan mahasiswa.
                    </p>
                </div>
                <a href="{{ route('spv.tugas.index') }}" 
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
            <div class="flex flex-col md:flex-row justify-between md:items-start gap-6">
                <div class="flex-grow">
                    <div class="flex flex-wrap items-center gap-x-4 gap-y-2 mb-4">
                        <h2 class="font-kanit text-2xl lg:text-3xl font-semibold text-white">
                            {{ $tugas->judul }}
                        </h2>
                    </div>
                    
                    <p class="font-poppins text-gray-300 text-sm leading-relaxed mb-6">
                        {{ $tugas->deskripsi }}
                    </p>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-sm">
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-teal-400/70 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <div>
                                <div class="text-gray-400">Deadline</div>
                                <div class="font-semibold text-white">{{ \Carbon\Carbon::parse($tugas->deadline)->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-teal-400/70 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v5m0 0v2.5m0-2.5h2.5m-2.5 0H9.5"/>
                            </svg>
                            <div>
                                <div class="text-gray-400">Poin</div>
                                <div class="font-semibold text-white">{{ $tugas->poin ?? 100 }} Poin</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            @if(\Carbon\Carbon::parse($tugas->deadline)->isPast())
                                <svg class="w-6 h-6 text-red-400/70 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <div class="text-gray-400">Status</div>
                                    <div class="font-semibold text-red-400">Berakhir</div>
                                </div>
                            @else
                                <svg class="w-6 h-6 text-green-400/70 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <div class="text-gray-400">Status</div>
                                    <div class="font-semibold text-green-400">Aktif</div>
                                </div>
                            @endif
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-purple-400/70 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857"/>
                            </svg>
                            <div>
                                <div class="text-gray-400">Pengumpulan</div>
                                <div class="font-semibold text-white">{{ $pengumpulans->total() }} Mahasiswa</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Pengumpulan -->
        <div class="bg-gray-800/60 border border-gray-700 rounded-lg shadow-lg overflow-hidden scroll-reveal">
            <div class="p-6 border-b border-gray-700">
                <h3 class="font-kanit text-xl font-semibold text-white">Pengumpulan Tugas</h3>
                <p class="text-gray-400 text-sm mt-1">Daftar mahasiswa yang telah mengumpulkan tugas</p>
            </div>
            
            <div class="overflow-x-auto">
                @forelse($pengumpulans as $pengumpulan)
                <div class="p-6 border-b border-gray-700/50 hover:bg-gray-700/30 transition-colors">
                    <div class="flex flex-col md:flex-row justify-between md:items-center gap-4">
                        <div class="flex-grow">
                            <div class="flex items-center gap-4 mb-3">
                                <div class="w-10 h-10 bg-teal-500 rounded-full flex items-center justify-center text-black font-semibold">
                                    {{ substr($pengumpulan->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="font-semibold text-white">{{ $pengumpulan->user->name }}</h4>
                                    <p class="text-sm text-gray-400">{{ $pengumpulan->user->email }}</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                <div>
                                    <span class="text-gray-400">Cluster:</span>
                                    <span class="text-white font-medium">{{ $pengumpulan->user->kelompok->nama ?? 'Belum ada kelompok' }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-400">Dikumpulkan:</span>
                                    <span class="text-white font-medium">{{ $pengumpulan->submitted_at ? $pengumpulan->submitted_at->format('d M Y, H:i') : '-' }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-400">Status:</span>
                                    <span class="status-badge status-{{ strtolower($pengumpulan->status) }}">
                                        {{ ucfirst($pengumpulan->status) }}
                                    </span>
                                </div>
                                <div>
                                    <span class="text-gray-400">Nilai:</span>
                                    <span class="text-white font-medium">{{ $pengumpulan->nilai ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex gap-2">
                            @if($pengumpulan->file_path)
                                <a href="{{ asset('storage/' . $pengumpulan->file_path) }}" target="_blank"
                                   class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-400 text-black px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Download
                                </a>
                            @endif
                            <a href="{{ route('spv.tugas.pengumpulan.show', $pengumpulan->id) }}"
                               class="inline-flex items-center gap-2 bg-teal-500 hover:bg-teal-400 text-black px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Review
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <h3 class="font-kanit text-xl font-semibold text-white mb-2">Belum Ada Pengumpulan</h3>
                    <p class="text-gray-400">Belum ada mahasiswa yang mengumpulkan tugas ini.</p>
                </div>
                @endforelse
            </div>
            
            @if($pengumpulans->hasPages())
            <div class="p-6 border-t border-gray-700">
                {{ $pengumpulans->links() }}
            </div>
            @endif
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
