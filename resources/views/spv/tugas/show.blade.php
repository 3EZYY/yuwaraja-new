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

        .form-input {
            background-color: rgba(17, 24, 39, 0.8);
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            color: var(--text-primary);
            padding: 0.75rem 1rem;
            width: 100%;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .form-input:focus {
            outline: none;
            border-color: var(--brand-teal);
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
        }

        .submit-button {
            background: linear-gradient(135deg, var(--brand-teal), #0d9488);
            color: #000;
            font-weight: 700;
            text-transform: uppercase;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            border: none;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(20, 184, 166, 0.3);
        }

        .download-button {
            background: linear-gradient(135deg, var(--brand-gold), #d97706);
            color: #000;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }
        .download-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);
            color: #000;
            text-decoration: none;
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .status-pending { background: rgba(245, 158, 11, 0.2); color: #f59e0b; }
        .status-submitted { background: rgba(59, 130, 246, 0.2); color: #3b82f6; }
        .status-reviewed { background: rgba(34, 197, 94, 0.2); color: #22c55e; }
        .status-approved { background: rgba(34, 197, 94, 0.2); color: #22c55e; }
        .status-done { background: rgba(168, 85, 247, 0.2); color: #a855f7; }
    </style>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Header -->
            <div class="themed-card p-6 md:p-8 animate-on-scroll">
                <div class="flex items-center gap-4">
                    <span class="text-4xl">🎯</span>
                    <div>
                        <h1 class="font-display text-3xl font-bold text-white uppercase">Review Tugas</h1>
                        <p class="font-kanit text-gray-400 mt-1 text-sm tracking-wider">DETAIL & PENILAIAN PENGUMPULAN</p>
                    </div>
                </div>
            </div>

            <!-- Task Details -->
            <div class="themed-card animate-on-scroll">
                <div class="p-8">
                    <div class="border-b border-gray-700 pb-6 mb-8">
                        <h2 class="font-display text-2xl font-bold text-white mb-4 text-glow-gold-subtle">
                            {{ $pengumpulan->tugas->judul ?? 'Tugas Tidak Ditemukan' }}
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-teal-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <div>
                                        <p class="text-sm text-gray-400">Nama Mahasiswa</p>
                                        <p class="text-white font-semibold">{{ $pengumpulan->user->name ?? 'Tidak tersedia' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <div>
                                        <p class="text-sm text-gray-400">Kelompok</p>
                                        <p class="text-white font-semibold">{{ $pengumpulan->user->kelompok->nama ?? 'Belum ada kelompok' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <div>
                                        <p class="text-sm text-gray-400">Status Saat Ini</p>
                                        <span class="status-badge status-{{ strtolower($pengumpulan->status) }}">
                                            {{ ucfirst($pengumpulan->status) }}
                                        </span>
                                    </div>
                                </div>
                                @if($pengumpulan->file_path)
                                    <div class="flex items-center gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm text-gray-400">File Pengumpulan</p>
                                            <a href="{{ asset('storage/' . $pengumpulan->file_path) }}" target="_blank" class="download-button">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                Download File
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Review Form -->
                    <form action="{{ route('spv.tugas-mahasiswa.approve', $pengumpulan->id) }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nilai" class="block text-sm font-semibold text-gray-300 mb-2">Nilai (0-100)</label>
                                <input type="number" name="nilai" id="nilai" class="form-input" value="{{ old('nilai', $pengumpulan->nilai) }}" min="0" max="100" required>
                            </div>
                            <div>
                                <label for="status" class="block text-sm font-semibold text-gray-300 mb-2">Status</label>
                                <select name="status" id="status" class="form-input">
                                    <option value="reviewed" {{ $pengumpulan->status == 'reviewed' ? 'selected' : '' }}>Perlu Diteliti</option>
                                    <option value="approved" {{ $pengumpulan->status == 'approved' ? 'selected' : '' }}>Approve</option>
                                    <option value="done" {{ $pengumpulan->status == 'done' ? 'selected' : '' }}>Done/Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="keterangan" class="block text-sm font-semibold text-gray-300 mb-2">Keterangan/Feedback</label>
                            <textarea name="keterangan" id="keterangan" rows="4" class="form-input" placeholder="Berikan feedback atau keterangan untuk mahasiswa...">{{ old('keterangan', $pengumpulan->keterangan) }}</textarea>
                        </div>
                        <div class="flex justify-end pt-6 border-t border-gray-700">
                            <button type="submit" class="submit-button">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Simpan Review
                            </button>
                        </div>
                    </form>
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
