@extends('layouts.app')

@section('content')
    {{-- CSS Kustom Minimal untuk Font dan Efek Khusus --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&family=Poppins:wght@600;700;900&display=swap');
        
        .font-display { font-family: 'Poppins', sans-serif; }
        .font-body { font-family: 'Kanit', sans-serif; }
        
        /* Efek Glow untuk Teks */
        .text-glow-teal {
            text-shadow: 0 0 15px theme('colors.teal.500 / 0.5');
        }
    </style>

<div class="font-body bg-gray-900 min-h-screen flex items-center justify-center px-4 py-12 sm:py-16" style="background-image: radial-gradient(circle at top, #1a202c, #0a0f14);">
    <main class="w-full max-w-lg">
        
        {{-- Kartu Utama --}}
        <div class="bg-gray-950/70 backdrop-blur-xl shadow-2xl rounded-2xl border border-teal-500/20 p-6 sm:p-8 md:p-10">

            {{-- Header --}}
            <header class="text-center mb-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-teal-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <h1 class="font-display text-3xl font-bold text-white text-glow-teal">Gabung Kelompok</h1>
                <p class="text-teal-200/60 mt-2">Masukkan kode unik untuk mengakses dashboard Anda.</p>
                  <!-- Info Box -->
                <div class="bg-cyan-900/20 border border-cyan-400/30 rounded-lg p-4 my-6">
                    <div class="flex items-start gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-cyan-400 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="text-left">
                            <p class="text-cyan-300 font-semibold text-sm">Setelah bergabung, Anda akan mendapatkan akses ke:</p>
                            <ul class="text-gray-300 text-sm mt-2 space-y-1">
                                <li>• Dashboard lengkap dengan informasi tugas</li>
                                <li>• Pengumuman dan jadwal kegiatan</li>
                                <li>• Informasi anggota kelompok dan supervisor</li>
                                <li>• Fitur pengumpulan tugas</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Alert Messages --}}
            @if(session('success')) <div class="bg-green-500/10 border border-green-500/30 text-green-300 text-sm p-3 rounded-lg mb-6 flex items-center gap-3"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg><span>{{ session('success') }}</span></div> @endif
            @if(session('info')) <div class="bg-blue-500/10 border border-blue-500/30 text-blue-300 text-sm p-3 rounded-lg mb-6 flex items-center gap-3"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg><span>{{ session('info') }}</span></div> @endif

            {{-- Form Penggabungan --}}
            <form method="POST" action="{{ route('mahasiswa.join-kelompok.submit') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="code" class="text-sm font-semibold text-gray-300 mb-2 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-teal-300" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 8a6 6 0 11-12 0 6 6 0 0112 0zM7 8a3 3 0 116 0 3 3 0 01-6 0z" clip-rule="evenodd" /><path d="M5.424 14.576a4 4 0 016.536 2.398A6.985 6.985 0 0110 18a6.985 6.985 0 01-3.06-1.026 4 4 0 012.484-2.398z" /><path fill-rule="evenodd" d="M12.293 18.293a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414zM18 19.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" clip-rule="evenodd" /></svg>
                        Kode Kelompok
                    </label>
                    <input type="text" 
                           name="code" 
                           id="code" 
                           maxlength="5" 
                           required 
                           placeholder="_ _ _ _ _"
                           class="w-full text-center px-4 py-3 bg-gray-900/50 border-2 border-gray-700 rounded-lg text-white placeholder-gray-500 focus:border-amber-400 focus:ring-2 focus:ring-amber-400/50 focus:outline-none transition-all duration-300 font-mono text-3xl tracking-[0.5em]"
                           style="text-transform: uppercase;">
                    @error('code')
                        <div class="mt-2 flex items-center gap-2 text-red-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span class="text-sm">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                
                <button type="submit" 
                        class="w-full bg-amber-400 text-black font-bold font-display py-3 px-6 rounded-lg hover:bg-amber-500 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-amber-400/25 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-950 focus:ring-amber-400">
                    <div class="flex items-center justify-center gap-2">
                        <span>Masuk ke Kelompok</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 -scale-x-100" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                    </div>
                </button>
            </form>
            
            <!-- Help Section -->
            <div class="mt-8 pt-6 border-t border-gray-800 text-center">
                <p class="text-gray-400 text-sm flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Tidak tahu kodenya?
                </p>
                <p class="text-gray-500 text-xs mt-1">Hubungi panitia atau supervisor kelompok Anda untuk bantuan.</p>
            </div>
        </div>
    </main>
</div>

    <script>
        // Auto uppercase dan format kode
        document.getElementById('code').addEventListener('input', function(e) {
            e.target.value = e.target.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
        });
    </script>
@endsection