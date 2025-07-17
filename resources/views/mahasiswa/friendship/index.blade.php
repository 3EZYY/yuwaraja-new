@extends('layouts.app')

@section('content')
    {{-- CSS Kustom Minimal untuk Font dan Efek Khusus --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&family=Poppins:wght@600;700;900&display=swap');
        
        .font-display { font-family: 'Poppins', sans-serif; }
        .font-body { font-family: 'Kanit', sans-serif; }

        /* Efek Glow untuk Teks */
        .text-glow-teal { text-shadow: 0 0 12px theme('colors.teal.500 / 0.5'); }
        .text-glow-amber { text-shadow: 0 0 12px theme('colors.amber.400 / 0.5'); }
    </style>

<div class="font-body bg-gray-900 min-h-screen py-12 sm:py-16" style="background-image: radial-gradient(circle at top, #1a202c, #0a0f14);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <header class="bg-gray-950/50 backdrop-blur-xl p-6 rounded-2xl mb-8 border border-teal-500/20">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <h1 class="font-display text-2xl sm:text-3xl font-bold text-teal-300 text-glow-teal flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        Jaringan Kelompok
                    </h1>
                    <p class="text-gray-400 mt-1">Kelompok: <span class="text-white font-semibold">{{ $user->kelompok->nama_kelompok }}</span></p>
                </div>
                <a href="{{ route('mahasiswa.dashboard') }}" class="inline-flex items-center gap-2 text-sm text-amber-300 hover:text-amber-200 transition-colors group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" /></svg>
                    Kembali ke Dashboard
                </a>
            </div>
        </header>

        <!-- Alert Messages -->
        @if(session('success')) <div class="bg-green-500/10 border border-green-500/30 text-green-300 text-sm p-3 rounded-lg mb-6 flex items-center gap-3"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg><span>{{ session('success') }}</span></div> @endif
        @if(session('error')) <div class="bg-red-500/10 border border-red-500/30 text-red-300 text-sm p-3 rounded-lg mb-6 flex items-center gap-3"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg><span>{{ session('error') }}</span></div> @endif

        <div class="space-y-12">
            <!-- Supervisor Section -->
            @if($supervisor)
            <div>
                <h2 class="font-display text-xl font-bold text-white mb-4 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 8a6 6 0 11-12 0 6 6 0 0112 0zM7 8a3 3 0 116 0 3 3 0 01-6 0z" clip-rule="evenodd" /><path d="M5.424 14.576a4 4 0 016.536 2.398A6.985 6.985 0 0110 18a6.985 6.985 0 01-3.06-1.026 4 4 0 012.484-2.398z" /><path fill-rule="evenodd" d="M12.293 18.293a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414zM18 19.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" clip-rule="evenodd" /></svg>
                    Supervisor Kelompok
                </h2>
                <div class="bg-gray-900/50 p-6 rounded-xl border border-gray-700/50 flex items-center space-x-6">
                    @if($supervisor->photo)
                        <img src="{{ asset('storage/profile/' . $supervisor->photo) }}" alt="{{ $supervisor->name }}" class="w-16 h-16 rounded-full border-2 border-cyan-400 flex-shrink-0">
                    @else
                        <div class="w-16 h-16 rounded-full bg-cyan-400 flex-shrink-0 flex items-center justify-center text-black font-bold text-2xl font-display">{{ strtoupper(substr($supervisor->name, 0, 1)) }}</div>
                    @endif
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-white">{{ $supervisor->name }}</h3>
                        <p class="text-gray-400 text-sm">{{ $supervisor->email }}</p>
                    </div>
                    <span class="text-xs font-bold py-1 px-3 rounded-full bg-cyan-500/10 text-cyan-300 border border-cyan-500/20">SUPERVISOR</span>
                </div>
            </div>
            @endif

            <!-- Members Section -->
            <div>
                <h2 class="font-display text-xl font-bold text-white mb-4 flex items-center gap-3">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21a6 6 0 00-9-5.197m0 0A5.975 5.975 0 0112 13a5.975 5.975 0 01-3 5.197z" /></svg>
                    Anggota Kelompok
                </h2>
                @if($kelompokMembers->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($kelompokMembers as $member)
                        <div class="bg-gray-900/50 text-center p-6 rounded-xl border border-gray-700/50 hover:border-amber-400/50 hover:bg-gray-900 transition-all duration-300 transform hover:-translate-y-1">
                            @if($member->photo)
                                <img src="{{ asset('storage/profile/' . $member->photo) }}" alt="{{ $member->name }}" class="w-20 h-20 rounded-full border-2 border-amber-400/50 mx-auto mb-4">
                            @else
                                <div class="w-20 h-20 rounded-full bg-amber-400/20 flex items-center justify-center text-amber-300 font-bold text-3xl font-display mx-auto mb-4 border-2 border-amber-400/50">{{ strtoupper(substr($member->name, 0, 1)) }}</div>
                            @endif
                            
                            <h3 class="text-lg font-bold text-white mb-1 truncate">{{ $member->name }}</h3>
                            <p class="text-gray-400 text-sm mb-4">{{ $member->nim }}</p>
                            
                            @if($user->isFriendWith($member->id))
                                <span class="inline-flex items-center gap-2 w-full justify-center px-3 py-2 rounded-lg text-sm font-semibold bg-green-500/10 text-green-400 border border-green-500/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                    Sudah Berteman
                                </span>
                            @elseif($user->hasFriendshipRequestWith($member->id))
                                <span class="inline-flex items-center gap-2 w-full justify-center px-3 py-2 rounded-lg text-sm font-semibold bg-yellow-500/10 text-amber-300 border border-amber-500/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    Permintaan Terkirim
                                </span>
                            @else
                                <form action="{{ route('mahasiswa.friendship.send') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="friend_id" value="{{ $member->id }}">
                                    <button type="submit" class="inline-flex items-center gap-2 w-full justify-center px-3 py-2 rounded-lg text-sm font-bold bg-teal-500 hover:bg-teal-600 text-black transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 11a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1v-1z" /></svg>
                                        Jalin Pertemanan
                                    </button>
                                </form>
                            @endif
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-gray-900/50 p-8 text-center rounded-xl border border-gray-700/50">
                        <p class="text-gray-400">Belum ada anggota lain di kelompok ini.</p>
                    </div>
                @endif
            </div>

            <!-- Friends List Section (jika ada) -->
            @if($friends->count() > 0)
            <div>
                <h2 class="font-display text-xl font-bold text-white mb-4 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                    Daftar Pertemanan
                </h2>
                <div class="bg-gray-900/50 p-6 rounded-xl border border-gray-700/50">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        @foreach($friends as $friend)
                        <div class="flex items-center space-x-3 p-3 bg-green-500/10 rounded-lg border border-green-500/20">
                            @if($friend->photo)
                                <img src="{{ asset('storage/profile/' . $friend->photo) }}" alt="{{ $friend->name }}" class="w-10 h-10 rounded-full border border-green-400/50 flex-shrink-0">
                            @else
                                <div class="w-10 h-10 rounded-full bg-green-400/20 flex-shrink-0 flex items-center justify-center text-green-300 font-bold font-display">{{ strtoupper(substr($friend->name, 0, 1)) }}</div>
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