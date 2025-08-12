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
            padding: 0.75rem 1.5rem;
            font-size: 0.875rem;
        }
    }
</style>

<div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="glass-card p-8 mb-8 animate-fade-in">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <span class="type-badge type-umum">
                            <i class="fas fa-calendar-alt"></i>
                            Jadwal Acara
                        </span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl font-display font-bold gradient-text mb-3">
                        {{ $jadwal->nama_acara }}
                    </h1>
                    <div class="flex flex-wrap items-center gap-4 text-sm">
                        <div class="meta-info">
                            <i class="fas fa-calendar-alt"></i>
                            <span>{{ $jadwal->tanggal_mulai->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="meta-info">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $jadwal->lokasi ?? 'Online' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="glass-card p-8 mb-8 animate-fade-in">
            <div class="content-prose">
                <h2 class="text-xl font-semibold mb-4 gradient-text">Detail Acara</h2>
                @if($jadwal->deskripsi)
                <div>{!! nl2br(e($jadwal->deskripsi)) !!}</div>
                @else
                <p class="text-gray-400 italic">Tidak ada deskripsi untuk acara ini.</p>
                @endif

                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="glass-elevated p-6 text-center">
                        <div class="w-12 h-12 mx-auto mb-4 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <h3 class="font-semibold mb-2">Tanggal & Waktu</h3>
                        <p class="text-slate-300">{{ $jadwal->tanggal_mulai->format('d M Y, H:i') }}</p>
                    </div>

                    <div class="glass-elevated p-6 text-center">
                        <div class="w-12 h-12 mx-auto mb-4 bg-gradient-to-r from-cyan-400 to-blue-500 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" />
                            </svg>

                        </div>
                        <h3 class="font-semibold mb-2">Lokasi</h3>
                        <p class="text-slate-300">{{ $jadwal->lokasi ?? 'Online' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in">
            <a href="{{ url()->previous() }}" class="btn-primary">
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>
</div>

<script>
    // Smooth scroll animations
    document.addEventListener('DOMContentLoaded', function() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        // Observe all fade-in elements
        document.querySelectorAll('.animate-fade-in').forEach(el => {
            observer.observe(el);
        });

        // Handle anchor links with smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
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