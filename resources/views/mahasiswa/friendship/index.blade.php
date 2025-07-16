@extends('layouts.app')

@section('content')
<style>
    :root {
        --db-bg: #0b101a;
        --db-surface: #181825;
        --db-primary: #00d1ff;
        --db-secondary: #ffc900;
        --db-text: #c0c8d6;
        --db-heading: #ffffff;
        --db-border: rgba(0, 209, 255, 0.15);
    }
    body { background-color: var(--db-bg) !important; }
    .cyber-card {
        background-color: var(--db-surface);
        border: 1px solid var(--db-border);
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }
    .cyber-card:hover {
        transform: translateY(-2px);
        border-color: var(--db-primary);
        box-shadow: 0 0 20px rgba(0, 209, 255, 0.1);
    }
    .friend-card {
        background: linear-gradient(135deg, var(--db-surface) 0%, rgba(0, 209, 255, 0.05) 100%);
        border: 1px solid var(--db-border);
        border-radius: 0.75rem;
        padding: 1.5rem;
        transition: all 0.3s ease;
    }
    .friend-card:hover {
        transform: translateY(-4px);
        border-color: var(--db-primary);
        box-shadow: 0 8px 25px rgba(0, 209, 255, 0.15);
    }
    .btn-friend {
        background: linear-gradient(135deg, var(--db-primary), var(--db-secondary));
        border: none;
        color: #000;
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }
    .btn-friend:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(0, 209, 255, 0.3);
    }
    .btn-friend:disabled {
        background: #666;
        color: #999;
        cursor: not-allowed;
    }
</style>

<div class="py-12" style="background-color: #0b101a;">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="cyber-card p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-white font-orbitron">👥 Anggota Kelompok</h1>
                    <p class="text-gray-400 mt-2">Kelompok: <span class="text-cyan-400 font-semibold">{{ $user->kelompok->nama_kelompok }}</span></p>
                </div>
                <a href="{{ route('mahasiswa.dashboard') }}" class="text-yellow-400 hover:text-yellow-300 transition-colors">
                    ← Kembali ke Dashboard
                </a>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="bg-green-500/20 border border-green-500/50 text-green-400 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500/20 border border-red-500/50 text-red-400 px-4 py-3 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Supervisor Section -->
            @if($supervisor)
            <div class="lg:col-span-3">
                <h2 class="text-xl font-bold text-white mb-4 text-cyan-400">🎯 Supervisor Kelompok</h2>
                <div class="friend-card">
                    <div class="flex items-center space-x-4">
                        @if($supervisor->photo)
                            <img src="{{ asset('storage/profile/' . $supervisor->photo) }}" 
                                 alt="{{ $supervisor->name }}" 
                                 class="w-16 h-16 rounded-full border-2 border-cyan-400">
                        @else
                            <div class="w-16 h-16 rounded-full bg-cyan-400 flex items-center justify-center text-black font-bold text-xl">
                                {{ strtoupper(substr($supervisor->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-white">{{ $supervisor->name }}</h3>
                            <p class="text-gray-400">{{ $supervisor->email }}</p>
                            <span class="inline-block bg-cyan-400/20 text-cyan-400 px-3 py-1 rounded-full text-sm font-semibold mt-2">
                                Supervisor
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Members Section -->
            <div class="lg:col-span-3">
                <h2 class="text-xl font-bold text-white mb-4 text-yellow-400">👨‍👩‍👧‍👦 Anggota Kelompok</h2>
                
                @if($kelompokMembers->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($kelompokMembers as $member)
                        <div class="friend-card">
                            <div class="text-center">
                                @if($member->photo)
                                    <img src="{{ asset('storage/profile/' . $member->photo) }}" 
                                         alt="{{ $member->name }}" 
                                         class="w-20 h-20 rounded-full border-2 border-yellow-400 mx-auto mb-4">
                                @else
                                    <div class="w-20 h-20 rounded-full bg-yellow-400 flex items-center justify-center text-black font-bold text-xl mx-auto mb-4">
                                        {{ strtoupper(substr($member->name, 0, 1)) }}
                                    </div>
                                @endif
                                
                                <h3 class="text-lg font-bold text-white mb-1">{{ $member->name }}</h3>
                                <p class="text-gray-400 text-sm mb-2">{{ $member->nim }}</p>
                                <p class="text-gray-500 text-xs mb-4">{{ $member->program_studi }}</p>
                                
                                <!-- Status Pertemanan -->
                                @if($user->isFriendWith($member->id))
                                    <div class="flex flex-col space-y-2">
                                        <span class="inline-block bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-sm font-semibold">
                                            ✓ Sudah Berteman
                                        </span>
                                        <form action="{{ route('mahasiswa.friendship.remove', $member->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300 text-xs" 
                                                    onclick="return confirm('Yakin ingin menghapus pertemanan?')">
                                                Hapus Pertemanan
                                            </button>
                                        </form>
                                    </div>
                                @elseif($user->hasFriendshipRequestWith($member->id))
                                    <span class="inline-block bg-yellow-500/20 text-yellow-400 px-3 py-1 rounded-full text-sm font-semibold">
                                        ⏳ Permintaan Terkirim
                                    </span>
                                @else
                                    <form action="{{ route('mahasiswa.friendship.send') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="friend_id" value="{{ $member->id }}">
                                        <button type="submit" class="btn-friend w-full">
                                            👋 Berteman
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="cyber-card p-8 text-center">
                        <p class="text-gray-400 text-lg">Belum ada anggota lain di kelompok ini.</p>
                    </div>
                @endif
            </div>

            <!-- Friends List Section -->
            @if($friends->count() > 0)
            <div class="lg:col-span-3 mt-8">
                <h2 class="text-xl font-bold text-white mb-4 text-green-400">💚 Daftar Teman</h2>
                <div class="cyber-card p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        @foreach($friends as $friend)
                        <div class="flex items-center space-x-3 p-3 bg-green-500/10 rounded-lg border border-green-500/20">
                            @if($friend->photo)
                                <img src="{{ asset('storage/profile/' . $friend->photo) }}" 
                                     alt="{{ $friend->name }}" 
                                     class="w-10 h-10 rounded-full border border-green-400">
                            @else
                                <div class="w-10 h-10 rounded-full bg-green-400 flex items-center justify-center text-black font-bold text-sm">
                                    {{ strtoupper(substr($friend->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <p class="text-white font-semibold text-sm truncate">{{ $friend->name }}</p>
                                <p class="text-gray-400 text-xs">{{ $friend->nim }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection