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

        .back-button {
            background: linear-gradient(135deg, var(--brand-teal), #0d9488);
            color: #000;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            border: none;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .back-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(20, 184, 166, 0.3);
            color: #000;
            text-decoration: none;
        }

        .info-item {
            background: rgba(17, 24, 39, 0.6);
            border: 1px solid rgba(20, 184, 166, 0.15);
            border-radius: 0.5rem;
            padding: 1rem;
            transition: all 0.3s ease;
        }
        .info-item:hover {
            border-color: var(--brand-teal);
            background: rgba(17, 24, 39, 0.8);
        }

        .icon-wrapper {
            width: 3rem;
            height: 3rem;
            background: linear-gradient(135deg, var(--brand-teal), var(--brand-gold));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            font-size: 1.25rem;
        }
    </style>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Header -->
            <div class="themed-card p-6 md:p-8 animate-on-scroll">
                <div class="flex items-center gap-4">
                    <span class="text-4xl">📅</span>
                    <div>
                        <h1 class="font-display text-3xl font-bold text-white uppercase text-glow-gold-subtle">
                            {{ $jadwal->nama_acara }}
                        </h1>
                        <p class="font-kanit text-gray-400 mt-1 text-sm tracking-wider">DETAIL JADWAL ACARA</p>
                    </div>
                </div>
            </div>

            <!-- Event Details -->
            <div class="themed-card p-6 md:p-8 animate-on-scroll">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Tanggal -->
                    <div class="info-item">
                        <div class="flex items-center gap-4">
                            <div class="icon-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400 uppercase tracking-wider">Tanggal & Waktu</p>
                                <p class="font-semibold text-white">{{ $jadwal->tanggal_mulai->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Lokasi -->
                    <div class="info-item">
                        <div class="flex items-center gap-4">
                            <div class="icon-wrapper">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-400 uppercase tracking-wider">Lokasi</p>
                                <p class="font-semibold text-white">{{ $jadwal->lokasi ?? 'Online' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Deskripsi -->
                <div class="mb-8">
                    <h3 class="font-display text-xl font-bold text-white mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Deskripsi Acara
                    </h3>
                    <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-6">
                        <div class="text-gray-300 leading-relaxed whitespace-pre-line">{{ $jadwal->deskripsi }}</div>
                    </div>
                </div>

                <!-- Back Button -->
                <div class="flex justify-start">
                    <a href="{{ url()->previous() }}" class="back-button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>
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
            }, { threshold: 0.1 });
            const elements = document.querySelectorAll('.animate-on-scroll');
            elements.forEach(el => observer.observe(el));
        });
    </script>
@endsection
