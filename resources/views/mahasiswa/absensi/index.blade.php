@extends('layouts.mahasiswa')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Absensi</h1>
            <p class="text-gray-600 mt-2">Kelola absensi dan riwayat kehadiran Anda</p>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Absensi Aktif -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">
                    <i class="fas fa-calendar-check text-blue-500 mr-2"></i>
                    Absensi Tersedia
                </h2>
                
                @if($absensiAktif->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($absensiAktif as $absensi)
                    @php
                        $userRequest = $absensi->absensiMahasiswa()->where('user_id', auth()->id())->first();
                        $now = now();
                        $tanggalAbsensi = \Carbon\Carbon::parse($absensi->tanggal->format('Y-m-d') . ' ' . $absensi->jam_mulai);
                        $batasAbsensi = \Carbon\Carbon::parse($absensi->tanggal->format('Y-m-d') . ' ' . $absensi->jam_selesai);
                        $canAttend = $now->between($tanggalAbsensi, $batasAbsensi);
                    @endphp
                    
                    <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="font-semibold text-gray-900 text-lg">{{ $absensi->judul }}</h3>
                            @if($userRequest)
                                @if($userRequest->status === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i>Pending
                                    </span>
                                @elseif($userRequest->status === 'approved')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check mr-1"></i>Hadir
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i class="fas fa-times mr-1"></i>Ditolak
                                    </span>
                                @endif
                            @endif
                        </div>
                        
                        <div class="text-sm text-gray-600 space-y-2 mb-4">
                            <div class="flex items-center">
                                <i class="fas fa-calendar mr-2 text-gray-400"></i>
                                {{ $absensi->tanggal->format('d M Y') }}
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-clock mr-2 text-gray-400"></i>
                                {{ $absensi->jam_mulai }} - {{ $absensi->jam_selesai }}
                            </div>
                            @if($absensi->deskripsi)
                            <div class="mt-3">
                                <p class="text-xs text-gray-500">{{ Str::limit($absensi->deskripsi, 100) }}</p>
                            </div>
                            @endif
                        </div>

                        <!-- Status Waktu -->
                        <div class="mb-4">
                            @if($now->lt($tanggalAbsensi))
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                                    <div class="flex items-center text-blue-700">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        <span class="text-sm font-medium">Belum dimulai</span>
                                    </div>
                                    <div class="text-xs text-blue-600 mt-1">
                                        Dimulai {{ $tanggalAbsensi->diffForHumans() }}
                                    </div>
                                </div>
                            @elseif($canAttend)
                                <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                                    <div class="flex items-center text-green-700">
                                        <i class="fas fa-play-circle mr-2"></i>
                                        <span class="text-sm font-medium">Sedang berlangsung</span>
                                    </div>
                                    <div class="text-xs text-green-600 mt-1">
                                        Berakhir {{ $batasAbsensi->diffForHumans() }}
                                    </div>
                                </div>
                            @else
                                <div class="bg-red-50 border border-red-200 rounded-lg p-3">
                                    <div class="flex items-center text-red-700">
                                        <i class="fas fa-stop-circle mr-2"></i>
                                        <span class="text-sm font-medium">Sudah berakhir</span>
                                    </div>
                                    <div class="text-xs text-red-600 mt-1">
                                        Berakhir {{ $batasAbsensi->diffForHumans() }}
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Action Button -->
                        <div class="mt-4">
                            @if(!$userRequest && $canAttend)
                                <button onclick="openAbsensiModal({{ $absensi->id }}, '{{ $absensi->judul }}')" 
                                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                    <i class="fas fa-hand-paper mr-2"></i>Absen Sekarang
                                </button>
                            @elseif(!$userRequest && !$canAttend)
                                <button disabled class="w-full bg-gray-300 text-gray-500 font-medium py-2 px-4 rounded-lg cursor-not-allowed">
                                    <i class="fas fa-ban mr-2"></i>
                                    @if($now->lt($tanggalAbsensi))
                                        Belum Dimulai
                                    @else
                                        Sudah Berakhir
                                    @endif
                                </button>
                            @elseif($userRequest)
                                <div class="text-center text-sm text-gray-600">
                                    @if($userRequest->status === 'pending')
                                        <i class="fas fa-hourglass-half mr-1"></i>Menunggu persetujuan SPV
                                    @elseif($userRequest->status === 'approved')
                                        <i class="fas fa-check-circle mr-1 text-green-600"></i>Absensi telah disetujui
                                    @else
                                        <i class="fas fa-times-circle mr-1 text-red-600"></i>Absensi ditolak
                                        @if($userRequest->keterangan)
                                            <div class="text-xs text-red-500 mt-1">{{ $userRequest->keterangan }}</div>
                                        @endif
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12 text-gray-500">
                    <i class="fas fa-calendar-times text-6xl mb-4"></i>
                    <h3 class="text-lg font-medium mb-2">Tidak ada absensi aktif</h3>
                    <p class="text-sm">Belum ada absensi yang tersedia saat ini</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Riwayat Absensi -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">
                    <i class="fas fa-history text-green-500 mr-2"></i>
                    Riwayat Absensi
                </h2>
                
                @if($riwayatAbsensi->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acara</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Request</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($riwayatAbsensi as $riwayat)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $riwayat->absensi->judul }}</div>
                                    <div class="text-xs text-gray-500">{{ $riwayat->absensi->jam_mulai }} - {{ $riwayat->absensi->jam_selesai }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $riwayat->absensi->tanggal->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $riwayat->waktu_absen->format('d M Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($riwayat->status === 'pending')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-clock mr-1"></i>Pending
                                        </span>
                                    @elseif($riwayat->status === 'approved')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check mr-1"></i>Disetujui
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-times mr-1"></i>Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $riwayat->keterangan ?? '-' }}
                                    @if($riwayat->approved_at)
                                        <div class="text-xs text-gray-400 mt-1">
                                            Diproses: {{ $riwayat->approved_at->format('d M Y H:i') }}
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="mt-4">
                    {{ $riwayatAbsensi->links() }}
                </div>
                @else
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-inbox text-4xl mb-4"></i>
                    <p>Belum ada riwayat absensi</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Absensi -->
<div id="absensiModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 mb-4">
                <i class="fas fa-hand-paper text-blue-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Konfirmasi Absensi</h3>
            <p class="text-sm text-gray-500 mb-4">Anda akan mengajukan absensi untuk:</p>
            <p id="absensiTitle" class="text-lg font-semibold text-gray-900 mb-4"></p>
            
            <form id="absensiForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">Keterangan (Opsional)</label>
                    <textarea name="keterangan" id="keterangan" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                              placeholder="Tambahkan keterangan jika diperlukan..."></textarea>
                </div>
                
                <div class="flex space-x-3">
                    <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
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

// Auto refresh setiap 30 detik untuk update status waktu
setInterval(function() {
    location.reload();
}, 30000);
</script>
@endsection