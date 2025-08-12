@extends('layouts.app')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@600;700;900&display=swap');

        :root {
            --bg-main: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            --surface-card: rgba(15, 23, 42, 0.8);
            --surface-elevated: rgba(30, 41, 59, 0.9);
            --border-primary: rgba(34, 211, 238, 0.3);
            --border-secondary: rgba(148, 163, 184, 0.2);
            --accent-cyan: #22d3ee;
            --accent-blue: #3b82f6;
            --accent-red: #ef4444;
            --text-primary: #f8fafc;
            --text-secondary: #cbd5e1;
            --text-muted: #94a3b8;
        }

        body {
            background: var(--bg-main) !important;
            font-family: 'Inter', sans-serif;
            color: var(--text-primary);
            min-height: 100vh;
        }
        
        .font-display {
            font-family: 'Poppins', sans-serif;
        }

        .glass-card {
            background: var(--surface-card);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-primary);
            border-radius: 1rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .glass-card:hover {
            border-color: var(--accent-cyan);
            box-shadow: 0 25px 50px -12px rgba(34, 211, 238, 0.25);
            transform: translateY(-2px);
        }

        .glass-elevated {
            background: var(--surface-elevated);
            backdrop-filter: blur(24px);
            border: 1px solid var(--border-secondary);
            border-radius: 0.75rem;
        }

        .animate-fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .animate-fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .gradient-text {
            background: linear-gradient(135deg, var(--accent-cyan), var(--accent-blue));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-cyan), var(--accent-blue));
            color: #0f172a;
            font-weight: 600;
            padding: 0.875rem 2rem;
            border-radius: 0.75rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            box-shadow: 0 10px 25px -5px rgba(34, 211, 238, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 40px -5px rgba(34, 211, 238, 0.4);
            color: #0f172a;
            text-decoration: none;
        }

        .type-badge {
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .type-penting {
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .type-umum {
            background: rgba(34, 211, 238, 0.15);
            color: #67e8f9;
            border: 1px solid rgba(34, 211, 238, 0.3);
        }

        .content-prose {
            line-height: 1.8;
            font-size: 1.125rem;
            color: white;
        }

        .content-prose p {
            margin-bottom: 1.5rem;
            color: white;
        }

        .meta-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-muted);
            font-size: 0.875rem;
        }

        @media (max-width: 768px) {
            .glass-card {
                margin: 1rem;
                border-radius: 0.75rem;
            }

            .btn-primary {
                width: 100%;
                justify-content: center;
            }
        }
    </style>

<div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto space-y-8">
        
        <!-- Header -->
        <div class="glass-card p-6 md:p-8 animate-fade-in">
            <div class="flex items-center gap-4">
                <span class="text-4xl">📢</span>
                <div>
                    <h1 class="font-display text-3xl md:text-4xl font-bold text-white mb-2">Detail Pengumuman</h1>
                    <p class="text-slate-400 text-sm md:text-base">Informasi lengkap pengumuman untuk mahasiswa</p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="glass-elevated p-8 md:p-10 animate-fade-in">
            <!-- Type Badge -->
            <div class="mb-6">
                @if($pengumuman->tipe === 'penting')
                    <span class="type-badge type-penting">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-2.694-.833-3.464 0L3.35 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                        Penting
                    </span>
                @else
                    <span class="type-badge type-umum">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Umum
                    </span>
                @endif
            </div>

            <!-- Title and Meta -->
            <div class="border-b border-slate-700/50 pb-8 mb-8">
                <h1 class="font-display text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6 leading-tight">{{ $pengumuman->judul }}</h1>
                
                <div class="flex flex-col sm:flex-row gap-4 sm:gap-8">
                    <div class="meta-info">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $pengumuman->created_at->format('d F Y, H:i') }}</span>
                    </div>
                    <div class="meta-info">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Admin YUWARAJA XVII</span>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="content-prose mb-10">
                {!! nl2br(e($pengumuman->konten)) !!}
            </div>

            <!-- Back Button -->
            <div class="pt-8 border-t border-slate-700/50">
                <a href="{{ url()->previous() }}" class="btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Kembali</span>
                </a>
            </div>
        </div>
    </div>
</div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Intersection Observer for animations
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, { 
                threshold: 0.1,
                rootMargin: '50px'
            });
            
            const elements = document.querySelectorAll('.animate-fade-in');
            elements.forEach(el => observer.observe(el));
            
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
@endsection