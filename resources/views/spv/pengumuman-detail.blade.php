@extends('layouts.app')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@600;700;900&display=swap');

        :root {
            --bg-main: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            --surface-card: rgba(15, 23, 42, 0.8);
            --surface-elevated: rgba(30, 41, 59, 0.9);
            --border-primary: rgba(20, 184, 166, 0.3);
            --border-secondary: rgba(148, 163, 184, 0.2);
            --accent-teal: #14b8a6;
            --accent-amber: #f59e0b;
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
            border-color: var(--accent-teal);
            box-shadow: 0 25px 50px -12px rgba(20, 184, 166, 0.25);
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
            background: linear-gradient(135deg, var(--accent-teal), var(--accent-amber));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-teal), var(--accent-amber));
            color: #0f172a;
            font-weight: 600;
            padding: 0.875rem 2rem;
            border-radius: 0.75rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            box-shadow: 0 10px 25px -5px rgba(20, 184, 166, 0.3);
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 40px -5px rgba(20, 184, 166, 0.4);
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
            background: rgba(20, 184, 166, 0.15);
            color: #5eead4;
            border: 1px solid rgba(20, 184, 166, 0.3);
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
                padding: 0.75rem 1.5rem;
                font-size: 0.875rem;
            }
        }
    </style>

    <div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto space-y-8">
            
            <!-- Header Section -->
            <div class="glass-card p-6 md:p-8 animate-fade-in">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-gradient-to-br from-teal-400 to-teal-600 rounded-2xl flex items-center justify-center shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                         <h1 class="font-display text-3xl md:text-4xl font-bold text-white mb-2">Detail Pengumuman</h1>
                         <p class="text-slate-400 text-lg">Informasi penting untuk seluruh anggota SPV</p>
                     </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="glass-card animate-fade-in" style="animation-delay: 0.2s;">
                <div class="p-6 md:p-10">
                    <!-- Announcement Type Badge -->
                    <div class="mb-6">
                        @if($pengumuman->tipe === 'penting')
                            <span class="type-badge type-penting">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.21 3.03-1.742 3.03H4.42c-1.532 0-2.492-1.696-1.742-3.03l5.58-9.92zM10 13a1 1 0 110-2 1 1 0 010 2zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
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

                    <!-- Title and Meta Information -->
                    <div class="border-b border-slate-700/50 pb-8 mb-8">
                        <h1 class="font-display text-3xl md:text-5xl font-bold text-white mb-6 leading-tight">{{ $pengumuman->judul }}</h1>
                        
                        <div class="flex flex-col sm:flex-row gap-4 sm:gap-8">
                            <div class="meta-info">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ $pengumuman->created_at->format('d F Y, H:i') }}</span>
                            </div>
                            <div class="meta-info">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>Admin YUWARAJA XVII</span>
                            </div>
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="glass-elevated p-6 md:p-8 mb-8">
                        <div class="content-prose">
                            {!! nl2br(e($pengumuman->konten)) !!}
                        </div>
                    </div>

                    <!-- Action Section -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-between items-start sm:items-center pt-6 border-t border-slate-700/50">
                        <a href="{{ route('spv.pengumuman.index') }}" class="btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali ke Daftar
                        </a>
                        
                        <div class="flex items-center gap-2 text-sm text-slate-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Terakhir diperbarui: {{ $pengumuman->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Smooth scroll animations
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, { 
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });
            
            const animatedElements = document.querySelectorAll('.animate-fade-in');
            animatedElements.forEach(el => observer.observe(el));
            
            // Add smooth scrolling for anchor links
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
