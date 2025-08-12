@extends('layouts.app')

@section('content')
{{-- CSS Kustom dengan Glass Card Effect seperti SPV --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@600;700;900&display=swap');

    :root {
        --bg-main: #0a0a0a;
        --surface-card: #111827;
        --surface-elevated: rgba(30, 41, 59, 0.9);
        --border-primary: rgba(20, 184, 166, 0.25);
        --border-secondary: rgba(148, 163, 184, 0.2);
        --accent-cyan: #14b8a6;
        --accent-blue: #f59e0b;
        --accent-red: #ef4444;
        --text-primary: #d1d5db;
        --text-secondary: #6b7280;
        --text-muted: #9ca3af;
    }

    body {
        background-color: var(--bg-main) !important;
        font-family: 'Inter', sans-serif;
        color: var(--text-primary);
        min-height: 100vh;
    }
    
    .font-display {
        font-family: 'Poppins', sans-serif;
    }

    .glass-card {
        background: var(--surface-card);
        backdrop-filter: blur(20px);
        border: 1px solid var(--border-primary);
        border-radius: 1rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .glass-card:hover {
        border-color: var(--accent-blue);
        box-shadow: 0 25px 50px -12px rgba(245, 158, 11, 0.25);
        transform: translateY(-2px);
    }

    .glass-elevated {
        background: var(--surface-elevated);
        backdrop-filter: blur(24px);
        border: 1px solid var(--border-secondary);
        border-radius: 0.75rem;
    }

    .animate-fade-in {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .animate-fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .type-badge {
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .type-penting {
        background: rgba(239, 68, 68, 0.15);
        color: #fca5a5;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .type-umum {
        background: rgba(34, 211, 238, 0.15);
        color: #67e8f9;
        border: 1px solid rgba(34, 211, 238, 0.3);
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--accent-cyan), var(--accent-blue));
        color: #0f172a;
        font-weight: 600;
        padding: 0.875rem 2rem;
        border-radius: 0.75rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        box-shadow: 0 10px 25px -5px rgba(20, 184, 166, 0.3);
    }
    
    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 40px -5px rgba(20, 184, 166, 0.4);
        color: #0f172a;
        text-decoration: none;
    }

    .meta-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-muted);
        font-size: 0.875rem;
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
        background-color: rgba(15, 23, 42, 0.8);
        color: var(--accent-cyan);
        border: 1px solid var(--border-secondary);
        transition: all 0.2s ease-in-out;
    }

    .pagination li a:hover {
        background-color: rgba(20, 184, 166, 0.2);
        border-color: var(--accent-cyan);
        color: white;
    }

    .pagination li.active span {
        background-color: var(--accent-cyan);
        border-color: var(--accent-cyan);
        color: #0f172a;
        cursor: default;
    }

    .pagination li.disabled span {
        background-color: rgba(15, 23, 42, 0.2);
        color: var(--text-secondary);
        cursor: not-allowed;
    }

    @media (max-width: 768px) {
        .glass-card {
            margin: 1rem;
            border-radius: 0.75rem;
        }
        
        .btn-primary {
            padding: 0.75rem 1.5rem;
            font-size: 0.875rem;
        }
    }
</style>

<div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto space-y-8">
        
        <!-- Header -->
        <div class="glass-card p-6 md:p-8 animate-fade-in">
            <div class="flex items-center gap-4">
                <span class="text-4xl">📢</span>
                <div>
                    <h1 class="font-display text-3xl md:text-4xl font-bold text-white mb-2">Pusat Informasi</h1>
                    <p class="text-gray-400 text-sm md:text-base">Akses pengumuman & pembaruan penting untuk seluruh mahasiswa</p>
                </div>
            </div>
        </div>

        <!-- Daftar Pengumuman -->
        <div class="space-y-6">
            @forelse($pengumuman as $item)
            <div class="glass-card p-6 md:p-8 animate-fade-in">
                <!-- Type Badge -->
                <div class="mb-4">
                    @if($item->tipe === 'penting')
                        <span class="type-badge type-penting">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-2.694-.833-3.464 0L3.35 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                            Penting
                        </span>
                    @else
                        <span class="type-badge type-umum">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Umum
                        </span>
                    @endif
                </div>

                <!-- Title and Content -->
                <div class="border-b border-slate-700/50 pb-6 mb-6">
                    <h2 class="font-display text-2xl md:text-3xl font-bold text-white mb-4 leading-tight">{{ $item->judul }}</h2>
                    
                    <div class="flex flex-col sm:flex-row gap-4 sm:gap-8 mb-4">
                        <div class="meta-info">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>{{ ($item->published_at ?? $item->created_at)->format('d F Y, H:i') }}</span>
                        </div>
                        <div class="meta-info">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span>Admin YUWARAJA XVII</span>
                        </div>
                    </div>
                    
                    <p class="text-white leading-relaxed text-lg">
                        {{ Str::limit(strip_tags($item->isi ?? $item->konten ?? 'Tidak ada konten tersedia'), 200) }}
                    </p>
                </div>

                <!-- Action Section -->
                <div class="flex justify-end">
                    <a href="{{ route('mahasiswa.pengumuman.detail', $item->id) }}" class="btn-primary">
                        <span>Lihat Detail</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="glass-card p-12 text-center animate-fade-in">
                <div class="flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-slate-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="text-xl font-bold text-white mb-2">Belum Ada Pengumuman</h3>
                    <p class="text-gray-400">Pengumuman akan muncul di sini ketika tersedia.</p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($pengumuman->hasPages())
        <div class="glass-card p-6 animate-fade-in">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-sm text-gray-400">
                    Menampilkan {{ $pengumuman->firstItem() ?? 0 }} - {{ $pengumuman->lastItem() ?? 0 }} dari {{ $pengumuman->total() }} pengumuman
                </div>
                
                <div class="flex items-center space-x-2">
                    {{-- Previous Page Link --}}
                    @if ($pengumuman->onFirstPage())
                        <span class="px-3 py-2 text-sm font-medium text-gray-500 bg-gray-800/50 border border-gray-700/50 rounded-lg cursor-not-allowed">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </span>
                    @else
                        <a href="{{ $pengumuman->previousPageUrl() }}" class="px-3 py-2 text-sm font-medium text-white bg-gray-800/50 border border-gray-700/50 rounded-lg hover:bg-teal-600/20 hover:border-teal-500/50 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($pengumuman->getUrlRange(1, $pengumuman->lastPage()) as $page => $url)
                        @if ($page == $pengumuman->currentPage())
                            <span class="px-3 py-2 text-sm font-medium text-gray-900 bg-teal-400 border border-teal-400 rounded-lg font-bold">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-2 text-sm font-medium text-white bg-gray-800/50 border border-gray-700/50 rounded-lg hover:bg-teal-600/20 hover:border-teal-500/50 transition-all duration-300">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($pengumuman->hasMorePages())
                        <a href="{{ $pengumuman->nextPageUrl() }}" class="px-3 py-2 text-sm font-medium text-white bg-gray-800/50 border border-gray-700/50 rounded-lg hover:bg-teal-600/20 hover:border-teal-500/50 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @else
                        <span class="px-3 py-2 text-sm font-medium text-gray-500 bg-gray-800/50 border border-gray-700/50 rounded-lg cursor-not-allowed">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Intersection Observer for animations
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { 
            threshold: 0.1,
            rootMargin: '50px'
        });
        
        const elements = document.querySelectorAll('.animate-fade-in');
        elements.forEach(el => observer.observe(el));
    });
</script>
@endsection