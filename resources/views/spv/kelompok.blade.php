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

        .kelompok-card {
            background: linear-gradient(135deg, var(--surface-card), #1f2937);
            border: 1px solid var(--border-color);
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .kelompok-card:hover {
            border-color: var(--brand-gold);
            box-shadow: 0 10px 30px rgba(245, 158, 11, 0.2);
            transform: translateY(-2px);
        }

        .member-card {
            background: rgba(17, 24, 39, 0.6);
            border: 1px solid rgba(20, 184, 166, 0.15);
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        .member-card:hover {
            border-color: var(--brand-teal);
            background: rgba(17, 24, 39, 0.8);
        }

        .form-input {
            background-color: rgba(17, 24, 39, 0.8);
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            color: var(--text-primary);
            padding: 0.5rem 1rem;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .form-input:focus {
            outline: none;
            border-color: var(--brand-teal);
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
        }

        .filter-button {
            background: linear-gradient(135deg, var(--brand-teal), #0d9488);
            color: #000;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            border: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .filter-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(20, 184, 166, 0.3);
        }

        .status-badge {
            background: rgba(34, 197, 94, 0.2);
            color: #22c55e;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .avatar {
            width: 3rem;
            height: 3rem;
            background: linear-gradient(135deg, var(--brand-teal), var(--brand-gold));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #000;
            font-size: 1.25rem;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Header -->
            <div class="themed-card p-6 md:p-8 animate-on-scroll">
                <div class="flex items-center gap-4">
                    <span class="text-4xl">👥</span>
                    <div>
                        <h1 class="font-display text-3xl font-bold text-white uppercase">Kelompok Bimbingan</h1>
                        <p class="font-kanit text-gray-400 mt-1 text-sm tracking-wider">DAFTAR KELOMPOK YANG DIBIMBING</p>
                    </div>
                </div>
            </div>

            <!-- Filter -->
            <div class="themed-card p-6 animate-on-scroll">
                <form method="GET" class="flex flex-wrap items-center gap-4">
                    <div class="flex items-center gap-2">
                        <label for="prodi" class="font-semibold text-gray-300">Filter Prodi:</label>
                        <select name="prodi" id="prodi" class="form-input w-56">
                            <option value="">Semua Prodi</option>
                            @foreach($prodiList ?? [] as $prodi)
                                <option value="{{ $prodi }}" {{ (isset($filterProdi) && $filterProdi == $prodi) ? 'selected' : '' }}>{{ $prodi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="filter-button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z" />
                        </svg>
                        Terapkan Filter
                    </button>
                </form>
            </div>

            <!-- Kelompok List -->
            <div class="space-y-6">
                @forelse($kelompokDibimbing as $index => $kelompok)
                    <div class="kelompok-card p-6 animate-on-scroll" style="animation-delay: {{ $index * 100 }}ms;">
                        <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-6">
                            <div class="flex-1">
                                <div class="flex items-start justify-between mb-6">
                                    <div>
                                        <h3 class="font-display text-2xl font-bold text-white mb-2 text-glow-gold-subtle">
                                            {{ $kelompok->nama_kelompok }}
                                        </h3>
                                        <div class="flex items-center gap-4 text-sm text-gray-400">
                                            <div class="flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                                <span>{{ $kelompok->mahasiswa->count() }} Anggota</span>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="status-badge">Aktif</span>
                                </div>

                                <!-- Anggota Kelompok -->
                                <div>
                                    <h4 class="font-display text-lg font-bold text-white mb-4 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                        </svg>
                                        Anggota Kelompok
                                    </h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        @foreach($kelompok->mahasiswa as $mahasiswa)
                                            <div class="member-card p-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="avatar">
                                                        {{ substr($mahasiswa->name, 0, 1) }}
                                                    </div>
                                                    <div class="flex-1">
                                                        <p class="font-semibold text-white">{{ $mahasiswa->name }}</p>
                                                        <p class="text-sm text-gray-400">{{ $mahasiswa->nim ?? 'NIM belum diisi' }}</p>
                                                        <p class="text-sm text-gray-400">{{ $mahasiswa->program_studi ?? 'Prodi belum diisi' }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="themed-card p-12 text-center animate-on-scroll">
                        <div class="text-6xl mb-4">👥</div>
                        <h3 class="font-display text-2xl font-bold text-white mb-2">Belum Ada Kelompok</h3>
                        <p class="text-gray-400">Anda belum diberi tanggung jawab untuk membimbing kelompok manapun.</p>
                    </div>
                @endforelse
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
