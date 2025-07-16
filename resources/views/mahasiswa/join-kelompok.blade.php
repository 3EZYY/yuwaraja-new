@extends('layouts.app')

@section('content')
    {{-- CSS Kustom untuk tema Cyberpunk --}}
    <style>
        :root {
            --db-bg: #0b101a;
            --db-surface: #181825;
            --db-primary: #00d1ff;
            --db-secondary: #ffc900;
            --db-text: #c0c8d6;
            --db-heading: #ffffff;
            --db-border: rgba(0, 209, 255, 0.15);
        }
        body { background-color: var(--db-bg) !important; }
        .cyber-card {
            background-color: var(--db-surface);
            border: 1px solid var(--db-border);
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .cyber-card:hover {
            border-color: var(--db-primary);
            box-shadow: 0 0 20px rgba(0, 209, 255, 0.1);
        }
        .text-glow-yellow { text-shadow: 0 0 8px rgba(255, 201, 0, 0.6); }
        .text-glow-cyan { text-shadow: 0 0 8px rgba(0, 209, 255, 0.6); }
    </style>

    <div class="py-12" style="background-color: #0b101a; min-height: 100vh;">
        <div class="max-w-md mx-auto px-6">
            <!-- Welcome Card -->
            <div class="cyber-card p-8 mb-8 text-center">
                <div class="mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-yellow-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h2 class="text-3xl font-bold text-white text-glow-yellow mb-4">BERGABUNG DENGAN KELOMPOK</h2>
                <p class="text-gray-400 mb-6">Masukkan kode kelompok untuk mengakses dashboard dan fitur lengkap PKKMB YUWARAJA XVII</p>
                
                <!-- Info Box -->
                <div class="bg-cyan-900/20 border border-cyan-400/30 rounded-lg p-4 mb-6">
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
            </div>

            <!-- Form Card -->
            <div class="cyber-card p-8">
                @if(session('success'))
                    <div class="bg-green-900/20 border border-green-400/30 rounded-lg p-4 mb-6">
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-green-300 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('info'))
                    <div class="bg-blue-900/20 border border-blue-400/30 rounded-lg p-4 mb-6">
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-blue-300 font-medium">{{ session('info') }}</p>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('mahasiswa.join-kelompok.submit') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="code" class="block text-sm font-bold text-cyan-400 mb-3 text-glow-cyan">KODE KELOMPOK</label>
                        <input type="text" 
                               name="code" 
                               id="code" 
                               maxlength="5" 
                               required 
                               placeholder="Masukkan 5 digit kode"
                               class="w-full px-4 py-3 bg-gray-900/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20 focus:outline-none transition-all duration-300"
                               style="text-transform: uppercase; letter-spacing: 2px; font-family: monospace;">
                        @error('code')
                            <div class="mt-2 flex items-center gap-2 text-red-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-sm">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-yellow-400 to-yellow-500 text-black font-bold py-3 px-6 rounded-lg hover:from-yellow-300 hover:to-yellow-400 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-yellow-400/25">
                        <div class="flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span>BERGABUNG SEKARANG</span>
                        </div>
                    </button>
                </form>
                
                <!-- Help Section -->
                <div class="mt-8 pt-6 border-t border-gray-700">
                    <p class="text-gray-400 text-sm text-center mb-3">Butuh bantuan?</p>
                    <div class="text-center space-y-2">
                        <p class="text-gray-500 text-xs">Hubungi panitia PKKMB atau supervisor kelompok Anda</p>
                        <p class="text-gray-500 text-xs">untuk mendapatkan kode kelompok yang valid</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto uppercase dan format kode
        document.getElementById('code').addEventListener('input', function(e) {
            e.target.value = e.target.value.toUpperCase();
        });
    </script>
@endsection
