@extends('layouts.app')

@section('content')
    {{-- CSS Kustom Minimal untuk Font dan Efek Khusus --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&family=Poppins:wght@600;700;900&display=swap');

        .font-display { font-family: 'Poppins', sans-serif; }
        .font-body { font-family: 'Kanit', sans-serif; }

        /* Efek Glow untuk Teks */
        .text-glow-teal { text-shadow: 0 0 12px theme('colors.teal.500 / 0.5'); }
        .text-glow-amber { text-shadow: 0 0 12px theme('colors.amber.400 / 0.5'); }
    </style>

<div class="font-body bg-gray-900 min-h-screen py-12 sm:py-16" style="background-image: radial-gradient(circle at top, #1a202c, #0a0f14);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <header class="bg-gray-950/50 backdrop-blur-xl p-6 rounded-2xl mb-8 border border-teal-500/20">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="flex items-center gap-6">
                    <!-- Cluster Profile Photo -->
                    <div class="relative group">
                        @if(isset($kelompokDibimbing) && $kelompokDibimbing->count() > 0 && $kelompokDibimbing->first()->photo)
                            <img src="{{ asset('storage/' . $kelompokDibimbing->first()->photo) }}" alt="Cluster Profile" class="w-20 h-20 rounded-full border-3 border-teal-400/70 object-cover">
                            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-full flex items-center justify-center">
                                <button onclick="uploadClusterProfilePhoto()" class="bg-teal-500 hover:bg-teal-600 text-white p-2 rounded-full transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>
                            </div>
                        @else
                            <div class="w-20 h-20 rounded-full bg-teal-400/20 flex items-center justify-center text-teal-300 font-bold border-3 border-teal-400/50 cursor-pointer hover:bg-teal-400/30 transition-all duration-300 group" onclick="uploadClusterProfilePhoto()">
                                <div class="text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Header Text -->
                    <div>
                        <h1 class="font-display text-2xl sm:text-3xl font-bold text-teal-300 text-glow-teal flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 919.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            Jaringan Kelompok
                        </h1>
                        @if(isset($kelompokDibimbing) && $kelompokDibimbing->count() > 0)
                            <p class="text-gray-400 mt-1">Kelompok: <span class="text-amber-300 font-semibold">{{ $kelompokDibimbing->first()->nama_kelompok }}</span></p>
                            <p class="text-teal-300 text-sm mt-1 font-medium">Kode: {{ $kelompokDibimbing->first()->code }}</p>
                        @else
                            <p class="text-gray-400 mt-1">Kelompok: <span class="text-red-300 font-semibold">Belum ada kelompok</span></p>
                        @endif
                    </div>
                </div>
                
                <a href="{{ route('spv.dashboard') }}" class="inline-flex items-center gap-2 text-sm text-amber-300 hover:text-amber-200 transition-colors group lg:self-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>
        </header>

        <!-- Alert Messages -->
        @if(session('success')) <div class="bg-green-500/10 border border-green-500/30 text-green-300 text-sm p-3 rounded-lg mb-6 flex items-center gap-3"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg><span>{{ session('success') }}</span></div> @endif
        @if(session('error')) <div class="bg-red-500/10 border border-red-500/30 text-red-300 text-sm p-3 rounded-lg mb-6 flex items-center gap-3"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg><span>{{ session('error') }}</span></div> @endif

        <div class="space-y-8">
            <!-- SPV Info Section -->
            <div class="bg-gray-900/50 p-6 rounded-xl border border-gray-700/50">
                <h2 class="font-display text-xl font-bold text-white mb-4 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                    SPV
                </h2>
                <div class="flex items-center space-x-4">
                    <div class="relative group">
                        @if(auth()->user()->photo)
                            <img src="{{ asset('profile-pictures/' . auth()->user()->photo) }}" alt="{{ auth()->user()->name }}" class="w-16 h-16 rounded-full border-2 border-cyan-400 flex-shrink-0">
                            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-full flex items-center justify-center">
                                <button onclick="uploadProfilePhoto()" class="bg-cyan-500 hover:bg-cyan-600 text-white p-2 rounded-full transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>
                            </div>
                        @else
                            <div class="w-16 h-16 rounded-full bg-cyan-400/20 flex-shrink-0 flex items-center justify-center text-cyan-300 font-bold text-2xl font-display border-2 border-cyan-400/50 cursor-pointer hover:bg-cyan-400/30 transition-all duration-300 group" onclick="uploadProfilePhoto()">
                                <div class="text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-white">{{ auth()->user()->name }}</h3>
                        <p class="text-gray-400 text-sm">{{ auth()->user()->email }}</p>
                    </div>
                    <span class="text-xs font-bold py-2 px-3 rounded-full bg-cyan-500/10 text-cyan-300 border border-cyan-500/20">
                        SUPERVISOR
                    </span>
                </div>
            </div>

            <!-- Cluster List Section -->
            <div>
                <h2 class="font-display text-xl font-bold text-white mb-6 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 919.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Anggota Kelompok
                </h2>
                @if(isset($kelompokDibimbing) && $kelompokDibimbing->count() > 0)
                    <div class="space-y-6">
                        @foreach($kelompokDibimbing as $kelompok)
                        <div class="bg-gradient-to-br from-gray-900/80 to-gray-800/60 backdrop-blur-sm p-6 rounded-2xl border border-gray-700/30 hover:border-amber-400/40 hover:shadow-xl hover:shadow-amber-400/10 transition-all duration-300 group">
                            <!-- Header Cluster -->
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                                <div class="flex items-center gap-4">
                                    <!-- Icon Cluster -->
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-400/20 to-amber-600/20 flex items-center justify-center border border-amber-400/30 group-hover:scale-105 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 919.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    
                                    <!-- Info Cluster -->
                                    <div>
                                        <h3 class="text-xl font-bold text-white mb-1 group-hover:text-amber-300 transition-colors duration-300">{{ $kelompok->nama_kelompok }}</h3>
                                        <div class="flex items-center gap-3">
                                            <p class="text-gray-400 text-sm">{{ $kelompok->mahasiswa->count() }} Anggota</p>
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-500/15 text-green-400 border border-green-500/25">
                                                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                                Aktif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Action Button -->
                                <a href="{{ route('filament.admin.resources.cluster.edit', $kelompok->id) }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-amber-500/10 to-amber-600/10 hover:from-amber-500/20 hover:to-amber-600/20 border border-amber-500/30 hover:border-amber-400/50 text-amber-400 hover:text-amber-300 rounded-xl transition-all duration-300 text-sm font-medium group/btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 group-hover/btn:rotate-12 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit Cluster
                                </a>
                            </div>

                            <!-- Anggota Cluster -->
                            <div>
                                <h4 class="font-display text-lg font-bold text-white mb-4 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                    </svg>
                                    Anggota Cluster
                                </h4>
                                @if($kelompok->mahasiswa->count() > 0)
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                                        @foreach($kelompok->mahasiswa as $mahasiswa)
                                        <div class="bg-gradient-to-br from-gray-800/60 to-gray-700/40 backdrop-blur-sm p-4 rounded-xl border border-gray-600/30 hover:border-amber-400/40 hover:shadow-lg hover:shadow-amber-400/5 transition-all duration-300 transform hover:-translate-y-1 group/member">
                                            <!-- Avatar -->
                                            <div class="flex flex-col items-center text-center">
                                                @if($mahasiswa->photo)
                                                    <div class="relative mb-3">
                                                        <img src="{{ asset('profile-pictures/' . $mahasiswa->photo) }}" alt="{{ $mahasiswa->name }}" class="w-16 h-16 rounded-full border-2 border-amber-400/50 group-hover/member:border-amber-400 transition-colors duration-300 object-cover">
                                                        <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-2 border-gray-800 flex items-center justify-center">
                                                            <div class="w-2 h-2 bg-white rounded-full"></div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="relative mb-3">
                                                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-amber-400/20 to-amber-600/20 flex items-center justify-center text-amber-300 font-bold text-xl font-display border-2 border-amber-400/50 group-hover/member:border-amber-400 transition-colors duration-300">
                                                            {{ strtoupper(substr($mahasiswa->name, 0, 1)) }}
                                                        </div>
                                                        <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-2 border-gray-800 flex items-center justify-center">
                                                            <div class="w-2 h-2 bg-white rounded-full"></div>
                                                        </div>
                                                    </div>
                                                @endif
                                                
                                                <!-- Info Mahasiswa -->
                                                <div class="w-full">
                                                    <h3 class="text-base font-bold text-white mb-1 truncate group-hover/member:text-amber-300 transition-colors duration-300">{{ $mahasiswa->name }}</h3>
                                                    <p class="text-gray-400 text-xs mb-3 font-mono">{{ $mahasiswa->nim ?? 'NIM belum diisi' }}</p>
                                                    
                                                    <!-- Status Badge -->
                                                    <div class="inline-flex items-center gap-1.5 w-full justify-center px-3 py-1.5 rounded-lg text-xs font-semibold bg-green-500/15 text-green-400 border border-green-500/25">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                        </svg>
                                                        Aktif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="bg-gradient-to-br from-gray-800/40 to-gray-700/20 backdrop-blur-sm p-8 text-center rounded-xl border border-gray-600/30">
                                        <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-700/50 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM3 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 019.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-lg font-semibold text-gray-300 mb-2">Belum Ada Anggota</h3>
                                        <p class="text-gray-400 text-sm">Cluster ini belum memiliki anggota yang terdaftar.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-gray-900/50 p-8 text-center rounded-xl border border-gray-700/50">
                        <div class="text-6xl mb-4">🏢</div>
                        <h3 class="font-display text-2xl font-bold text-white mb-2">Belum Ada Cluster</h3>
                        <p class="text-gray-400">Anda belum diberi tanggung jawab untuk membimbing cluster manapun.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Hidden File Input untuk Upload -->
<input type="file" id="cluster-photo-input" accept="image/*" class="hidden">
<input type="file" id="profile-photo-input" accept="image/*" class="hidden">
<input type="file" id="cluster-profile-photo-input" accept="image/*" class="hidden">

<script>
// Upload Cluster Profile Photo (Header)
function uploadClusterProfilePhoto() {
    @if(isset($kelompokDibimbing) && $kelompokDibimbing->count() > 0)
        const kelompokId = {{ $kelompokDibimbing->first()->id }};
        const input = document.getElementById('cluster-profile-photo-input');
        input.onchange = function(e) {
            const file = e.target.files[0];
            if (!file) return;
            
            // Validasi file
            if (!file.type.startsWith('image/')) {
                alert('Harap pilih file gambar yang valid!');
                return;
            }
            
            if (file.size > 5 * 1024 * 1024) { // 5MB
                alert('Ukuran file terlalu besar! Maksimal 5MB.');
                return;
            }
            
            // Upload file
            const formData = new FormData();
            formData.append('photo', file);
            formData.append('kelompok_id', kelompokId);
            formData.append('_token', '{{ csrf_token() }}');
            
            // Show loading
            const loadingDiv = document.createElement('div');
            loadingDiv.innerHTML = `
                <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
                    <div class="bg-gray-800 p-6 rounded-lg text-white text-center">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-teal-400 mx-auto mb-4"></div>
                        <p>Mengupload foto cluster...</p>
                    </div>
                </div>
            `;
            document.body.appendChild(loadingDiv);
            
            fetch('{{ route("spv.cluster.upload-photo") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                document.body.removeChild(loadingDiv);
                
                if (data.success) {
                    alert(data.message);
                    location.reload(); // Refresh halaman untuk menampilkan foto baru
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                document.body.removeChild(loadingDiv);
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengupload foto cluster.');
            });
            
            // Reset input
            input.value = '';
        };
        
        input.click();
    @else
        alert('Tidak ada cluster yang tersedia untuk diupload foto.');
    @endif
}
// Upload Profile Photo
function uploadProfilePhoto() {
    const input = document.getElementById('profile-photo-input');
    input.onchange = function(e) {
        const file = e.target.files[0];
        if (!file) return;
        
        // Validasi file
        if (!file.type.startsWith('image/')) {
            alert('Harap pilih file gambar yang valid!');
            return;
        }
        
        if (file.size > 5 * 1024 * 1024) { // 5MB
            alert('Ukuran file terlalu besar! Maksimal 5MB.');
            return;
        }
        
        // Upload file
        const formData = new FormData();
        formData.append('photo', file);
        formData.append('_token', '{{ csrf_token() }}');
        
        // Show loading
        const loadingDiv = document.createElement('div');
        loadingDiv.innerHTML = `
            <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
                <div class="bg-gray-800 p-6 rounded-lg text-white text-center">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-cyan-400 mx-auto mb-4"></div>
                    <p>Mengupload foto profile...</p>
                </div>
            </div>
        `;
        document.body.appendChild(loadingDiv);
        
        fetch('{{ route("profile.upload-photo") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            document.body.removeChild(loadingDiv);
            
            if (data.success) {
                alert(data.message);
                location.reload(); // Refresh halaman untuk menampilkan foto baru
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            document.body.removeChild(loadingDiv);
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengupload foto profile.');
        });
        
        // Reset input
        input.value = '';
    };
    
    input.click();
}

// Upload Cluster Photo
function uploadClusterPhoto(kelompokId) {
    const input = document.getElementById('cluster-photo-input');
    input.onchange = function(e) {
        const file = e.target.files[0];
        if (!file) return;
        
        // Validasi file
        if (!file.type.startsWith('image/')) {
            alert('Harap pilih file gambar yang valid!');
            return;
        }
        
        if (file.size > 5 * 1024 * 1024) { // 5MB
            alert('Ukuran file terlalu besar! Maksimal 5MB.');
            return;
        }
        
        // Upload file
        const formData = new FormData();
        formData.append('photo', file);
        formData.append('kelompok_id', kelompokId);
        formData.append('_token', '{{ csrf_token() }}');
        
        // Show loading
        const loadingDiv = document.createElement('div');
        loadingDiv.innerHTML = `
            <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
                <div class="bg-gray-800 p-6 rounded-lg text-white text-center">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-teal-400 mx-auto mb-4"></div>
                    <p>Mengupload foto...</p>
                </div>
            </div>
        `;
        document.body.appendChild(loadingDiv);
        
        fetch('{{ route("spv.cluster.upload-photo") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            document.body.removeChild(loadingDiv);
            
            if (data.success) {
                alert(data.message);
                location.reload(); // Refresh halaman untuk menampilkan foto baru
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            document.body.removeChild(loadingDiv);
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengupload foto.');
        });
        
        // Reset input
        input.value = '';
    };
    
    input.click();
}

// Delete Cluster Photo
function deleteClusterPhoto(kelompokId) {
    if (!confirm('Apakah Anda yakin ingin menghapus foto cluster ini?')) {
        return;
    }
    
    const formData = new FormData();
    formData.append('kelompok_id', kelompokId);
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('_method', 'DELETE');
    
    // Show loading
    const loadingDiv = document.createElement('div');
    loadingDiv.innerHTML = `
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="bg-gray-800 p-6 rounded-lg text-white text-center">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-red-400 mx-auto mb-4"></div>
                <p>Menghapus foto...</p>
            </div>
        </div>
    `;
    document.body.appendChild(loadingDiv);
    
    fetch('{{ route("spv.cluster.delete-photo") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        document.body.removeChild(loadingDiv);
        
        if (data.success) {
            alert(data.message);
            location.reload(); // Refresh halaman
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        document.body.removeChild(loadingDiv);
        console.error('Error:', error);
        alert('Terjadi kesalahan saat menghapus foto.');
    });
}
</script>
@endsection
