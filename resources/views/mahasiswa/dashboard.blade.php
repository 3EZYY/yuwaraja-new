@extends('layouts.app')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&family=Poppins:wght@600;700;900&display=swap');

        :root {
            --bg-main: #0a0a0a;
            --surface-card: #111827;
            --border-color: rgba(20, 184, 166, 0.25); 
            --brand-teal: #14b8a6;
            --brand-gold: #f59e0b;
            --text-primary: #d1d5db;
            --text-secondary: #6b7280;
        }

        body {
            background-color: var(--bg-main) !important;
            font-family: 'Kanit', sans-serif;
            color: var(--text-primary);
        }
        
        .font-display {
            font-family: 'Poppins', sans-serif;
        }

        .text-glow-gold-subtle {
            text-shadow: 0 0 8px rgba(245, 158, 11, 0.5);
        }
        .text-glow-teal-subtle {
            text-shadow: 0 0 8px rgba(20, 184, 166, 0.6);
        }

        .themed-card {
            background-color: var(--surface-card);
            border: 1px solid var(--border-color);
            border-radius: 0.75rem; /* 12px */
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .themed-card:hover {
            border-color: var(--brand-gold);
            box-shadow: 0 0 20px rgba(245, 158, 11, 0.15);
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        .animate-on-scroll.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

    <!-- Alert Messages -->
    @if(session('success'))
        <div id="success-alert" class="fixed top-4 right-4 z-50 max-w-md bg-green-600 text-white p-4 rounded-lg shadow-lg">
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="font-semibold">{{ session('success') }}</p>
                </div>
                <button onclick="closeAlert('success-alert')" class="ml-auto">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div id="error-alert" class="fixed top-4 right-4 z-50 max-w-md bg-red-600 text-white p-4 rounded-lg shadow-lg">
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="font-semibold">{{ session('error') }}</p>
                </div>
                <button onclick="closeAlert('error-alert')" class="ml-auto">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

            <div class="themed-card p-6 md:p-8 animate-on-scroll">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div class="flex items-center gap-4">
                        <span class="text-4xl">👋</span>
                        <div>
                            <h2 class="font-display text-3xl font-bold text-white uppercase">Selamat Datang, <span class="text-amber-500 text-glow-gold-subtle">{{ $user->name }}</span>!</h2>
                            <p class="font-kanit text-gray-400 mt-1 text-sm tracking-wider">STATUS: <span class="font-semibold text-teal-400">AKTIF</span></p>
                        </div>
                    </div>
                    <div class="flex-shrink-0 flex items-center gap-4 border-t md:border-t-0 md:border-l border-gray-700 pt-4 md:pt-0 md:pl-6 w-full md:w-auto">
                        <a href="{{ route('profile.edit') }}" aria-label="Edit profil Anda">
                            @if($user->photo)
                                <img src="{{ asset('profile-pictures/' . $user->photo) }}" alt="Foto profil {{ $user->name }}" class="w-16 h-16 rounded-full border-2 border-gray-600 hover:border-amber-500 transition-colors">
                            @else
                                <div class="w-16 h-16 rounded-full bg-gray-800 flex items-center justify-center text-gray-500 border-2 border-gray-600 hover:border-amber-500 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @endif
                        </a>
                        <div class="text-left">
                            <p class="font-semibold text-white capitalize leading-tight">{{ $user->kelompok->nama_kelompok ?? 'Belum ada kelompok' }}</p>
                            <p class="text-sm text-gray-400 leading-tight">{{ $user->program_studi ?? 'N/A' }}</p>
                            <a href="{{ route('profile.edit') }}" class="text-xs text-gray-400 hover:text-amber-400 transition-colors mt-1 inline-block">
                                Edit Profil »
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-1 themed-card p-6 space-y-6 animate-on-scroll" style="animation-delay: 100ms;">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        <h3 class="font-display text-xl font-bold text-white">Informasi Kelompok</h3>
                    </div>
                    @if($user->kelompok)
                    <div class="space-y-4 text-sm pl-9">
                        <div>
                            <p class="text-gray-400">Nama Kelompok</p>
                            <p class="font-semibold text-lg text-white">{{ $user->kelompok->nama_kelompok }}</p>
                        </div>
                        @if($user->kelompok->supervisor)
                        <div>
                            <p class="text-gray-400">Supervisor</p>
                            <p class="font-semibold text-teal-400">{{ $user->kelompok->supervisor->name }}</p>
                        </div>
                        @endif
                        <div>
                            <h4 class="font-semibold text-gray-300 mt-4 mb-1">Pertemanan</h4>
                             @php try { $friends = $user->friends(); $friendsCount = $friends->count(); } catch (\Exception $e) { $friends = collect(); $friendsCount = 0; } @endphp
                            @if($friendsCount > 0)
                               <a href="{{ route('mahasiswa.friendship.index') }}" class="text-amber-400 hover:text-amber-300 transition-colors">
                                    Kamu memiliki <span class="font-bold">{{ $friendsCount }}</span> teman. Lihat »
                                </a>
                            @else
                                <a href="{{ route('mahasiswa.friendship.index') }}" class="text-amber-400 hover:text-amber-300 transition-colors">
                                    Cari teman di kelompokmu »
                                </a>
                            @endif
                        </div>
                    </div>
                    @else
                    <p class="text-gray-500 italic pl-9">Anda belum terdaftar di kelompok manapun.</p>
                    @endif
                </div>

                <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="themed-card p-6 flex flex-col gap-2 animate-on-scroll" style="animation-delay: 200ms;">
                        <div class="flex items-center gap-2 font-display text-sm text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span>MISI SELESAI</span>
                        </div>
                        @php 
                            $tugasSelesai = $pengumpulanTugas->whereIn('status', ['approved', 'done'])->count();
                            $totalTugas = $tugas->count();
                            $progress = $totalTugas > 0 ? ($tugasSelesai / $totalTugas) * 100 : 0;
                        @endphp
                        <p class="text-5xl font-display font-bold text-white">{{ $tugasSelesai }}<span class="text-3xl text-gray-600">/{{ $totalTugas }}</span></p>
                        <div class="w-full bg-gray-700 rounded-full h-1.5 mt-1"><div class="bg-teal-500 h-1.5 rounded-full" style="width: {{ $progress }}%"></div></div>
                    </div>
                    <div class="themed-card p-6 flex flex-col gap-2 animate-on-scroll" style="animation-delay: 300ms;">
                        <div class="flex items-center gap-2 font-display text-sm text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                            </svg>
                            <span>PENGUMUMAN</span>
                        </div>
                        <p class="text-5xl font-display font-bold text-amber-500 text-glow-gold-subtle">{{ $pengumuman->count() }}</p>
                        <p class="text-xs text-gray-500 mt-auto">Pesan baru diterima</p>
                    </div>
                    <!-- Button Absen Card -->
                    <div class="themed-card p-6 flex flex-col justify-center items-center gap-4 animate-on-scroll hover:scale-105 transform transition-all duration-300" style="animation-delay: 400ms;">
                        <a href="{{ route('mahasiswa.absensi.index') }}" class="w-full flex flex-col items-center justify-center gap-3 group">
                            <div class="p-4 rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 group-hover:from-emerald-400 group-hover:to-teal-500 transition-all duration-300 shadow-lg group-hover:shadow-emerald-500/25">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="text-center">
                                <p class="font-display text-lg font-bold text-white group-hover:text-emerald-400 transition-colors">ABSEN</p>
                                <p class="text-xs text-gray-400 group-hover:text-gray-300 transition-colors">Catat Kehadiran</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
                <div class="lg:col-span-2 themed-card p-6 animate-on-scroll">
                    <div class="flex items-center gap-3 border-b border-gray-700 pb-3 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
                        </svg>
                        <h3 class="font-display text-xl font-bold text-white">Pengumuman Terbaru</h3>
                    </div>
                    @if($pengumuman->count() > 0)
                        <div class="space-y-5">
                            @foreach($pengumuman->take(3) as $announce)
                            <div>
                                <a href="{{ route('mahasiswa.pengumuman.detail', $announce->id) }}" class="font-semibold text-base text-white hover:text-amber-400 transition-colors">{{ $announce->judul }}</a>
                                <p class="text-sm text-gray-400 mt-1 line-clamp-2">{{ Str::limit(strip_tags($announce->konten), 120) }}</p>
                                <p class="text-xs text-gray-500 mt-2">{{ $announce->created_at->diffForHumans() }}</p>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 italic py-4">// Tidak ada pengumuman terbaru //</p>
                    @endif
                </div>

                <div class="lg:col-span-3 themed-card animate-on-scroll">
                    <div class="p-6 flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                        <h3 class="font-display text-xl font-bold text-white">Daftar Misi (Tugas)</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-950/50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold font-display text-gray-400 uppercase tracking-wider">Misi</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold font-display text-gray-400 uppercase tracking-wider">Deadline</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold font-display text-gray-400 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-center text-xs font-semibold font-display text-gray-400 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800">
                                @forelse($tugas as $task)
                                @php $pengumpulan = $pengumpulanTugas->get($task->id); @endphp
                                <tr class="hover:bg-gray-800/60 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold">
                                        <a href="{{ route('mahasiswa.tugas.show', $task->id) }}" class="text-white hover:text-teal-300 transition-colors">{{ $task->judul }}</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm {{ $task->deadline < now() && !$pengumpulan ? 'text-red-500' : 'text-gray-300' }}">
                                        {{ $task->deadline->format('d M Y, H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs">
                                        @if($pengumpulan)
                                            @if($pengumpulan->status == 'done')
                                                <span class="px-2.5 py-1 font-semibold rounded bg-green-500/10 text-green-400">Selesai & Dinilai</span>
                                            @elseif($pengumpulan->status == 'approved')
                                                <span class="px-2.5 py-1 font-semibold rounded bg-sky-500/10 text-sky-400">Disetujui</span>
                                            @elseif($pengumpulan->status == 'rejected')
                                                <span class="px-2.5 py-1 font-semibold rounded bg-red-500/10 text-red-400">Perlu Revisi</span>
                                            @elseif($pengumpulan->status == 'reviewed')
                                                <span class="px-2.5 py-1 font-semibold rounded bg-blue-500/10 text-blue-400">Sedang Direview</span>
                                            @elseif($pengumpulan->status == 'submitted')
                                                <span class="px-2.5 py-1 font-semibold rounded bg-yellow-500/10 text-yellow-400">Menunggu Review</span>
                                            @else
                                                <span class="px-2.5 py-1 font-semibold rounded bg-gray-500/10 text-gray-400">{{ ucfirst($pengumpulan->status) }}</span>
                                            @endif
                                        @else
                                            @if($task->deadline < now())
                                                <span class="px-2.5 py-1 font-semibold rounded bg-red-500/10 text-red-400">Terlewat</span>
                                            @else
                                                <span class="px-2.5 py-1 font-semibold rounded bg-gray-500/10 text-gray-400">Belum Dikerjakan</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <a href="{{ route('mahasiswa.tugas.show', $task->id) }}" class="inline-block px-4 py-2 text-xs font-bold font-display rounded-md transition-all duration-300 transform hover:scale-105
                                            @if(!$pengumpulan && $task->deadline > now())
                                                bg-teal-500 text-black hover:bg-teal-400
                                            @else
                                                bg-gray-700 text-gray-300 hover:bg-gray-600
                                            @endif">
                                            @if(!$pengumpulan && $task->deadline > now())
                                                KERJAKAN
                                            @else
                                                LIHAT
                                            @endif
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-500 italic">// Tidak ada misi aktif saat ini //</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Panel Survey -->
            <div class="themed-card animate-on-scroll">
                <div class="p-6 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 8l2 2 4-4" />
                    </svg>
                    <h3 class="font-display text-xl font-bold text-white">Survey Aktif</h3>
                    <span class="ml-auto px-3 py-1 text-xs font-bold bg-purple-500/20 text-purple-400 rounded-full">{{ $surveys->count() }} Survey</span>
                </div>
                @if($surveys->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-950/50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold font-display text-gray-400 uppercase tracking-wider">Survey</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold font-display text-gray-400 uppercase tracking-wider">Periode</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold font-display text-gray-400 uppercase tracking-wider">Pertanyaan</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold font-display text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold font-display text-gray-400 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800">
                            @foreach($surveys as $survey)
                            @php $hasAnswered = $surveyStatus[$survey->id_master_survey] ?? false; @endphp
                            <tr class="hover:bg-gray-800/60 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    <div>
                                        <p class="text-sm font-semibold text-white">{{ $survey->judul_survey }}</p>
                                        @if($survey->deskripsi_survey)
                                        <p class="text-xs text-gray-400 mt-1 line-clamp-2">{{ Str::limit($survey->deskripsi_survey, 100) }}</p>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    <div class="text-xs">
                                        <p>{{ $survey->tanggal_mulai->format('d M Y') }}</p>
                                        <p class="text-gray-500">s/d {{ $survey->tanggal_selesai->format('d M Y') }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    <span class="px-2 py-1 text-xs bg-gray-700 text-gray-300 rounded">{{ $survey->detilSurvey->count() }} pertanyaan</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-xs">
                                    @if($hasAnswered)
                                        <div class="flex items-center gap-2">
                                            <span class="px-2.5 py-1 font-semibold rounded bg-green-500/10 text-green-400">✓ Sudah Diisi</span>
                                        </div>
                                    @else
                                        @if($survey->tanggal_selesai < now())
                                            <span class="px-2.5 py-1 font-semibold rounded bg-red-500/10 text-red-400">⚠ Terlewat</span>
                                        @else
                                            <div class="flex items-center gap-2">
                                                <span class="px-2.5 py-1 font-semibold rounded bg-yellow-500/10 text-yellow-400 animate-pulse">⏳ Belum Diisi</span>
                                                @php
                                                    $timeLeft = $survey->tanggal_selesai->diffInDays(now());
                                                @endphp
                                                @if($timeLeft <= 3)
                                                    <!-- <span class="text-xs text-red-400 font-medium">{{ $timeLeft }} hari lagi</span> -->
                                                @endif
                                            </div>
                                        @endif
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    @if($hasAnswered)
                                        <span class="inline-block px-4 py-2 text-xs font-bold font-display rounded-md bg-gray-700 text-gray-400 cursor-not-allowed">
                                            SELESAI
                                        </span>
                                    @else
                                        @if($survey->tanggal_selesai >= now())
                                            <a href="{{ route('mahasiswa.survey.fill', $survey->id_master_survey) }}" class="inline-block px-4 py-2 text-xs font-bold font-display rounded-md transition-all duration-300 transform hover:scale-105 bg-purple-500 text-white hover:bg-purple-400">
                                                ISI SURVEY
                                            </a>
                                        @else
                                            <span class="inline-block px-4 py-2 text-xs font-bold font-display rounded-md bg-gray-700 text-gray-400 cursor-not-allowed">
                                                TERLEWAT
                                            </span>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="p-6 text-center">
                    <p class="text-gray-500 italic">// Tidak ada survey aktif saat ini //</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, { threshold: 0.1 });
            const elements = document.querySelectorAll('.animate-on-scroll');
            elements.forEach(el => observer.observe(el));

            // Auto-hide alerts after 5 seconds
            setTimeout(() => {
                const successAlert = document.getElementById('success-alert');
                const errorAlert = document.getElementById('error-alert');
                if (successAlert) successAlert.style.display = 'none';
                if (errorAlert) errorAlert.style.display = 'none';
            }, 5000);
        });

        function closeAlert(alertId) {
            document.getElementById(alertId).style.display = 'none';
        }
    </script>
@endsection