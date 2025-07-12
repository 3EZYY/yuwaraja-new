<x-app-layout>
    {{-- CSS Kustom untuk tema Cyberpunk Dashboard --}}
    <style>
        :root {
            --db-bg: #05060B;
            --db-surface: #0A0F1A;
            --db-primary: #00d1ff;
            --db-secondary: #ffc900;
            --db-text: #c0c8d6;
            --db-heading: #ffffff;
            --db-border: rgba(0, 209, 255, 0.15);
        }
        /* Mengubah warna background dasar dari layout Breeze */
        body { background-color: var(--db-bg) !important; }
        .text-glow-yellow { text-shadow: 0 0 8px rgba(255, 201, 0, 0.6); }
        .text-glow-cyan { text-shadow: 0 0 8px rgba(0, 209, 255, 0.6); }

        .cyber-card {
            background-color: var(--db-surface);
            border: 1px solid var(--db-border);
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .cyber-card:hover {
            transform: translateY(-4px);
            border-color: var(--db-primary);
            box-shadow: 0 0 20px rgba(0, 209, 255, 0.1);
        }
        .cyber-card::before {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 50px; height: 50px;
            background: radial-gradient(circle at top right, var(--db-primary), transparent 70%);
            opacity: 0.1;
            transition: all 0.3s ease;
        }
        .cyber-card:hover::before {
            opacity: 0.2;
            transform: scale(1.5);
        }
        .progress-bar-container {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 999px;
            overflow: hidden;
        }
        .progress-bar {
            background: linear-gradient(90deg, var(--db-primary), var(--db-secondary));
            transition: width 0.5s ease-in-out;
        }
        .cyber-table th {
            color: var(--db-primary);
            font-family: 'Rajdhani', sans-serif;
        }
        .cyber-table td {
            color: var(--db-text);
        }
        .cyber-table tr:hover td {
            background-color: rgba(0, 209, 255, 0.05);
        }
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.75rem;
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-glow-cyan font-orbitron text-white leading-tight">
            {{ __('MAHASISWA DASHBOARD') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Welcome & Profile Card -->
            <div class="cyber-card p-6 md:p-8 flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h3 class="text-3xl font-bold font-orbitron text-white">Selamat Datang, <span class="text-yellow-400">{{ $user->name }}</span>!</h3>
                    <p class="text-gray-400 mt-2">Status: <span class="font-semibold text-green-400">AKTIF</span> // PKKMB YUWARAJA 2025</p>
                </div>
                <div class="text-left md:text-right border-t md:border-t-0 md:border-l border-cyan-400/20 pt-4 md:pt-0 md:pl-6">
                    <p class="text-sm text-gray-400">Kelompok</p>
                    <p class="text-xl font-bold text-white">{{ $user->kelompok->nama_kelompok ?? 'Belum ada kelompok' }}</p>
                    <p class="text-sm text-gray-400 mt-2">Program Studi</p>
                    <p class="text-lg font-semibold text-cyan-400">{{ $user->program_studi ?? 'N/A' }}</p>
                </div>
            </div>

            <!-- Stats & Progress Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Tugas Selesai -->
                <div class="cyber-card p-6">
                    <p class="text-sm text-gray-400">Tugas Selesai</p>
                    <p class="text-4xl font-bold text-white my-2">
                        {{ $tugas->where('is_active', false)->count() }}<span class="text-2xl text-gray-500">/{{ $tugas->count() }}</span>
                    </p>
                    <div class="progress-bar-container h-2 w-full">
                        @php
                            $progress = $tugas->count() > 0 ? ($tugas->where('is_active', false)->count() / $tugas->count()) * 100 : 0;
                        @endphp
                        <div class="progress-bar h-full" style=""width: {{ $progress }}%;></div>
                    </div>
                </div>

                <!-- Pengumuman Baru -->
                <div class="cyber-card p-6">
                    <p class="text-sm text-gray-400">Pengumuman Baru</p>
                    <p class="text-4xl font-bold text-yellow-400 my-2">{{ $pengumuman->count() }}</p>
                    <p class="text-xs text-gray-500">Cek secara berkala!</p>
                </div>

                <!-- Jadwal Hari Ini -->
                <div class="cyber-card p-6">
                    <p class="text-sm text-gray-400">Jadwal Hari Ini</p>
                    @php
                        $jadwalHariIni = $jadwal->where('tanggal_mulai', '>=', now()->startOfDay())->where('tanggal_mulai', '<=', now()->endOfDay());
                    @endphp
                    <p class="text-4xl font-bold text-cyan-400 my-2">{{ $jadwalHariIni->count() }}</p>
                    <p class="text-xs text-gray-500">Kegiatan menantimu</p>
                </div>
                
                <!-- Tombol Absensi -->
                <div class="bg-yellow-400 p-6 rounded-lg flex flex-col items-center justify-center text-center text-black hover:bg-yellow-300 transition-colors cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" /></svg>
                    <p class="font-bold font-rajdhani text-lg uppercase">Absensi Kehadiran</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Pengumuman Terbaru (Kolom Utama) -->
                <div class="lg:col-span-2 cyber-card p-6">
                    <h3 class="text-lg font-bold text-white mb-4 text-glow-yellow">📢 PENGUMUMAN TERBARU</h3>
                    @if($pengumuman->count() > 0)
                        <div class="space-y-4">
                            @foreach($pengumuman as $announce)
                            <div class="border-l-4 border-yellow-400 pl-4 py-2 hover:bg-white/5 transition-colors">
                                <h4 class="font-bold text-white">{{ $announce->judul }}</h4>
                                <p class="text-sm text-gray-400 mt-1">{{ Str::limit($announce->konten, 150) }}</p>
                                <p class="text-xs text-gray-500 mt-2">{{ $announce->created_at->diffForHumans() }}</p>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 italic">// Belum ada transmisi terbaru //</p>
                    @endif
                </div>

                <!-- Jadwal Acara (Kolom Samping) -->
                <div class="cyber-card p-6">
                    <h3 class="text-lg font-bold text-white mb-4 text-glow-cyan">📅 JADWAL MENDATANG</h3>
                    @if($jadwal->count() > 0)
                        <div class="space-y-4">
                            @foreach($jadwal as $event)
                            <div class="border-l-4 border-cyan-400 pl-4 py-2">
                                <p class="text-xs text-cyan-400">{{ $event->tanggal_mulai->format('d M, H:i') }}</p>
                                <h4 class="font-semibold text-white">{{ $event->nama_acara }}</h4>
                                <p class="text-sm text-gray-400">{{ $event->lokasi ?? 'Online' }}</p>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 italic">// Jadwal belum di-deploy //</p>
                    @endif
                </div>
            </div>

            <!-- Daftar Tugas -->
            <div class="cyber-card">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-white text-glow-cyan mb-4">📝 DAFTAR MISI (TUGAS)</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full cyber-table">
                        <thead class="border-b border-t border-cyan-400/20">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Judul Misi</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Deadline</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Tipe</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800/50">
                            @forelse($tugas as $task)
                            <tr class="hover:bg-cyan-400/5">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold">
                                    <a href="{{ route('mahasiswa.tugas.show', $task->id) }}" class="text-white hover:text-yellow-400 hover:underline">
                                        {{ $task->judul }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $task->deadline->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="status-badge {{ $task->tipe == 'kelompok' ? 'bg-blue-900/50 text-blue-300 border border-blue-400/50' : 'bg-green-900/50 text-green-300 border border-green-400/50' }}">
                                        {{ ucfirst($task->tipe) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="status-badge {{ $task->is_active ? 'bg-yellow-900/50 text-yellow-300 border border-yellow-400/50' : 'bg-gray-700 text-gray-300 border border-gray-600' }}">
                                        {{ $task->is_active ? 'Aktif' : 'Selesai' }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500 italic">// Tidak ada misi aktif saat ini //</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>