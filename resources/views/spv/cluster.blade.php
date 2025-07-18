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
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <h1 class="font-display text-2xl sm:text-3xl font-bold text-teal-300 text-glow-teal flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 919.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        Jaringan Kelompok
                    </h1>
                    <p class="text-gray-400 mt-1">Kelompok: <span class="text-white font-semibold">Cluster Beta</span></p>

                    <!-- Profile Cluster dengan Upload Foto -->
                    <div class="mt-4 flex items-center gap-3">
                        <div class="relative group">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-teal-400 to-cyan-500 p-1 cursor-pointer" onclick="document.getElementById('profile-photo-input').click()">
                                <div class="w-full h-full rounded-full bg-gray-900 flex items-center justify-center relative overflow-hidden">
                                    <input type="file" id="profile-photo-input" accept="image/*" class="hidden" onchange="uploadProfilePhoto(this)">
                                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                </div>
                            </div>
                            <div class="absolute -bottom-1 -right-1 bg-teal-500 rounded-full p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-white">Profile Cluster</h3>
                            <p class="text-sm text-gray-400">Cluster Beta Network</p>
                        </div>
                    </div>
                </div>
                <a href="{{ route('spv.dashboard') }}" class="inline-flex items-center gap-2 text-sm text-amber-300 hover:text-amber-200 transition-colors group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" /></svg>
                    Kembali ke Dashboard
                </a>
            </div>
        </header>

        <!-- Alert Messages -->
        @if(session('success')) <div class="bg-green-500/10 border border-green-500/30 text-green-300 text-sm p-3 rounded-lg mb-6 flex items-center gap-3"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg><span>{{ session('success') }}</span></div> @endif
        @if(session('error')) <div class="bg-red-500/10 border border-red-500/30 text-red-300 text-sm p-3 rounded-lg mb-6 flex items-center gap-3"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg><span>{{ session('error') }}</span></div> @endif

        <div class="space-y-12">
            <!-- SPV Info Section -->
            <div>
                <h2 class="font-display text-xl font-bold text-white mb-4 flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" /></svg>
                    SPV
                </h2>
                <div class="bg-gray-900/50 p-6 rounded-xl border border-gray-700/50 flex items-center space-x-6">
                    @if(auth()->user()->photo)
                        <img src="{{ asset('profile-pictures/' . auth()->user()->photo) }}" alt="{{ auth()->user()->name }}" class="w-16 h-16 rounded-full border-2 border-cyan-400 flex-shrink-0">
                    @else
                        <div class="w-16 h-16 rounded-full bg-cyan-400 flex-shrink-0 flex items-center justify-center text-black font-bold text-2xl font-display">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    @endif
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-white">{{ auth()->user()->name }}</h3>
                        <p class="text-gray-400 text-sm">{{ auth()->user()->email }}</p>
                    </div>
                    <span class="text-xs font-bold py-1 px-3 rounded-full bg-cyan-500/10 text-cyan-300 border border-cyan-500/20">SUPERVISOR</span>
                </div>
            </div>

            <!-- Cluster List Section -->
            <div>
                <h2 class="font-display text-xl font-bold text-white mb-4 flex items-center gap-3">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 919.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    Anggota Kelompok
                </h2>
                @if(isset($kelompokDibimbing) && $kelompokDibimbing->count() > 0)
                    <div class="space-y-6">
                        @foreach($kelompokDibimbing as $kelompok)
                        <div class="bg-gray-900/50 p-6 rounded-xl border border-gray-700/50 hover:border-amber-400/50 hover:bg-gray-900 transition-all duration-300">
                            <div class="flex flex-col lg:flex-row gap-6">
                                <!-- Foto Cluster dengan Upload -->
                                @if($kelompok->photo)
                                <div class="lg:w-48 lg:flex-shrink-0 relative group">
                                    <img src="{{ asset('storage/' . $kelompok->photo) }}" alt="{{ $kelompok->nama_kelompok }}" class="w-full h-32 lg:h-40 object-cover rounded-lg border-2 border-amber-400/50">
                                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center gap-2">
                                        <button onclick="uploadClusterPhoto({{ $kelompok->id }})" class="bg-teal-500 hover:bg-teal-600 text-white p-2 rounded-lg transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </button>
                                        <button onclick="deleteClusterPhoto({{ $kelompok->id }})" class="bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                @else
                                <div class="lg:w-48 lg:flex-shrink-0">
                                    <div class="w-full h-32 lg:h-40 rounded-lg bg-gradient-to-br from-amber-400/20 to-amber-500/30 flex items-center justify-center text-amber-300 font-bold border-2 border-amber-400/50 cursor-pointer hover:bg-gradient-to-br hover:from-amber-400/30 hover:to-amber-500/40 transition-all duration-300 group" onclick="uploadClusterPhoto({{ $kelompok->id }})">
                                        <div class="text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <p class="text-sm font-semibold">Upload Foto</p>
                                            <p class="text-xs opacity-75">Klik untuk upload</p>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="flex-1">
                                    <div class="flex items-start justify-between mb-4">
                                        <div>
                                            <h3 class="text-xl font-bold text-white mb-2">{{ $kelompok->nama_kelompok }}</h3>
                                            <p class="text-gray-400 text-sm mb-2">{{ $kelompok->mahasiswa->count() }} Anggota</p>
                                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-semibold bg-green-500/10 text-green-400 border border-green-500/20">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                                Aktif
                                            </span>
                                        </div>
                                        <a href="{{ route('filament.admin.resources.cluster.edit', $kelompok->id) }}" class="inline-flex items-center gap-2 px-3 py-2 bg-amber-500/10 hover:bg-amber-500/20 border border-amber-500/30 hover:border-amber-500/50 text-amber-400 hover:text-amber-300 rounded-lg transition-all duration-200 text-sm font-medium">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                            Edit Cluster
                                        </a>
                                    </div>

                                    <!-- Anggota Cluster -->
                                    <div>
                                        <h4 class="font-display text-lg font-bold text-white mb-3 flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 515.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 919.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                            Anggota Cluster
                                        </h4>
                                        @if($kelompok->mahasiswa->count() > 0)
                                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                                                @foreach($kelompok->mahasiswa as $mahasiswa)
                                                <div class="bg-gray-900/50 text-center p-6 rounded-xl border border-gray-700/50 hover:border-amber-400/50 hover:bg-gray-900 transition-all duration-300 transform hover:-translate-y-1">
                                                    @if($mahasiswa->photo)
                                                        <img src="{{ asset('profile-pictures/' . $mahasiswa->photo) }}" alt="{{ $mahasiswa->name }}" class="w-20 h-20 rounded-full border-2 border-amber-400/50 mx-auto mb-4">
                                                    @else
                                                        <div class="w-20 h-20 rounded-full bg-amber-400/20 flex items-center justify-center text-amber-300 font-bold text-3xl font-display mx-auto mb-4 border-2 border-amber-400/50">{{ strtoupper(substr($mahasiswa->name, 0, 1)) }}</div>
                                                    @endif
                                                    
                                                    <h3 class="text-lg font-bold text-white mb-1 truncate">{{ $mahasiswa->name }}</h3>
                                                    <p class="text-gray-400 text-sm mb-4">{{ $mahasiswa->nim ?? 'NIM belum diisi' }}</p>
                                                    
                                                    <span class="inline-flex items-center gap-2 w-full justify-center px-3 py-2 rounded-lg text-sm font-semibold bg-green-500/10 text-green-400 border border-green-500/20">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                                        Mahasiswa Aktif
                                                    </span>
                                                </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="bg-gray-900/50 p-8 text-center rounded-xl border border-gray-700/50">
                                                <p class="text-gray-400">Belum ada anggota di cluster ini.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
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

<script>
// Upload Profile Photo (Header)
function uploadProfilePhoto(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        // Validasi file
        if (!file.type.startsWith('image/')) {
            alert('Harap pilih file gambar yang valid!');
            return;
        }
        
        if (file.size > 5 * 1024 * 1024) { // 5MB
            alert('Ukuran file terlalu besar! Maksimal 5MB.');
            return;
        }
        
        alert('Fitur upload foto profile akan segera tersedia!');
    }
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
