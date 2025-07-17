@extends('layouts.app')

@section('content')
{{-- CSS Kustom Minimal untuk Font dan Efek Khusus --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&family=Poppins:wght@600;700;900&display=swap');

    .font-display {
        font-family: 'Poppins', sans-serif;
    }

    .font-body {
        font-family: 'Kanit', sans-serif;
    }

    .text-glow-teal {
        text-shadow: 0 0 12px theme('colors.teal.500 / 0.5');
    }

    .text-glow-amber {
        text-shadow: 0 0 12px theme('colors.amber.400 / 0.5');
    }

    .gradient-border {
        border: 1px solid transparent;
        background: linear-gradient(to right, theme('colors.gray.900'), theme('colors.gray.900')) padding-box,
            linear-gradient(135deg, theme('colors.teal.400'), theme('colors.amber.400')) border-box;
    }
</style>

<div class="font-body bg-[#050a0e] min-h-screen py-12 sm:py-16" style="background-image: radial-gradient(circle, #1a202c, #050a0e);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <header class="text-center mb-12">
            <h1 class="font-display text-4xl sm:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-b from-teal-600 to-amber-300 mb-2 text-glow-teal">
                MISSION CONTROL
            </h1>
            <p class="text-gray-100 text-base sm:text-lg">Akses & kumpulkan semua misi yang ditugaskan.</p>
        </header>

        <!-- Kontainer Utama -->
        <main class="bg-black/50 backdrop-blur-xl shadow-2xl rounded-2xl border border-teal-500/10">
            <div class="p-6 sm:p-8 md:p-10">

                @if(isset($listMode) && $listMode && isset($tugas))
                {{-- =================== TAMPILAN DAFTAR TUGAS =================== --}}
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8">
                    <h2 class="font-display text-2xl sm:text-3xl font-bold text-gray-50 flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Misi Aktif
                    </h2>
                    <p class="text-teal-200/70 text-sm mt-2 sm:mt-0">Ditemukan: <span class="font-bold text-amber-300">{{ $tugas->count() }}</span> misi</p>
                </div>

                @if($tugas->isEmpty())
                <div class="text-center py-16">
                    <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gray-900 flex items-center justify-center border-2 border-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>
                    <p class="font-display text-xl text-gray-400">Tidak Ada Misi Aktif</p>
                    <p class="text-gray-500 text-sm mt-2">Semua misi telah selesai atau belum ada yang ditugaskan.</p>
                </div>
                @else
                <div class="grid gap-6 md:grid-cols-1 lg:grid-cols-2">
                    @foreach($tugas as $item)
                    <a href="{{ route('mahasiswa.tugas.show', $item->id) }}" class="group block">
                        <div class="bg-gray-900/80 h-full p-6 rounded-xl border border-teal-500/50 hover:border-gray-700/50 hover:bg-gray-900 transition-all duration-300 shadow-lg hover:shadow-teal-500/10">
                            <div class="flex flex-col h-full">
                                <div class="flex-grow">
                                    <div class="flex items-start justify-between mb-3">
                                        <h3 class="font-display text-xl font-bold text-gray-50 group-hover:text-teal-500 transition-colors duration-300">{{ $item->judul }}</h3>
                                        @php $pengumpulan = $pengumpulanTugas[$item->id] ?? null; @endphp
                                        @if($pengumpulan)
                                        @if($pengumpulan->status == 'approved')
                                        <span class="text-xs font-bold py-1 px-3 rounded-full bg-green-500/10 text-green-400 border border-green-500/20">DISETUJUI</span>
                                        @else
                                        <span class="text-xs font-bold py-1 px-3 rounded-full bg-yellow-500/10 text-teal-500 border border-amber-500/20">DIKUMPULKAN</span>
                                        @endif
                                        @else
                                        <span class="text-xs font-bold py-1 px-3 rounded-full bg-red-500/10 text-red-400 border border-red-500/20">PENDING</span>
                                        @endif
                                    </div>
                                    <div class="flex items-center space-x-4 mb-5 text-sm">
                                        <div class="flex items-center gap-2 text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span>Deadline: <span class="font-semibold text-amber-300">{{ \Carbon\Carbon::parse($item->deadline)->format('d M Y') }}</span></span>
                                        </div>
                                        <div class="flex items-center gap-2 text-gray-400">
                                            @if($item->tipe == 'kelompok')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            @endif
                                            <span class="capitalize">{{ $item->tipe }}</span>
                                        </div>
                                        @if($item->file_path)
                                        <div class="flex items-center gap-2 text-cyan-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <span>Ada File</span>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-auto text-right text-white/70 text-sm font-semibold group-hover:text-amber-300 transition-colors">
                                    Buka Misi →
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                @endif

                @elseif(isset($detailMode) && $detailMode && isset($tugas))
                {{-- =================== TAMPILAN DETAIL TUGAS (REVISI) =================== --}}
                <div class="mb-8">
                    <a href="{{ route('mahasiswa.tugas.index') }}" class="inline-flex items-center gap-2 text-white hover:text-amber-300 transition-colors mb-6 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                        </svg>
                        Kembali ke Daftar Misi
                    </a>
                    <h1 class="font-display text-3xl md:text-4xl font-bold text-teal-200 text-glow-teal">{{ $tugas->judul }}</h1>
                    <div class="flex items-center gap-2 text-sm text-amber-300 mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.414-1.415L11 9.586V6z" clip-rule="evenodd" />
                        </svg>
                        <span>Deadline: {{ $tugas->deadline->format('d F Y, Pukul H:i') }} WIB</span>
                    </div>
                </div>

                {{-- Kolom Kiri: Detail Misi --}}
                <div class="lg:col-span-3 space-y-6">
                    <div class="mb-5">
                        <h3 class="font-display text-lg font-bold text-gray-50 mb-3 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                            </svg>
                            Deskripsi Misi
                        </h3>
                        <div class="prose prose-invert prose-sm max-w-none text-gray-300 bg-gray-950/70 p-4 rounded-lg border border-gray-800 normal-case">{!! nl2br(e($tugas->deskripsi)) !!}</div>
                    </div>
                    @if($tugas->file_path)
                    <div>
                        <h3 class="font-display text-lg font-bold text-gray-50 mb-3 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a3 3 0 10-6 0v4a3 3 0 11-6 0V7a1 1 0 011-1h1V4a1 1 0 112 0v1h1a1 1 0 112 0v1h1a1 1 0 011 1v2a1 1 0 11-2 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                            </svg>
                            Lampiran
                        </h3>
                        <a href="{{ Storage::url($tugas->file_path) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold bg-gray-700 hover:bg-gray-600 text-teal-200 rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Download File Tugas
                        </a>
                    </div>
                    @endif
                </div>

                {{-- Kolom Kanan: Panel Pengumpulan --}}
                <div class="lg:col-span-2 bg-gray-900/80 p-6 rounded-xl border border-gray-700/50">
                    <h2 class="font-display text-xl font-bold mb-5 text-white flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.414l-1.293 1.293a1 1 0 01-1.414-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L13 9.414V13H5.5z" />
                            <path d="M9 13h2v5a1 1 0 11-2 0v-5z" />
                        </svg>
                        Status & Pengumpulan
                    </h2>
                    @if(session('success')) <div class="bg-green-500/10 border border-green-500/30 text-green-300 text-sm p-3 rounded-lg mb-4 flex items-center gap-3"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg><span>{{ session('success') }}</span></div> @endif
                    @if(session('error')) <div class="bg-red-500/10 border border-red-500/30 text-red-300 text-sm p-3 rounded-lg mb-4 flex items-center gap-3"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg><span>{{ session('error') }}</span></div> @endif

                    @if(isset($pengumpulan) && $pengumpulan->file_path)
                    <div class="bg-gray-800 p-4 rounded-lg border border-gray-700 mb-4">
                        <p class="text-sm font-semibold text-teal-200 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            File Terkumpul
                        </p>
                        <a href="{{ Storage::url($pengumpulan->file_path) }}" target="_blank" class="text-amber-300 hover:underline text-sm truncate block mt-1 ml-7">{{ basename($pengumpulan->file_path) }}</a>
                    </div>
                    @endif

                    @if(now() <= $tugas->deadline)
                        <form action="{{ route('mahasiswa.tugas.submit', $tugas) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <div>
                                <label for="file" class="block text-sm font-semibold text-gray-300 mb-1">Upload File <span class="text-red-400">*</span></label>
                                <input type="file" id="file" name="file" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-teal-500/10 file:text-white hover:file:bg-teal-500/20 transition-colors cursor-pointer" accept=".pdf,.doc,.docx,.zip,.rar" required>
                                <p class="mt-1 text-xs text-gray-500">Maks: 10MB (PDF, DOC, ZIP, RAR)</p>
                                @error('file') <p class="text-sm text-red-400 mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="keterangan" class="block text-sm font-semibold text-gray-300 mb-1">Keterangan (Opsional)</label>
                                <textarea id="keterangan" name="keterangan" rows="3" class="block w-full border border-gray-700 bg-gray-800 text-white rounded-lg p-2 focus:ring-1 focus:ring-teal-400 focus:border-teal-400 transition" placeholder="Tinggalkan catatan jika perlu...">{{ old('keterangan', $pengumpulan->keterangan ?? '') }}</textarea>
                                @error('keterangan') <p class="text-sm text-red-400 mt-1">{{ $message }}</p> @enderror
                            </div>
                            <button type="submit" class="w-full px-6 py-3 bg-teal-500 hover:bg-teal-600 text-black font-bold rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-teal-500/20 font-display focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-teal-400">
                                {{ (isset($pengumpulan) && $pengumpulan->file_path) ? 'Kirim Versi Baru' : 'Kirim Misi' }}
                            </button>
                        </form>
                        @else
                        <div class="bg-red-900/30 border border-red-500/30 rounded-lg p-6 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-red-400 mb-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                            <p class="text-red-300 font-semibold font-display">Waktu Habis</p>
                            <p class="text-red-300/80 text-sm">Deadline telah berakhir. Pengumpulan ditutup.</p>
                        </div>
                        @endif
                </div>
                @else
                <div class="text-center text-gray-500 py-10">
                    <p>Mode tidak valid atau tidak ada data yang dapat ditampilkan.</p>
                </div>
                @endif
            </div>
        </main>

    </div>
</div>
@endsection