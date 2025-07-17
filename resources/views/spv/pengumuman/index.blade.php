@extends('layouts.app')

@section('title', 'Pengumuman')

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
    
    .priority-high {
        border-left: 4px solid #ef4444;
        background: linear-gradient(145deg, rgba(239, 68, 68, 0.1), rgba(220, 38, 38, 0.05));
    }
    
    .priority-medium {
        border-left: 4px solid #f59e0b;
        background: linear-gradient(145deg, rgba(245, 158, 11, 0.1), rgba(217, 119, 6, 0.05));
    }
    
    .priority-low {
        border-left: 4px solid #10b981;
        background: linear-gradient(145deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.05));
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 p-6">
    <!-- Header Section -->
    <div class="cyber-card rounded-xl p-6 mb-8 scroll-reveal">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-white font-orbitron glow-text mb-2">
                    📢 PENGUMUMAN
                </h1>
                <p class="text-cyan-400/70">Kelola dan pantau semua pengumuman untuk mahasiswa</p>
            </div>
            <div class="text-right">
                <div class="text-2xl font-bold text-cyan-400 font-orbitron">{{ $pengumuman->total() }}</div>
                <div class="text-sm text-cyan-400/70">Total Pengumuman</div>
            </div>
        </div>
    </div>

    <!-- Pengumuman List -->
    <div class="space-y-6">
        @forelse($pengumuman as $index => $item)
        <div class="cyber-card rounded-xl p-6 scroll-reveal hover:scale-[1.02] transition-all duration-300" 
             style="animation-delay: {{ $index * 0.1 }}s">
            <div class="flex items-start justify-between mb-4">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-3">
                        <h3 class="text-xl font-bold text-white font-orbitron">{{ $item->judul }}</h3>
                        @if($item->prioritas === 'tinggi')
                            <span class="px-3 py-1 bg-red-500/20 text-red-400 text-xs font-semibold rounded-full border border-red-500/30">
                                🔥 PRIORITAS TINGGI
                            </span>
                        @elseif($item->prioritas === 'sedang')
                            <span class="px-3 py-1 bg-yellow-500/20 text-yellow-400 text-xs font-semibold rounded-full border border-yellow-500/30">
                                ⚡ PRIORITAS SEDANG
                            </span>
                        @else
                            <span class="px-3 py-1 bg-green-500/20 text-green-400 text-xs font-semibold rounded-full border border-green-500/30">
                                ✅ PRIORITAS RENDAH
                            </span>
                        @endif
                    </div>
                    
                    <p class="text-gray-300 mb-4 leading-relaxed">
                        {{ Str::limit($item->konten, 200) }}
                    </p>
                    
                    <div class="flex items-center gap-6 text-sm text-cyan-400/70">
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                            {{ $item->created_at->format('d M Y, H:i') }}
                        </div>
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            {{ $item->penulis ?? 'Admin' }}
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-col gap-2 ml-6">
                    <a href="{{ route('spv.pengumuman.detail', $item) }}" 
                       class="cyber-button px-4 py-2 rounded-lg text-sm font-semibold transition-all duration-300 hover:scale-105">
                        <span class="relative z-10 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                            </svg>
                            Lihat Detail
                        </span>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="cyber-card rounded-xl p-12 text-center scroll-reveal">
            <div class="text-6xl mb-4">📭</div>
            <h3 class="text-xl font-bold text-white font-orbitron mb-2">Belum Ada Pengumuman</h3>
            <p class="text-gray-400">Pengumuman akan muncul di sini ketika tersedia</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($pengumuman->hasPages())
    <div class="mt-8 flex justify-center">
        <div class="cyber-card rounded-xl p-4">
            {{ $pengumuman->links() }}
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