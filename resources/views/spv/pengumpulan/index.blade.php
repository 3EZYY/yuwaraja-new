@extends('layouts.app')

@section('title', 'Pengumpulan Tugas')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;400;500;600;700&display=swap');
    
    * {
        font-family: 'Rajdhani', sans-serif;
    }
    
    .font-orbitron {
        font-family: 'Orbitron', monospace;
    }
    
    body {
        background: linear-gradient(135deg, #0A0F1A 0%, #1A1F2E 50%, #0A0F1A 100%);
        min-height: 100vh;
    }
    
    .cyber-card {
        background: linear-gradient(145deg, rgba(15, 23, 42, 0.8), rgba(30, 41, 59, 0.6));
        border: 1px solid rgba(34, 211, 238, 0.3);
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
    }
    
    .cyber-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, #22d3ee, transparent);
        animation: scan 3s infinite;
    }
    
    @keyframes scan {
        0% { left: -100%; }
        100% { left: 100%; }
    }
    
    .cyber-button {
        background: linear-gradient(145deg, rgba(34, 211, 238, 0.1), rgba(6, 182, 212, 0.2));
        border: 1px solid rgba(34, 211, 238, 0.5);
        color: #22d3ee;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .cyber-button:hover {
        background: linear-gradient(145deg, rgba(34, 211, 238, 0.2), rgba(6, 182, 212, 0.3));
        border-color: #22d3ee;
        box-shadow: 0 0 20px rgba(34, 211, 238, 0.3);
        transform: translateY(-2px);
    }
    
    .cyber-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(34, 211, 238, 0.2), transparent);
        transition: left 0.5s;
    }
    
    .cyber-button:hover::before {
        left: 100%;
    }
    
    .glow-text {
        text-shadow: 0 0 10px rgba(34, 211, 238, 0.5);
    }
    
    .scroll-reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }
    
    .scroll-reveal.revealed {
        opacity: 1;
        transform: translateY(0);
    }
    
    .status-submitted {
        background: linear-gradient(145deg, rgba(245, 158, 11, 0.2), rgba(217, 119, 6, 0.1));
        border-color: rgba(245, 158, 11, 0.5);
        color: #f59e0b;
    }
    
    .status-reviewed {
        background: linear-gradient(145deg, rgba(59, 130, 246, 0.2), rgba(37, 99, 235, 0.1));
        border-color: rgba(59, 130, 246, 0.5);
        color: #3b82f6;
    }
    
    .status-approved {
        background: linear-gradient(145deg, rgba(16, 185, 129, 0.2), rgba(5, 150, 105, 0.1));
        border-color: rgba(16, 185, 129, 0.5);
        color: #10b981;
    }
    
    .status-done {
        background: linear-gradient(145deg, rgba(34, 211, 238, 0.2), rgba(6, 182, 212, 0.1));
        border-color: rgba(34, 211, 238, 0.5);
        color: #22d3ee;
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 p-6">
    <!-- Header Section -->
    <div class="cyber-card rounded-xl p-6 mb-8 scroll-reveal">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white font-orbitron glow-text mb-2">
                    📋 PENGUMPULAN TUGAS
                </h1>
                <p class="text-cyan-400/70">Review dan evaluasi pengumpulan tugas mahasiswa</p>
            </div>
            <div class="text-right">
                <div class="text-2xl font-bold text-cyan-400 font-orbitron">{{ $pengumpulans->total() }}</div>
                <div class="text-sm text-cyan-400/70">Total Pengumpulan</div>
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="cyber-card rounded-xl p-6 mb-8 scroll-reveal">
        <div class="flex flex-wrap gap-4">
            <select class="bg-slate-800/50 border border-cyan-400/30 text-white rounded-lg px-4 py-2 focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20">
                <option value="">Semua Status</option>
                <option value="submitted">Submitted</option>
                <option value="reviewed">Reviewed</option>
                <option value="approved">Approved</option>
                <option value="done">Done</option>
            </select>
            
            <select class="bg-slate-800/50 border border-cyan-400/30 text-white rounded-lg px-4 py-2 focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20">
                <option value="">Semua Tugas</option>
                @foreach($pengumpulans->pluck('tugas')->unique('id') as $tugas)
                <option value="{{ $tugas->id }}">{{ $tugas->judul }}</option>
                @endforeach
            </select>
            
            <button class="cyber-button px-6 py-2 rounded-lg font-semibold">
                <span class="relative z-10">Filter</span>
            </button>
        </div>
    </div>

    <!-- Pengumpulan List -->
    <div class="space-y-6">
        @forelse($pengumpulans as $index => $pengumpulan)
        <div class="cyber-card rounded-xl p-6 scroll-reveal hover:scale-[1.02] transition-all duration-300" 
             style="animation-delay: {{ $index * 0.1 }}s">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-3">
                        <h3 class="text-xl font-bold text-white font-orbitron">{{ $pengumpulan->tugas->judul }}</h3>
                        <span class="status-{{ $pengumpulan->status }} px-3 py-1 text-xs font-semibold rounded-full border">
                            @switch($pengumpulan->status)
                                @case('submitted')
                                    📤 SUBMITTED
                                    @break
                                @case('reviewed')
                                    👁️ REVIEWED
                                    @break
                                @case('approved')
                                    ✅ APPROVED
                                    @break
                                @case('done')
                                    🎉 DONE
                                    @break
                                @default
                                    📋 {{ strtoupper($pengumpulan->status) }}
                            @endswitch
                        </span>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div class="bg-slate-800/30 rounded-lg p-3">
                            <div class="text-sm text-cyan-400/70 mb-1">Mahasiswa</div>
                            <div class="text-white font-semibold">{{ $pengumpulan->user->name }}</div>
                            <div class="text-xs text-gray-400">{{ $pengumpulan->user->nim }}</div>
                        </div>
                        
                        <div class="bg-slate-800/30 rounded-lg p-3">
                            <div class="text-sm text-cyan-400/70 mb-1">Tanggal Pengumpulan</div>
                            <div class="text-white font-semibold">{{ $pengumpulan->created_at->format('d M Y') }}</div>
                            <div class="text-xs text-gray-400">{{ $pengumpulan->created_at->format('H:i') }}</div>
                        </div>
                        
                        <div class="bg-slate-800/30 rounded-lg p-3">
                            <div class="text-sm text-cyan-400/70 mb-1">Nilai</div>
                            <div class="text-white font-semibold">
                                @if($pengumpulan->nilai)
                                    {{ $pengumpulan->nilai }}/100
                                @else
                                    <span class="text-gray-400">Belum dinilai</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    @if($pengumpulan->keterangan)
                    <div class="bg-slate-800/30 rounded-lg p-3 mb-4">
                        <div class="text-sm text-cyan-400/70 mb-1">Keterangan</div>
                        <div class="text-gray-300">{{ $pengumpulan->keterangan }}</div>
                    </div>
                    @endif
                    
                    @if($pengumpulan->file_path)
                    <div class="flex items-center gap-2 text-sm text-cyan-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        <a href="{{ asset('storage/' . $pengumpulan->file_path) }}" target="_blank" class="hover:text-cyan-300">
                            Download File Pengumpulan
                        </a>
                    </div>
                    @endif
                </div>
                
                <div class="flex flex-col gap-2 ml-6">
                    <a href="{{ route('spv.tugas.show', $pengumpulan->id) }}" 
                       class="cyber-button px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-300 hover:scale-105">
                        <span class="relative z-10 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                            </svg>
                            Review
                        </span>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="cyber-card rounded-xl p-12 text-center scroll-reveal">
            <div class="text-6xl mb-4">📋</div>
            <h3 class="text-xl font-bold text-white font-orbitron mb-2">Belum Ada Pengumpulan</h3>
            <p class="text-gray-400">Pengumpulan tugas akan muncul di sini ketika mahasiswa mengumpulkan tugas</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($pengumpulans->hasPages())
    <div class="mt-8 flex justify-center">
        <div class="cyber-card rounded-xl p-4">
            {{ $pengumpulans->links() }}
        </div>
    </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll reveal animation
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.scroll-reveal').forEach(el => {
        observer.observe(el);
    });
});
</script>
@endsection