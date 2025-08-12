@extends('layouts.app')

@section('content')
{{-- CSS Kustom Minimal untuk Font dan Efek Khusus --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&family=Poppins:wght@600;700;900&display=swap');

    .font-display {
        font-family: 'Poppins', sans-serif;
    }

    .font-body {
        font-family: 'Kanit', sans-serif;
    }

    /* Efek Glow untuk Teks */
    .text-glow-teal {
        text-shadow: 0 0 12px theme('colors.teal.500 / 0.5');
    }

    .text-glow-amber {
        text-shadow: 0 0 12px theme('colors.amber.400 / 0.5');
    }
</style>

<div class="font-body bg-gray-900 min-h-screen py-12 sm:py-16" style="background-image: radial-gradient(circle at top, #1a202c, #0a0f14);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <header class="bg-gray-950/50 backdrop-blur-xl p-6 rounded-2xl mb-8 border border-teal-500/20">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <h1 class="font-display text-2xl sm:text-3xl font-bold text-teal-300 text-glow-teal flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Jaringan Kelompok
                    </h1>
                    <p class="text-gray-400 mt-1">Kelompok: <span class="text-white font-semibold">{{ $user->kelompok->nama_kelompok }}</span></p>

                    <!-- Profile Cluster -->
                    <div class="mt-4 flex items-center gap-4">
                        <div class="relative">
                            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-teal-400 to-cyan-500 p-1 shadow-lg">
                                @if($user->kelompok->photo)
                                <img src="{{ asset('storage/' . $user->kelompok->photo) }}"
                                    alt="{{ $user->kelompok->nama_kelompok }}"
                                    class="w-full h-full rounded-full object-cover bg-gray-900">
                                @else
                                <div class="w-full h-full rounded-full bg-gray-900 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                @endif
                            </div>
                            <!-- Status indicator -->
                            <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-500 rounded-full border-2 border-gray-900 flex items-center justify-center">
                                <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-white text-glow-teal">{{ $user->kelompok->nama_kelompok }}</h3>
                            <div class="flex items-center gap-2 text-xs text-gray-400 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>{{ $kelompokMembers->count() }} Anggota</span>
                                @if($supervisor)
                                <span class="text-cyan-400">• 1 SPV</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('mahasiswa.dashboard') }}" class="inline-flex items-center gap-2 text-sm text-amber-300 hover:text-amber-200 transition-colors group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>
        </header>

        <!-- Alert Messages -->
        @if(session('success')) <div class="bg-green-500/10 border border-green-500/30 text-green-300 text-sm p-3 rounded-lg mb-6 flex items-center gap-3"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg><span>{{ session('success') }}</span></div> @endif
        @if(session('error')) <div class="bg-red-500/10 border border-red-500/30 text-red-300 text-sm p-3 rounded-lg mb-6 flex items-center gap-3"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg><span>{{ session('error') }}</span></div> @endif

        <div class="space-y-12">
            <!-- Supervisor Section -->
            @if($supervisor)
            <div>
                <h2 class="font-display text-xl font-bold text-white mb-4 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                    SPV
                </h2>
                <div class="bg-gray-900/50 p-6 rounded-xl border border-gray-700/50 flex items-center space-x-6">
                    @if($supervisor->photo)
                    <img src="{{ asset('profile-pictures/' . $supervisor->photo) }}" alt="{{ $supervisor->name }}" class="w-16 h-16 rounded-full border-2 border-cyan-400 flex-shrink-0">
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                    </svg>
                    Anggota Kelompok
                </h2>
                @if($kelompokMembers->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($kelompokMembers as $member)
                    <div class="bg-gray-900/50 text-center p-6 rounded-xl border border-gray-700/50 hover:border-amber-400/50 hover:bg-gray-900 transition-all duration-300 transform hover:-translate-y-1 {{ $member->id == $user->id ? 'ring-2 ring-teal-400/50' : '' }}">
                        @if($member->photo)
                        <img src="{{ asset('profile-pictures/' . $member->photo) }}" alt="{{ $member->name }}" class="w-20 h-20 rounded-full border-2 {{ $member->id == $user->id ? 'border-teal-400' : 'border-amber-400/50' }} mx-auto mb-4">
                        @else
                        <div class="w-20 h-20 rounded-full {{ $member->id == $user->id ? 'bg-teal-400/20 border-teal-400' : 'bg-amber-400/20 border-amber-400/50' }} flex items-center justify-center text-amber-300 font-bold text-3xl font-display mx-auto mb-4 border-2">{{ strtoupper(substr($member->name, 0, 1)) }}</div>
                        @endif

                        <h3 class="text-lg font-bold text-white mb-1 truncate">{{ $member->name }} {{ $member->id == $user->id ? '(Kamu)' : '' }}</h3>
                        <p class="text-gray-400 text-sm mb-4">{{ $member->nim }}</p>

                        @if($member->id == $user->id)
                        <span class="inline-flex items-center gap-2 w-full justify-center px-3 py-2 rounded-lg text-sm font-semibold bg-teal-500/10 text-teal-300 border border-teal-500/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            Anda
                        </span>
                        @elseif($user->isFriendWith($member->id))
                        <div class="space-y-2">
                            <span class="inline-flex items-center gap-2 w-full justify-center px-3 py-2 rounded-lg text-sm font-semibold bg-green-500/10 text-green-400 border border-green-500/20">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Sudah Berteman
                            </span>
                            <form action="{{ route('mahasiswa.friendship.remove', $member->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pertemanan dengan {{ $member->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center gap-2 w-full justify-center px-3 py-2 rounded-lg text-sm font-bold bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/20 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Batalkan Pertemanan
                                </button>
                            </form>
                        </div>
                        @elseif($user->hasFriendshipRequestWith($member->id))
                        @php
                        $sentRequest = $user->friendships()->where('friend_id', $member->id)->where('status', 'pending')->first();
                        $receivedRequest = $user->receivedFriendships()->where('user_id', $member->id)->where('status', 'pending')->first();
                        @endphp

                        @if($sentRequest)
                        <span class="inline-flex items-center gap-2 w-full justify-center px-3 py-2 rounded-lg text-sm font-semibold bg-yellow-500/10 text-amber-300 border border-amber-500/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Permintaan Terkirim
                        </span>
                        @elseif($receivedRequest)
                        <div class="space-y-2">
                            <span class="inline-flex items-center gap-2 w-full justify-center px-3 py-2 rounded-lg text-sm font-semibold bg-blue-500/10 text-blue-300 border border-blue-500/20">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path fill-rule="evenodd" d="M4.804 21.644A6.707 6.707 0 0 0 6 21.75a6.721 6.721 0 0 0 3.583-1.029c.774.182 1.584.279 2.417.279 5.322 0 9.75-3.97 9.75-9 0-5.03-4.428-9-9.75-9s-9.75 3.97-9.75 9c0 2.409 1.025 4.587 2.674 6.192.232.226.277.428.254.543a3.73 3.73 0 0 1-.814 1.686.75.75 0 0 0 .44 1.223ZM8.25 10.875a1.125 1.125 0 1 0 0 2.25 1.125 1.125 0 0 0 0-2.25ZM10.875 12a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875-1.125a1.125 1.125 0 1 0 0 2.25 1.125 1.125 0 0 0 0-2.25Z" clip-rule="evenodd" />
                                </svg>

                                Permintaan Masuk
                            </span>
                            <div class="flex gap-2">
                                <form action="{{ route('mahasiswa.friendship.accept', $receivedRequest->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-1 w-full justify-center px-2 py-1 rounded text-xs font-bold bg-green-500 hover:bg-green-600 text-black transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Terima
                                    </button>
                                </form>
                                <form action="{{ route('mahasiswa.friendship.reject', $receivedRequest->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-1 w-full justify-center px-2 py-1 rounded text-xs font-bold bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/20 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endif
                        @else
                        <form action="{{ route('mahasiswa.friendship.send') }}" method="POST">
                            @csrf
                            <input type="hidden" name="friend_id" value="{{ $member->id }}">
                            <button type="submit" class="inline-flex items-center gap-2 w-full justify-center px-3 py-2 rounded-lg text-sm font-bold bg-teal-500 hover:bg-teal-600 text-black transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 11a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1v-1z" />
                                </svg>
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

            <!-- Incoming Friend Requests Section -->
            @if($incomingRequests->count() > 0)
            <div>
                <h2 class="font-display text-xl font-bold text-white mb-4 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path d="M4.913 2.658c2.075-.27 4.19-.408 6.337-.408 2.147 0 4.262.139 6.337.408 1.922.25 3.291 1.861 3.405 3.727a4.403 4.403 0 0 0-1.032-.211 50.89 50.89 0 0 0-8.42 0c-2.358.196-4.04 2.19-4.04 4.434v4.286a4.47 4.47 0 0 0 2.433 3.984L7.28 21.53A.75.75 0 0 1 6 21v-4.03a48.527 48.527 0 0 1-1.087-.128C2.905 16.58 1.5 14.833 1.5 12.862V6.638c0-1.97 1.405-3.718 3.413-3.979Z" />
                        <path d="M15.75 7.5c-1.376 0-2.739.057-4.086.169C10.124 7.797 9 9.103 9 10.609v4.285c0 1.507 1.128 2.814 2.67 2.94 1.243.102 2.5.157 3.768.165l2.782 2.781a.75.75 0 0 0 1.28-.53v-2.39l.33-.026c1.542-.125 2.67-1.433 2.67-2.94v-4.286c0-1.505-1.125-2.811-2.664-2.94A49.392 49.392 0 0 0 15.75 7.5Z" />
                    </svg>

                    Permintaan Pertemanan Masuk
                </h2>
                <div class="bg-gray-900/50 p-6 rounded-xl border border-gray-700/50">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        @foreach($incomingRequests as $request)
                        <div class="flex flex-col items-center space-y-3 p-4 bg-blue-500/10 rounded-lg border border-blue-500/20">
                            @if($request->user->photo)
                            <img src="{{ asset('profile-pictures/' . $request->user->photo) }}" alt="{{ $request->user->name }}" class="w-12 h-12 rounded-full border border-blue-400/50">
                            @else
                            <div class="w-12 h-12 rounded-full bg-blue-400/20 flex items-center justify-center text-blue-300 font-bold font-display">{{ strtoupper(substr($request->user->name, 0, 1)) }}</div>
                            @endif
                            <div class="text-center">
                                <p class="text-white font-semibold text-sm">{{ $request->user->name }}</p>
                                <p class="text-gray-400 text-xs">{{ $request->user->nim }}</p>
                            </div>
                            <div class="flex gap-2 w-full">
                                <form action="{{ route('mahasiswa.friendship.accept', $request->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-1 w-full justify-center px-2 py-1 rounded text-xs font-bold bg-green-500 hover:bg-green-600 text-black transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Terima
                                    </button>
                                </form>
                                <form action="{{ route('mahasiswa.friendship.reject', $request->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-1 w-full justify-center px-2 py-1 rounded text-xs font-bold bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/20 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Friends List Section (jika ada) -->
            @if($friends->count() > 0)
            <div>
                <h2 class="font-display text-xl font-bold text-white mb-4 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M6.32 2.577a49.255 49.255 0 0 1 11.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 0 1-1.085.67L12 18.089l-7.165 3.583A.75.75 0 0 1 3.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93Z" clip-rule="evenodd" />
                    </svg>

                    Daftar Pertemanan
                </h2>
                <div class="bg-gray-900/50 p-6 rounded-xl border border-gray-700/50">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        @foreach($friends as $friend)
                        <div class="flex items-center space-x-3 p-3 bg-green-500/10 rounded-lg border border-green-500/20">
                            @if($friend->photo)
                            <img src="{{ asset('profile-pictures/' . $friend->photo) }}" alt="{{ $friend->name }}" class="w-10 h-10 rounded-full border border-green-400/50 flex-shrink-0">
                            @else
                            <div class="w-10 h-10 rounded-full bg-green-400/20 flex-shrink-0 flex items-center justify-center text-green-300 font-bold font-display">{{ strtoupper(substr($friend->name, 0, 1)) }}</div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <p class="text-white font-semibold text-sm truncate">{{ $friend->name }}</p>
                                <p class="text-gray-400 text-xs">{{ $friend->nim }}</p>
                            </div>
                            <div class="flex gap-1 flex-shrink-0">
                                <a href="{{ route('mahasiswa.friendship.detail', $friend->id) }}" class="inline-flex items-center gap-1 px-2 py-1 rounded text-xs font-medium bg-teal-500/10 hover:bg-teal-500/20 text-teal-400 border border-teal-500/20 transition-colors" title="Lihat Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Detail
                                </a>
                                <form action="{{ route('mahasiswa.friendship.remove', $friend->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pertemanan dengan {{ $friend->name }}?')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 px-2 py-1 rounded text-xs font-medium bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/20 transition-colors" title="Batalkan Pertemanan">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
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