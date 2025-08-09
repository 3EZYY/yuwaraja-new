@extends('layouts.mahasiswa')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black py-6 lg:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Cyberpunk -->
        <div class="mb-6 lg:mb-8">
            <div class="relative overflow-hidden bg-gradient-to-r from-cyan-600 via-cyan-600 to-cyan-700 rounded-2xl p-6 lg:p-8 shadow-2xl border border-cyan-400/30">
                <!-- Animated Background Pattern -->
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/10 via-transparent to-cyan-700/10"></div>
                
                <!-- Glowing Border Effect -->
                <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-cyan-400/50 to-cyan-700/50 blur-sm"></div>
                <div class="absolute inset-[2px] rounded-2xl bg-gradient-to-r from-cyan-600 via-cyan-600 to-cyan-700"></div>
                
                <!-- Content -->
                <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between text-white">
                    <div class="mb-4 lg:mb-0">
                        <div class="flex items-center mb-3">
                            <div class="bg-cyan-400/20 backdrop-blur-sm rounded-xl p-3 mr-4 border border-cyan-300/30">
                                <i class="fas fa-calendar-check text-2xl text-cyan-300"></i>
                            </div>
                            <div>
                                <h1 class="text-2xl lg:text-3xl font-bold bg-gradient-to-r from-cyan-200 to-cyan-200 bg-clip-text text-transparent">
                                    SISTEM ABSENSI
                                </h1>
                                <div class="text-base text-cyan-100/80 mt-1">Kelola Kehadiran dan Riwayat Absensi</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <div class="bg-black/20 backdrop-blur-md rounded-xl p-4 lg:p-6 shadow-2xl">
                            <div class="text-center">
                                <div class="bg-yellow-500 text-white text-lg lg:text-xl font-bold rounded-lg px-4 py-2 mb-2">
                                    MAHASISWA
                                </div>
                                <div class="text-xs lg:text-sm text-white font-medium uppercase tracking-wide">
                                    <i class="fas fa-user mr-1"></i>STATUS AKTIF
                                </div>
                            </div>
                        </div>
                        
                        <!-- Glowing Effect -->
                        <div class="absolute -inset-1 bg-gradient-to-r from-cyan-400/30 to-cyan-700/30 rounded-xl blur opacity-75"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pesan Alert - Cyberpunk Style -->
        @if(session('success'))
            <div class="bg-gradient-to-r from-green-500/20 to-emerald-500/20 border border-green-400/50 text-green-300 px-6 py-4 rounded-xl mb-6 shadow-lg backdrop-blur-sm">
                <div class="flex items-center">
                    <div class="bg-green-400/20 rounded-lg p-2 mr-4">
                        <i class="fas fa-check-circle text-green-400 text-lg"></i>
                    </div>
                    <div>
                        <div class="font-semibold text-green-200">Operasi Berhasil</div>
                        <div class="text-sm text-green-300/80">{{ session('success') }}</div>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-gradient-to-r from-red-500/20 to-pink-500/20 border border-red-400/50 text-red-300 px-6 py-4 rounded-xl mb-6 shadow-lg backdrop-blur-sm">
                <div class="flex items-center">
                    <div class="bg-red-400/20 rounded-lg p-2 mr-4">
                        <i class="fas fa-exclamation-triangle text-red-400 text-lg"></i>
                    </div>
                    <div>
                        <div class="font-semibold text-red-200">Kesalahan Sistem</div>
                        <div class="text-sm text-red-300/80">{{ session('error') }}</div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Absensi Tersedia - Cyberpunk Grid -->
        <div class="bg-gradient-to-br from-slate-800/50 to-slate-900/50 border border-yellow-400/20 rounded-xl shadow-2xl backdrop-blur-sm p-6 mb-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-cyan-400 mb-2">
                    <i class="fas fa-calendar-check mr-3 text-cyan-400"></i>
                    Absensi Tersedia
                </h2>
                <div class="w-20 h-1 bg-gradient-to-r from-cyan-400 to-cyan-500 rounded-full"></div>
            </div>
            
            @if($absensiAktif->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($absensiAktif as $absensi)
                    @php
                        $userRequest = $absensi->absensiMahasiswa()->where('user_id', auth()->id())->first();
                        $now = now();
                        $tanggalString = $absensi->tanggal instanceof \Carbon\Carbon ? $absensi->tanggal->format('Y-m-d') : $absensi->tanggal;
                        $tanggalAbsensi = \Carbon\Carbon::parse($tanggalString . ' ' . $absensi->jam_mulai);
                        $batasAbsensi = \Carbon\Carbon::parse($tanggalString . ' ' . $absensi->jam_selesai);
                        $canAttend = $now->between($tanggalAbsensi, $batasAbsensi);
                    @endphp
                    
                    <div class="bg-gradient-to-br from-slate-700/50 to-slate-800/50 border border-slate-600/50 rounded-xl p-6 hover:border-yellow-400/50 transition-all duration-300 shadow-lg hover:shadow-cyan-500/20 transform hover:scale-105 backdrop-blur-sm">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="font-bold text-white text-lg">{{ $absensi->judul }}</h3>
                            @if($userRequest)
                                @if($userRequest->status === 'pending')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-cyan-700/20 text-cyan-700 border border-yellow-700/30">
                                        <i class="fas fa-clock mr-1"></i>Pending
                                    </span>
                                @elseif($userRequest->status === 'approved')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-400/20 text-green-300 border border-green-400/30">
                                        <i class="fas fa-check mr-1"></i>Hadir
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-400/20 text-red-300 border border-red-400/30">
                                        <i class="fas fa-times mr-1"></i>Ditolak
                                    </span>
                                @endif
                            @endif
                        </div>
                        
                        <div class="text-sm text-gray-300 space-y-3 mb-4">
                            <div class="flex items-center bg-slate-600/30 p-2 rounded-lg">
                                <i class="fas fa-calendar mr-2 text-cyan-400"></i>
                                <span>{{ $absensi->tanggal instanceof \Carbon\Carbon ? $absensi->tanggal->format('d M Y') : \Carbon\Carbon::parse($absensi->tanggal)->format('d M Y') }}</span>
                            </div>
                            <div class="flex items-center bg-slate-600/30 p-2 rounded-lg">
                                <i class="fas fa-clock mr-2 text-cyan-700"></i>
                                <span>{{ $absensi->jam_mulai_formatted }} - {{ $absensi->jam_selesai_formatted }}</span>
                            </div>
                            @if($absensi->deskripsi)
                            <div class="bg-slate-600/20 p-3 rounded-lg border border-slate-500/30">
                                <p class="text-xs text-gray-400">{{ Str::limit($absensi->deskripsi, 100) }}</p>
                            </div>
                            @endif
                        </div>



                        <!-- Action Button - Cyberpunk Style -->
                        <div class="mt-4">
                            @if(!$userRequest)
                                <button onclick="openAbsensiModal({{ $absensi->id }}, '{{ $absensi->judul }}')" 
                                        class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold py-3 px-4 rounded-lg transition-all duration-300 shadow-lg hover:shadow-green-500/25 transform hover:scale-105">
                                    <i class="fas fa-hand-paper mr-2"></i>Absen Sekarang
                                </button>
                            @elseif($userRequest)
                                <div class="text-center text-sm text-gray-300 bg-slate-600/30 p-3 rounded-lg">
                                    @if($userRequest->status === 'pending')
                                        <i class="fas fa-hourglass-half mr-1 text-cyan-700"></i>Menunggu Persetujuan SPV
                                    @elseif($userRequest->status === 'approved')
                                        <i class="fas fa-check-circle mr-1 text-green-400"></i>Absensi Telah Disetujui
                                    @else
                                        <i class="fas fa-times-circle mr-1 text-red-400"></i>Absensi Ditolak
                                        @if($userRequest->keterangan)
                                            <div class="text-xs text-red-400 mt-1">{{ $userRequest->keterangan }}</div>
                                        @endif
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-16 text-gray-400">
                    <div class="bg-slate-700/30 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-calendar-times text-4xl text-gray-500"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-300">Tidak Ada Absensi Aktif</h3>
                    <p class="text-sm text-gray-400">Belum ada absensi yang tersedia saat ini</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Riwayat Absensi - Cyberpunk Table -->
        <div class="bg-gradient-to-br from-slate-800/50 to-slate-900/50 border border-yellow-400/20 rounded-xl shadow-2xl backdrop-blur-sm p-6">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-cyan-400 mb-2">
                    <i class="fas fa-history mr-3 text-green-400"></i>
                    Riwayat Absensi
                </h2>
                <div class="w-20 h-1 bg-gradient-to-r from-green-400 to-cyan-500 rounded-full"></div>
            </div>
            
            @if($riwayatAbsensi->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b border-yellow-400/30">
                                <th class="px-6 py-4 text-left text-sm font-bold text-cyan-400 uppercase tracking-wider bg-slate-700/30 first:rounded-l-lg">
                                    Acara
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-cyan-400 uppercase tracking-wider bg-slate-700/30">
                                    Tanggal
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-cyan-400 uppercase tracking-wider bg-slate-700/30">
                                    Waktu Request
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-cyan-400 uppercase tracking-wider bg-slate-700/30">
                                    Status
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-bold text-cyan-400 uppercase tracking-wider bg-slate-700/30 last:rounded-r-lg">
                                    Keterangan
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700/50">
                            @foreach($riwayatAbsensi as $riwayat)
                            <tr class="hover:bg-slate-700/20 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-white">{{ $riwayat->absensi->judul }}</div>
                                    <div class="text-xs text-gray-400 flex items-center mt-1">
                                        <i class="fas fa-clock mr-1 text-cyan-700"></i>
                                        {{ $riwayat->absensi->jam_mulai_formatted }} - {{ $riwayat->absensi->jam_selesai_formatted }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-300">
                                        {{ $riwayat->absensi->tanggal->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-300">
                                        {{ $riwayat->waktu_absen->format('d M Y H:i') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($riwayat->status === 'pending')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-cyan-700/20 text-cyan-700 border border-cyan-700/30">
                                            <i class="fas fa-clock mr-1"></i>Pending
                                        </span>
                                    @elseif($riwayat->status === 'approved')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-400/20 text-green-300 border border-green-400/30">
                                            <i class="fas fa-check mr-1"></i>Disetujui
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-400/20 text-red-300 border border-red-400/30">
                                            <i class="fas fa-times mr-1"></i>Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-300">
                                        {{ $riwayat->keterangan ?? '-' }}
                                    </div>
                                    @if($riwayat->approved_at)
                                        <div class="text-xs text-gray-400 mt-1">
                                            <i class="fas fa-check-circle mr-1 text-green-400"></i>
                                            Diproses: {{ $riwayat->approved_at->format('d M Y H:i') }}
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination - Cyberpunk Style -->
                <div class="mt-6">
                    <div class="flex justify-center">
                        {{ $riwayatAbsensi->links('pagination::tailwind') }}
                    </div>
                </div>
                @else
                <div class="text-center py-16 text-gray-400">
                    <div class="bg-slate-700/30 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-inbox text-4xl text-gray-500"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-300">Belum Ada Riwayat</h3>
                    <p class="text-sm text-gray-400">Belum ada riwayat absensi yang tersedia</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Absensi - Cyberpunk Style -->
<div id="absensiModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-0 border-0 w-96 shadow-2xl rounded-xl">
        <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-cyan-400/30 rounded-xl backdrop-blur-sm">
            <div class="p-6 text-center border-b border-cyan-400/20">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-cyan-100 mb-4">
                <i class="fas fa-hand-paper text-cyan-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Konfirmasi Absensi</h3>
            <p class="text-sm text-gray-500 mb-4">Anda akan mengajukan absensi untuk:</p>
            <p id="absensiTitle" class="text-lg font-semibold text-gray-900 mb-4"></p>
            
            <form id="absensiForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">Keterangan (Opsional)</label>
                    <textarea name="keterangan" id="keterangan" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-cyan-500" 
                              placeholder="Tambahkan keterangan jika diperlukan..."></textarea>
                </div>
                
                <div class="flex space-x-3">
                    <button type="submit" class="flex-1 px-4 py-2 bg-cyan-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                        <i class="fas fa-paper-plane mr-2"></i>Kirim Absensi
                    </button>
                    <button type="button" onclick="closeAbsensiModal()" class="flex-1 px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openAbsensiModal(absensiId, absensiTitle) {
    document.getElementById('absensiForm').action = `/mahasiswa/absensi/${absensiId}/request`;
    document.getElementById('absensiTitle').textContent = absensiTitle;
    document.getElementById('absensiModal').classList.remove('hidden');
}

function closeAbsensiModal() {
    document.getElementById('absensiModal').classList.add('hidden');
    document.getElementById('keterangan').value = '';
}

// Tampilkan alert jika ada session success
@if(session('success'))
    alert("{{ session('success') }}");
@endif

// Auto refresh setiap 30 detik untuk update status waktu
setInterval(function() {
    location.reload();
}, 30000);
</script>
@endsection