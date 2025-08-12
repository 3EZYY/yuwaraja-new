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
        border-radius: 0.75rem;
        /* 12px */
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

<!-- Role Error Alert -->
@if(session('role_error'))
<div id="role-error-alert" class="fixed top-4 right-4 z-50 max-w-md bg-pink-600 text-white p-4 rounded-lg shadow-lg">
    <div class="flex items-center gap-3">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
        </svg>
        <div>
            <p class="font-semibold">{{ session('role_error') }}</p>
        </div>
        <button onclick="closeAlert('role-error-alert')" class="ml-auto">
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
                        <p class="font-kanit text-gray-400 mt-1 text-sm tracking-wider">STATUS: <span class="font-semibold text-teal-400">SUPERVISOR AKTIF</span></p>
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
                        <p class="font-semibold text-white capitalize leading-tight">Admin YUWARAJA XVII</p>
                        <p class="text-sm text-gray-400 leading-tight">{{ $user->email ?? 'N/A' }}</p>
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h3 class="font-display text-xl font-bold text-white">Informasi SPV</h3>
                </div>
                <div class="space-y-4 text-sm pl-9">
                    <div>
                        <p class="text-gray-400">Total Kelompok Dibimbing</p>
                        <p class="font-semibold text-lg text-white">{{ $totalKelompok }} Kelompok</p>
                    </div>
                    <div>
                        <p class="text-gray-400">Total Mahasiswa Dibimbing</p>
                        <p class="font-semibold text-teal-400">{{ $totalMahasiswa }} Mahasiswa</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-300 mt-4 mb-1">Cluster yang Dibimbing</h4>
                        @if($kelompokDibimbing->count() > 0)
                        <a href="{{ route('spv.cluster.index') }}" class="text-amber-400 hover:text-amber-300 transition-colors">
                            Lihat <span class="font-bold">{{ $kelompokDibimbing->count() }}</span> kelompok »
                        </a>
                        @else
                        <p class="text-gray-500 italic">Belum ada Cluster yang dibimbing</p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="themed-card p-6 flex flex-col gap-2 animate-on-scroll" style="animation-delay: 200ms;">
                    <div class="flex items-center gap-2 font-display text-sm text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>TUGAS DIKUMPULKAN</span>
                    </div>
                    <p class="text-5xl font-display font-bold text-white">{{ $tugasSelesai }}</p>
                    <p class="text-xs text-gray-500 mt-auto">Tugas yang telah dikumpulkan</p>
                </div>
                <div class="themed-card p-6 flex flex-col gap-2 animate-on-scroll" style="animation-delay: 300ms;">
                    <div class="flex items-center gap-2 font-display text-sm text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <g fill="none" fill-rule="evenodd">
                                <path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                <path fill="currentColor" d="M19 4.741V8a3 3 0 1 1 0 6v3c0 1.648-1.881 2.589-3.2 1.6l-2.06-1.546A8.66 8.66 0 0 0 10 15.446v2.844a2.71 2.71 0 0 1-5.316.744l-1.57-5.496a4.7 4.7 0 0 1 3.326-7.73l3.018-.168a9.34 9.34 0 0 0 4.19-1.259l2.344-1.368C17.326 2.236 19 3.197 19 4.741M5.634 15.078l.973 3.407A.71.71 0 0 0 8 18.29v-3.01l-1.56-.087a5 5 0 0 1-.806-.115M17 4.741L14.655 6.11A11.3 11.3 0 0 1 10 7.604v5.819c1.787.246 3.488.943 4.94 2.031L17 17zM8 7.724l-1.45.08a2.7 2.7 0 0 0-.17 5.377l.17.015l1.45.08zM19 10v2a1 1 0 0 0 .117-1.993z" />
                            </g>
                        </svg>
                        <span>PENGUMUMAN</span>
                    </div>
                    <p class="text-5xl font-display font-bold text-amber-500 text-glow-gold-subtle">{{ $pengumuman->count() }}</p>
                    <p class="text-xs text-gray-500 mt-auto">Pengumuman aktif</p>
                </div>
                <a href="{{ route('spv.tugas.index') }}" class="bg-teal-600 p-6 rounded-xl flex flex-col items-center justify-center text-center text-white hover:bg-teal-500 transition-colors group animate-on-scroll" style="animation-delay: 400ms;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                    <p class="font-display font-bold text-lg uppercase">Review Tugas</p>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            <div class="lg:col-span-2 themed-card p-6 animate-on-scroll">
                <div class="flex items-center gap-3 border-b border-gray-700 pb-3 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <g fill="none" fill-rule="evenodd">
                            <path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                            <path fill="currentColor" d="M19 4.741V8a3 3 0 1 1 0 6v3c0 1.648-1.881 2.589-3.2 1.6l-2.06-1.546A8.66 8.66 0 0 0 10 15.446v2.844a2.71 2.71 0 0 1-5.316.744l-1.57-5.496a4.7 4.7 0 0 1 3.326-7.73l3.018-.168a9.34 9.34 0 0 0 4.19-1.259l2.344-1.368C17.326 2.236 19 3.197 19 4.741M5.634 15.078l.973 3.407A.71.71 0 0 0 8 18.29v-3.01l-1.56-.087a5 5 0 0 1-.806-.115M17 4.741L14.655 6.11A11.3 11.3 0 0 1 10 7.604v5.819c1.787.246 3.488.943 4.94 2.031L17 17zM8 7.724l-1.45.08a2.7 2.7 0 0 0-.17 5.377l.17.015l1.45.08zM19 10v2a1 1 0 0 0 .117-1.993z" />
                        </g>
                    </svg>
                    <h3 class="font-display text-xl font-bold text-white">Pengumuman Terbaru</h3>
                </div>
                @if($pengumuman->count() > 0)
                <div class="space-y-5">
                    @foreach($pengumuman->take(3) as $announce)
                    <div>
                        <a href="{{ route('spv.pengumuman.detail', $announce->id) }}" class="font-semibold text-base text-white hover:text-amber-400 transition-colors">{{ $announce->judul }}</a>
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <h3 class="font-display text-xl font-bold text-white">Jadwal Mendatang</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-950/50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold font-display text-gray-400 uppercase tracking-wider">Acara</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold font-display text-gray-400 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold font-display text-gray-400 uppercase tracking-wider">Lokasi</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold font-display text-gray-400 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800">
                            @forelse($jadwal as $item)
                            <tr class="hover:bg-gray-800/60 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold">
                                    <a href="{{ route('spv.jadwal.detail', $item->id) }}" class="text-white hover:text-teal-300 transition-colors">{{ $item->nama_acara }}</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    {{ $item->tanggal_mulai->format('d M Y, H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    {{ $item->lokasi ?? 'Online' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <a href="{{ route('spv.jadwal.detail', $item->id) }}" class="inline-block px-4 py-2 text-xs font-bold font-display rounded-md transition-all duration-300 transform hover:scale-105 bg-teal-500 text-black hover:bg-teal-400">
                                        LIHAT
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-gray-500 italic">// Tidak ada jadwal mendatang //</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
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
        }, {
            threshold: 0.1
        });
        const elements = document.querySelectorAll('.animate-on-scroll');
        elements.forEach(el => observer.observe(el));

        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            const roleErrorAlert = document.getElementById('role-error-alert');
            if (roleErrorAlert) {
                roleErrorAlert.style.display = 'none';
            }
        }, 5000);
    });

    function closeAlert(alertId) {
        const alert = document.getElementById(alertId);
        if (alert) {
            alert.style.display = 'none';
        }
    }
</script>
@endsection