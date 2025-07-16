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
                MISSION CONTROL
            </h1>
            <p class="text-cyan-300 font-mono text-lg opacity-80">// Access your assigned tasks and submit your work</p>
            <div class="w-32 h-1 bg-gradient-to-r from-cyan-400 to-yellow-400 mx-auto mt-4 rounded-full animate-pulse"></div>
        </div>
        
        <div class="bg-gray-900/80 backdrop-blur-lg shadow-2xl rounded-3xl mb-8 border border-cyan-500/30 hover:border-cyan-400/50 transition-all duration-500 cyber-card-modern">
            <div class="p-8 md:p-12">
                @if(isset($listMode) && $listMode && isset($tugas))
                {{-- LIST PENUGASAN --}}
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-3xl font-orbitron font-bold text-yellow-400 text-glow-yellow flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        ACTIVE MISSIONS
                    </h2>
                    <div class="text-cyan-400 font-mono text-sm">
                        <span class="animate-pulse">●</span> {{ $tugas->count() }} tasks available
                    </div>
                </div>
                @if($tugas->isEmpty())
                <div class="text-center py-16">
                    <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-gray-700 to-gray-800 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2 2v-5m16 0h-2M4 13h2" />
                        </svg>
                    </div>
                    <p class="text-gray-400 text-xl font-mono">No active missions found</p>
                    <p class="text-gray-500 text-sm mt-2">Check back later for new assignments</p>
                </div>
                @else
                <div class="grid gap-8 md:grid-cols-1 lg:grid-cols-2">
                    @foreach($tugas as $item)
                    <div class="group relative cyber-card-item p-6 floating-animation cursor-pointer" style="animation-delay: {{ $loop->index * 0.1 }}s;" onclick="window.location.href='{{ route('mahasiswa.tugas.show', $item->id) }}'">
                        <!-- Enhanced Card Glow Effect -->
                        <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/10 to-yellow-500/10 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        <!-- Mission Header -->
                        <div class="relative z-10">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <a href="{{ route('mahasiswa.tugas.show', $item->id) }}" class="block group-hover:scale-105 transition-transform duration-300">
                                        <h3 class="text-xl font-orbitron font-bold text-cyan-400 group-hover:text-yellow-400 transition-colors duration-300 mb-2 text-glow-cyan hover:animate-pulse-glow">
                                            {{ $item->judul }}
                                        </h3>
                                    </a>
                                    
                                    <!-- Mission Type Badge -->
                                    <div class="flex items-center space-x-3 mb-3">
                                        <span class="inline-flex items-center px-3 py-1 text-xs font-bold rounded-full border transition-all duration-300
                                            {{ $item->tipe == 'kelompok'
                                                ? 'bg-cyan-500/20 text-cyan-400 border-cyan-400/50 group-hover:bg-cyan-500/30'
                                                : 'bg-yellow-500/20 text-yellow-400 border-yellow-400/50 group-hover:bg-yellow-500/30' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                @if($item->tipe == 'kelompok')
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                @endif
                                            </svg>
                                            {{ strtoupper($item->tipe) }}
                                        </span>
                                    </div>
                                    
                                    <!-- Deadline Info -->
                                    <div class="flex items-center text-sm text-gray-400 font-mono">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Due: <span class="text-yellow-400 font-bold">{{ \Carbon\Carbon::parse($item->deadline)->format('d M Y') }}</span></span>
                                    </div>
                                </div>
                                
                                <!-- Status Badge -->
                                <div class="ml-4">
                                    @php $pengumpulan = $pengumpulanTugas[$item->id] ?? null; @endphp
                                    @if($pengumpulan)
                                    <span class="inline-flex items-center px-3 py-2 text-xs font-bold rounded-full border transition-all duration-300
                                        @if($pengumpulan->status == 'submitted') bg-yellow-500/20 text-yellow-400 border-yellow-400/50 hover:bg-yellow-500/30
                                        @elseif($pengumpulan->status == 'approved') bg-green-500/20 text-green-400 border-green-400/50 hover:bg-green-500/30
                                        @elseif($pengumpulan->status == 'rejected') bg-red-500/20 text-red-400 border-red-400/50 hover:bg-red-500/30
                                        @else bg-gray-500/20 text-gray-400 border-gray-400/50 hover:bg-gray-500/30
                                        @endif">
                                        @if($pengumpulan->status == 'submitted')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            SUBMITTED
                                        @elseif($pengumpulan->status == 'approved')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            APPROVED
                                        @elseif($pengumpulan->status == 'rejected')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            REJECTED
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            DRAFT
                                        @endif
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-3 py-2 text-xs font-bold rounded-full border bg-red-500/20 text-red-400 border-red-400/50 hover:bg-red-500/30 transition-all duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                        </svg>
                                        PENDING
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Action Button -->
                            <div class="mt-4 pt-4 border-t border-gray-700/50">
                                <a href="{{ route('mahasiswa.tugas.show', $item->id) }}" class="cyber-btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-400 hover:to-blue-400 text-white font-bold rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-cyan-500/25 group-hover:scale-105">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                    ACCESS MISSION
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
                @elseif(isset($detailMode) && $detailMode && isset($tugas))
                {{-- DETAIL PENUGASAN --}}
                <h1 class="text-3xl font-bold mb-6 text-cyan-400 tracking-wide">Detail Tugas</h1>
                <div class="mb-6 space-y-2">
                    <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
                        <span class="font-bold text-cyan-300">Judul:</span>
                        <span class="text-white text-lg">{{ $tugas->judul }}</span>
                    </div>
                    <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
                        <span class="font-bold text-cyan-300">Deskripsi:</span>
                        <span class="bg-gray-900 text-gray-200 rounded px-3 py-2 w-full">{!! nl2br(e($tugas->deskripsi)) !!}</span>
                    </div>
                    <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
                        <span class="font-bold text-cyan-300">Deadline:</span>
                        <span class="text-yellow-300">{{ $tugas->deadline->format('d M Y, H:i') }}</span>
                    </div>
                    @if($tugas->file_path)
                    <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
                        <span class="font-bold text-cyan-300">File Tugas:</span>
                        <a href="{{ Storage::url($tugas->file_path) }}" target="_blank" class="text-blue-400 underline hover:text-blue-200 transition">Download</a>
                    </div>
                    @endif
                </div>
                <hr class="my-8 border-cyan-800/40">
                <h2 class="text-2xl font-semibold mb-4 text-cyan-400">Upload Tugas Anda</h2>
                @if(session('success'))
                <div class="bg-green-900/80 border border-green-400 text-green-200 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
                @endif
                @if(session('error'))
                <div class="bg-red-900/80 border border-red-400 text-red-200 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
                @endif
                @if(isset($pengumpulan) && $pengumpulan->file_path)
                <div class="mb-4">
                    <span class="font-semibold text-cyan-300">File yang sudah dikumpulkan:</span>
                    <a href="{{ Storage::url($pengumpulan->file_path) }}" target="_blank" class="text-blue-400 underline hover:text-blue-200">Download File</a>
                    <p class="text-xs text-gray-400 mt-1">Dikumpulkan pada: {{ $pengumpulan->submitted_at ? $pengumpulan->submitted_at->format('d M Y, H:i') : '-' }}</p>
                </div>
                @endif
                @if(now() <= $tugas->deadline)
                    <form action="{{ route('mahasiswa.tugas.submit', $tugas) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div>
                            <label for="file" class="block text-sm font-medium text-cyan-200 mb-2">File Tugas <span class="text-red-400">*</span></label>
                            <input type="file" id="file" name="file" class="block w-full border border-cyan-700 bg-gray-900 text-white rounded px-3 py-2 focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 transition" accept=".pdf,.doc,.docx,.zip,.rar" required>
                            <p class="mt-1 text-xs text-cyan-400">Format: PDF, DOC, DOCX, ZIP, RAR (Max: 10MB)</p>
                            @error('file')
                            <p class="text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="keterangan" class="block text-sm font-medium text-cyan-200 mb-2">Keterangan (Opsional)</label>
                            <textarea id="keterangan" name="keterangan" rows="3" class="block w-full border border-cyan-700 bg-gray-900 text-white rounded px-3 py-2 focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 transition" placeholder="Catatan untuk tugas...">{{ old('keterangan', $pengumpulan->keterangan ?? '') }}</textarea>
                            @error('keterangan')
                            <p class="text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="px-8 py-3 bg-cyan-500 hover:bg-cyan-400 text-black font-bold rounded shadow transition">Kumpulkan Tugas</button>
                    </form>
                    @else
                    <div class="bg-red-900/80 border border-red-400 rounded p-4 mt-4">
                        <p class="text-red-200 font-semibold">Deadline tugas sudah berakhir. Anda tidak dapat mengumpulkan tugas ini.</p>
                    </div>
                    @endif

                    @else
                    <div class="text-center text-gray-500">Tidak ada data tugas.</div>
                    @endif
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
    
    .bg-dashboard-card {
        background: rgba(24, 24, 37, 0.8);
        backdrop-filter: blur(10px);
    }
    
    .text-dashboard-yellow {
        color: #ffc900;
    }
    
    .text-dashboard-cyan {
        color: #00d1ff;
    }
    
    .border-dashboard-cyan {
        border-color: #00d1ff;
    }
    
    .border-dashboard-yellow {
        border-color: #ffc900;
    }
    
    .bg-dashboard-yellow {
        background: #ffc900;
    }
    
    .bg-dashboard-cyan {
        background: #00d1ff;
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