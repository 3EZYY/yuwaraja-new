<!-- Detail Tugas -->
<div class="bg-gray-700/60 border border-gray-600 rounded-lg shadow-lg p-6 mb-6">
    <div class="flex flex-col md:flex-row justify-between md:items-start gap-6">
        <div class="flex-grow">
            <div class="flex flex-wrap items-center gap-x-4 gap-y-2 mb-4">
                <h2 class="font-kanit text-2xl lg:text-3xl font-semibold text-white">
                    {{ $tugas->judul }}
                </h2>
            </div>

            <p class="font-poppins text-gray-300 text-sm leading-relaxed mb-6">
                {!! nl2br(e($tugas->deskripsi)) !!}
            </p>

            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-sm">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-teal-400/70 flex-shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <div>
                        <div class="text-gray-400">Deadline</div>
                        <div class="font-semibold text-white">
                            {{ \Carbon\Carbon::parse($tugas->deadline)->format('d M Y, H:i') }}</div>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-teal-400/70 flex-shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 8v5m0 0v2.5m0-2.5h2.5m-2.5 0H9.5" />
                    </svg>
                    <div>
                        <div class="text-gray-400">Poin</div>
                        <div class="font-semibold text-white">{{ $tugas->poin ?? 100 }} Poin</div>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    @if(\Carbon\Carbon::parse($tugas->deadline)->isPast())
                        <svg class="w-6 h-6 text-red-400/70 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <div class="text-gray-400">Status</div>
                            <div class="font-semibold text-red-400">Berakhir</div>
                        </div>
                    @else
                        <svg class="w-6 h-6 text-green-400/70 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <div class="text-gray-400">Status</div>
                            <div class="font-semibold text-green-400">Aktif</div>
                        </div>
                    @endif
                </div>
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                    </svg>
                    <div>
                        <div class="text-gray-400">Pengumpulan</div>
                        <div class="font-semibold text-white">{{ $pengumpulans->total() }} Mahasiswa</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Daftar Pengumpulan -->
<div class="bg-gray-700/60 border border-gray-600 rounded-lg shadow-lg overflow-hidden">
    <div class="p-6 border-b border-gray-600">
        <h3 class="font-kanit text-xl font-semibold text-white">Pengumpulan Tugas</h3>
        <p class="text-gray-400 text-sm mt-1">Daftar mahasiswa yang telah mengumpulkan tugas</p>
    </div>

    <div class="max-h-96 overflow-y-auto">
        @forelse($pengumpulans as $pengumpulan)
            <div class="p-6 border-b border-gray-600/50 hover:bg-gray-600/30 transition-colors">
                <div class="flex flex-col md:flex-row justify-between md:items-center gap-4">
                    <div class="flex-grow">
                        <div class="flex items-center gap-4 mb-3">
                            <div
                                class="w-10 h-10 bg-teal-500 rounded-full flex items-center justify-center text-black font-semibold">
                                {{ substr($pengumpulan->user->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-semibold text-white">{{ $pengumpulan->user->name }}</h4>
                                <p class="text-sm text-gray-400">{{ $pengumpulan->user->email }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                            <div>
                                <span class="text-gray-400">Cluster:</span>
                                <span
                                    class="text-white font-medium">{{ $pengumpulan->user->kelompok->nama ?? 'Belum ada Cluster' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-400">Dikumpulkan:</span>
                                <span
                                    class="text-white font-medium">{{ $pengumpulan->submitted_at ? $pengumpulan->submitted_at->format('d M Y, H:i') : '-' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-400">Status:</span>
                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                    @if($pengumpulan->status == 'pending') bg-yellow-900/50 text-yellow-300
                                    @elseif($pengumpulan->status == 'submitted') bg-blue-900/50 text-blue-300
                                    @elseif($pengumpulan->status == 'reviewed') bg-green-900/50 text-green-300
                                    @elseif($pengumpulan->status == 'approved') bg-green-900/50 text-green-300
                                    @elseif($pengumpulan->status == 'done') bg-purple-900/50 text-purple-300
                                    @else bg-gray-900/50 text-gray-300
                                    @endif">
                                    {{ ucfirst($pengumpulan->status) }}
                                </span>
                            </div>
                            <div>
                                <span class="text-gray-400">Nilai:</span>
                                <span class="text-white font-medium">{{ $pengumpulan->nilai ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-2">
                        @if($pengumpulan->file_path)
                            <a href="{{ route('spv.tugas.pengumpulan.download', $pengumpulan->id) }}"
                                class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-400 text-black px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Download
                            </a>
                        @endif
                        <a href="{{ route('spv.tugas.pengumpulan.show', $pengumpulan->id) }}" target="_blank"
                            class="inline-flex items-center gap-2 bg-teal-500 hover:bg-teal-400 text-black px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Review
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-12 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="font-kanit text-xl font-semibold text-white mb-2">Belum Ada Pengumpulan</h3>
                <p class="text-gray-400">Belum ada mahasiswa yang mengumpulkan tugas ini.</p>
            </div>
        @endforelse
    </div>

    @if($pengumpulans->hasPages())
        <div class="p-6 border-t border-gray-600">
            {{ $pengumpulans->links() }}
        </div>
    @endif
</div>