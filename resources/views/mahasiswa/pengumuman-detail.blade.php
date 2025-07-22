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
            font-weight: 700;
            text-transform: uppercase;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
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
    </style>

<div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Header -->
            <div class="themed-card p-6 md:p-8 animate-on-scroll">
                <div class="flex items-center gap-4">
                    <span class="text-4xl">📢</span>
                    <div>
                        <h1 class="font-display text-3xl font-bold text-white uppercase">Pusat Informasi</h1>
                        <p class="font-kanit text-gray-400 mt-1 text-sm tracking-wider">DETAIL PENGUMUMAN</p>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="themed-card animate-on-scroll">
                <div class="p-8">
                    <!-- Title and Meta -->
                    <div class="border-b border-gray-700 pb-6 mb-8">
                        <h1 class="font-display text-4xl font-bold text-white mb-4 text-glow-gold-subtle">{{ $pengumuman->judul }}</h1>
                        <div class="flex items-center gap-4 text-sm text-gray-400">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>Diposting:  {{ $pengumuman->created_at->format('d F Y, H:i') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>Supervisor YUWARAJA XVII</span>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="prose prose-lg max-w-none">
                        <div class="text-gray-300 leading-relaxed text-lg space-y-4">
                            {!! nl2br(e($pengumuman->konten)) !!}
                        </div>
                    </div>

                    <!-- Back Button -->
                    <div class="mt-12 pt-8 border-t border-gray-700">
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