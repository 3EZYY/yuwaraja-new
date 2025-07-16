@extends('layouts.app')

@section('content')
<div class="py-12 min-h-screen relative overflow-hidden" style="background: linear-gradient(135deg, #0b101a 0%, #1a1f2e 50%, #0f1419 100%);">
    <!-- Enhanced Background Elements -->
    <div class="absolute inset-0 opacity-10">
        <div class="cyber-grid"></div>
        <div class="floating-particles"></div>
    </div>
    
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 relative z-10">
        <!-- Header Section with Modern Design -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-orbitron font-bold text-transparent bg-gradient-to-r from-cyan-400 via-yellow-400 to-pink-400 bg-clip-text mb-4 animate-pulse-glow">
                ANNOUNCEMENT CENTER
            </h1>
            <p class="text-cyan-300 font-mono text-lg opacity-80">// Access important announcements and updates</p>
            <div class="w-32 h-1 bg-gradient-to-r from-cyan-400 to-yellow-400 mx-auto mt-4 rounded-full animate-pulse"></div>
        </div>
        
        <div class="bg-gray-900/80 backdrop-blur-lg shadow-2xl rounded-3xl mb-8 border border-cyan-500/30 hover:border-cyan-400/50 transition-all duration-500 cyber-card-modern">
            <div class="p-8 md:p-12">
                <!-- Header Section -->
                <div class="mb-8">
                    <div class="border-l-4 border-cyan-400 pl-4">
                        <h1 class="text-3xl font-bold text-white text-glow-cyan mb-2">
                            📢 PENGUMUMAN
                        </h1>
                        <p class="text-gray-400">
                            Informasi dan pengumuman penting untuk mahasiswa
                        </p>
                    </div>
                </div>

                <!-- Announcements Section -->
                <div class="mb-8">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-3xl font-orbitron font-bold text-yellow-400 text-glow-yellow flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                            </svg>
                            ACTIVE ANNOUNCEMENTS
                        </h2>
                        <div class="text-cyan-400 font-mono text-sm">
                            <span class="animate-pulse">●</span> {{ $pengumuman->count() }} announcements available
                        </div>
                    </div>
                
                    @if($pengumuman->isEmpty())
                    <div class="text-center py-16">
                        <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-gray-700 to-gray-800 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                            </svg>
                        </div>
                        <p class="text-gray-400 text-xl font-mono">No active announcements found</p>
                        <p class="text-gray-500 text-sm mt-2">Check back later for new updates</p>
                    </div>
                    @else
                    <div class="grid gap-8 md:grid-cols-1 lg:grid-cols-2">
                        @foreach($pengumuman as $item)
                        <div class="group relative cyber-card-item p-6 floating-animation cursor-pointer" style="animation-delay: {{ $loop->index * 0.1 }}s;" onclick="window.location.href='{{ route('mahasiswa.pengumuman.detail', $item->id) }}'">
                            <!-- Enhanced Card Glow Effect -->
                            <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/10 to-yellow-500/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            
                            <!-- Announcement Header -->
                            <div class="relative z-10">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1">
                                        <a href="{{ route('mahasiswa.pengumuman.detail', $item->id) }}" class="block group-hover:scale-105 transition-transform duration-300">
                                            <h3 class="text-xl font-orbitron font-bold text-cyan-400 group-hover:text-yellow-400 transition-colors duration-300 mb-2 text-glow-cyan hover:animate-pulse-glow">
                                                {{ $item->judul }}
                                            </h3>
                                        </a>
                                        
                                        <!-- Announcement Type Badge -->
                                        <div class="flex items-center space-x-3 mb-3">
                                            <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full border transition-all duration-300 bg-cyan-500/20 text-cyan-400 border-cyan-400/50 group-hover:bg-cyan-500/30">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                                </svg>
                                                ANNOUNCEMENT
                                            </span>
                                        </div>
                                        
                                        <!-- Date Info -->
                                        <div class="flex items-center text-sm text-gray-400 font-mono">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Published: <span class="text-yellow-400 font-bold">{{ $item->created_at->format('d M Y') }}</span></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Content Preview -->
                                <div class="mb-4">
                                    <p class="text-gray-400 text-sm leading-relaxed">{{ Str::limit($item->isi ?? $item->konten ?? 'Tidak ada konten tersedia', 120) }}</p>
                                </div>
                                
                                <!-- Action Button -->
                                <div class="mt-4 pt-4 border-t border-gray-700/50">
                                    <a href="{{ route('mahasiswa.pengumuman.detail', $item->id) }}" class="cyber-btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-400 hover:to-blue-400 text-white font-bold rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-cyan-500/25 group-hover:scale-105">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>
                                        READ ANNOUNCEMENT
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    
                    <!-- Pagination -->
                    <div class="mt-12 flex justify-center">
                        {{ $pengumuman->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --db-bg: #0b101a;
        --db-surface: rgba(24, 24, 37, 0.8);
        --db-primary: #00d1ff;
        --db-secondary: #ffc900;
        --db-text: #c0c8d6;
        --db-heading: #ffffff;
        --db-border: rgba(0, 209, 255, 0.15);
        --db-glow: rgba(0, 209, 255, 0.4);
    }
    
    body {
        background: linear-gradient(135deg, #0b101a 0%, #1a1f2e 50%, #0f1419 100%) !important;
        min-height: 100vh;
    }
    
    .text-glow-cyan {
        text-shadow: 0 0 12px rgba(0, 209, 255, 0.8), 0 0 24px rgba(0, 209, 255, 0.4);
    }
    
    .text-glow-yellow {
        text-shadow: 0 0 12px rgba(255, 201, 0, 0.8), 0 0 24px rgba(255, 201, 0, 0.4);
    }
    
    .cyber-card {
        background: linear-gradient(135deg, rgba(24, 24, 37, 0.9) 0%, rgba(31, 41, 55, 0.8) 100%);
        backdrop-filter: blur(20px);
        border: 1px solid var(--db-border);
        border-radius: 1rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    }
    
    .cyber-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, 
            rgba(0, 209, 255, 0.1) 0%, 
            rgba(255, 201, 0, 0.05) 50%, 
            rgba(0, 209, 255, 0.1) 100%);
        opacity: 0;
        transition: all 0.4s ease;
        border-radius: 1rem;
    }
    
    .cyber-card::after {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(45deg, var(--db-primary), var(--db-secondary), var(--db-primary));
        border-radius: 1rem;
        z-index: -1;
        opacity: 0;
        transition: all 0.4s ease;
    }
    
    .cyber-card:hover {
        transform: translateY(-8px) scale(1.02);
        border-color: var(--db-primary);
        box-shadow: 
            0 20px 40px rgba(0, 0, 0, 0.4),
            0 0 40px rgba(0, 209, 255, 0.2),
            inset 0 1px 0 rgba(255, 255, 255, 0.1);
    }
    
    .cyber-card:hover::before {
        opacity: 1;
    }
    
    .cyber-card:hover::after {
        opacity: 0.6;
    }
    
    .cyber-card-item {
        background: linear-gradient(135deg, rgba(24, 24, 37, 0.95) 0%, rgba(31, 41, 55, 0.9) 100%);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(0, 209, 255, 0.2);
        border-radius: 0.75rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
    }
    
    .cyber-card-item:hover {
        transform: translateY(-6px);
        border-color: rgba(0, 209, 255, 0.6);
        box-shadow: 
            0 12px 30px rgba(0, 0, 0, 0.4),
            0 0 30px rgba(0, 209, 255, 0.15);
    }
    
    .cyber-card-modern {
        background: linear-gradient(135deg, rgba(24, 24, 37, 0.9) 0%, rgba(31, 41, 55, 0.8) 100%);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(0, 209, 255, 0.3);
        border-radius: 1.5rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    }
    
    .cyber-card-modern:hover {
        transform: translateY(-4px);
        border-color: rgba(0, 209, 255, 0.6);
        box-shadow: 
            0 16px 40px rgba(0, 0, 0, 0.4),
            0 0 40px rgba(0, 209, 255, 0.2);
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .floating-animation {
        animation: float 6s ease-in-out infinite;
    }
    
    @keyframes pulse-glow {
        0%, 100% { text-shadow: 0 0 12px rgba(0, 209, 255, 0.8), 0 0 24px rgba(0, 209, 255, 0.4); }
        50% { text-shadow: 0 0 20px rgba(0, 209, 255, 1), 0 0 40px rgba(0, 209, 255, 0.6); }
    }
    
    .animate-pulse-glow {
        animation: pulse-glow 2s ease-in-out infinite;
    }
    
    .cyber-btn {
        position: relative;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .cyber-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }
    
    .cyber-btn:hover::before {
        left: 100%;
    }
    
    .cyber-btn:hover {
        box-shadow: 
            0 0 20px rgba(0, 209, 255, 0.5),
            0 0 40px rgba(0, 209, 255, 0.3),
            0 0 60px rgba(0, 209, 255, 0.1);
    }
</style>
@endsection
