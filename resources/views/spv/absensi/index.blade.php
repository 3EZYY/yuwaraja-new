@extends('layouts.spv')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Manajemen Absensi</h1>
            <p class="text-gray-600 mt-2">Kelola absensi mahasiswa yang Anda bimbing</p>
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

        <!-- Pending Requests -->
        @if($pendingRequests->count() > 0)
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">
                    <i class="fas fa-clock text-yellow-500 mr-2"></i>
                    Request Absensi Pending ({{ $pendingRequests->count() }})
                </h2>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mahasiswa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Absensi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Request</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($pendingRequests as $request)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            @if($request->mahasiswa->photo)
                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('profile-pictures/' . $request->mahasiswa->photo) }}" alt="">
                                            @else
                                                <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                                    <i class="fas fa-user text-gray-600"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $request->mahasiswa->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $request->mahasiswa->nim }}</div>
                                            <div class="text-xs text-gray-400">{{ $request->mahasiswa->kelompok->nama_kelompok ?? 'Belum ada kelompok' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $request->absensi->judul }}</div>
                                    <div class="text-sm text-gray-500">{{ $request->absensi->tanggal->format('d M Y') }}</div>
                                    <div class="text-xs text-gray-400">{{ $request->absensi->jam_mulai }} - {{ $request->absensi->jam_selesai }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $request->waktu_absen->format('d M Y H:i') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $request->keterangan ?? 'Tidak ada keterangan' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <form action="{{ route('spv.absensi.approve', $request) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs">
                                                <i class="fas fa-check mr-1"></i>Setujui
                                            </button>
                                        </form>
                                        <button onclick="openRejectModal({{ $request->id }})" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                                            <i class="fas fa-times mr-1"></i>Tolak
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        <!-- Daftar Absensi Aktif -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">
                    <i class="fas fa-list text-blue-500 mr-2"></i>
                    Daftar Absensi Aktif
                </h2>
                
                @if($absensiList->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($absensiList as $absensi)
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <h3 class="font-semibold text-gray-900 mb-2">{{ $absensi->judul }}</h3>
                        <div class="text-sm text-gray-600 space-y-1">
                            <div><i class="fas fa-calendar mr-2"></i>{{ $absensi->tanggal->format('d M Y') }}</div>
                            <div><i class="fas fa-clock mr-2"></i>{{ $absensi->jam_mulai }} - {{ $absensi->jam_selesai }}</div>
                            @if($absensi->deskripsi)
                            <div class="mt-2 text-xs text-gray-500">{{ Str::limit($absensi->deskripsi, 100) }}</div>
                            @endif
                        </div>
                        <div class="mt-4 flex justify-between items-center">
                            <div class="text-xs text-gray-500">
                                {{ $absensi->absensiMahasiswa()->count() }} request
                            </div>
                            <a href="{{ route('spv.absensi.show', $absensi) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                Lihat Detail →
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-calendar-times text-4xl mb-4"></i>
                    <p>Belum ada absensi aktif</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Riwayat Absensi yang Disetujui -->
        @if($approvedRequests->count() > 0)
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">
                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                    Riwayat Absensi Disetujui (20 Terakhir)
                </h2>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mahasiswa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Absensi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Disetujui</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($approvedRequests as $request)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-8 w-8">
                                            @if($request->mahasiswa->photo)
                                                <img class="h-8 w-8 rounded-full object-cover" src="{{ asset('profile-pictures/' . $request->mahasiswa->photo) }}" alt="">
                                            @else
                                                <div class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center">
                                                    <i class="fas fa-user text-gray-600 text-xs"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">{{ $request->mahasiswa->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $request->mahasiswa->nim }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $request->absensi->judul }}</div>
                                    <div class="text-xs text-gray-500">{{ $request->absensi->tanggal->format('d M Y') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $request->approved_at->format('d M Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check mr-1"></i>Disetujui
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Modal untuk Reject -->
<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg font-medium text-gray-900">Tolak Absensi</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">Berikan alasan penolakan absensi ini:</p>
                <form id="rejectForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <textarea name="keterangan" class="mt-3 w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" rows="3" placeholder="Alasan penolakan..." required></textarea>
                    <div class="items-center px-4 py-3">
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                            Tolak Absensi
                        </button>
                        <button type="button" onclick="closeRejectModal()" class="mt-3 px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function openRejectModal(requestId) {
    document.getElementById('rejectForm').action = `/spv/absensi/${requestId}/reject`;
    document.getElementById('rejectModal').classList.remove('hidden');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
}
</script>
@endsection