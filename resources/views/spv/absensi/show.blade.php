@extends('layouts.spv')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <a href="{{ route('spv.absensi.index') }}" class="text-blue-600 hover:text-blue-800 mb-2 inline-block">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Absensi
                    </a>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $absensi->judul }}</h1>
                    <p class="text-gray-600 mt-2">Detail absensi dan daftar mahasiswa</p>
                </div>
                <div class="text-right">
                    <div class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                        <i class="fas fa-calendar mr-1"></i>{{ $absensi->tanggal->format('d M Y') }}
                    </div>
                    <div class="text-sm text-gray-600 mt-1">
                        <i class="fas fa-clock mr-1"></i>{{ $absensi->jam_mulai }} - {{ $absensi->jam_selesai }}
                    </div>
                </div>
            </div>
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

        <!-- Informasi Absensi -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">
                    <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                    Informasi Absensi
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="font-medium text-gray-900 mb-2">Detail Acara</h3>
                        <div class="space-y-2 text-sm text-gray-600">
                            <div><strong>Judul:</strong> {{ $absensi->judul }}</div>
                            <div><strong>Tanggal:</strong> {{ $absensi->tanggal->format('d M Y') }}</div>
                            <div><strong>Waktu:</strong> {{ $absensi->jam_mulai }} - {{ $absensi->jam_selesai }}</div>
                            <div><strong>Status:</strong> 
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $absensi->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($absensi->status) }}
                                </span>
                            </div>
                        </div>
                        @if($absensi->deskripsi)
                        <div class="mt-4">
                            <h4 class="font-medium text-gray-900 mb-2">Deskripsi</h4>
                            <p class="text-sm text-gray-600">{{ $absensi->deskripsi }}</p>
                        </div>
                        @endif
                    </div>
                    
                    <div>
                        <h3 class="font-medium text-gray-900 mb-2">Statistik Absensi</h3>
                        <div class="grid grid-cols-4 gap-4">
                            <div class="bg-blue-50 p-3 rounded-lg text-center">
                                <div class="text-2xl font-bold text-blue-600">{{ $totalRequests }}</div>
                                <div class="text-xs text-blue-600">Total Request</div>
                            </div>
                            <div class="bg-green-50 p-3 rounded-lg text-center">
                                <div class="text-2xl font-bold text-green-600">{{ $approvedCount }}</div>
                                <div class="text-xs text-green-600">Disetujui</div>
                            </div>
                            <div class="bg-yellow-50 p-3 rounded-lg text-center">
                                <div class="text-2xl font-bold text-yellow-600">{{ $pendingCount }}</div>
                                <div class="text-xs text-yellow-600">Pending</div>
                            </div>
                            <div class="bg-red-50 p-3 rounded-lg text-center">
                                <div class="text-2xl font-bold text-red-600">{{ $rejectedCount }}</div>
                                <div class="text-xs text-red-600">Ditolak</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Request Absensi -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">
                    <i class="fas fa-users text-green-500 mr-2"></i>
                    Daftar Request Absensi
                </h2>
                
                <!-- Filter Tabs -->
                <div class="mb-4">
                    <nav class="flex space-x-8" aria-label="Tabs">
                        <a href="?status=all" class="tab-link {{ request('status', 'all') === 'all' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                            Semua ({{ $totalRequests }})
                        </a>
                        <a href="?status=pending" class="tab-link {{ request('status') === 'pending' ? 'border-yellow-500 text-yellow-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                            Pending ({{ $pendingCount }})
                        </a>
                        <a href="?status=approved" class="tab-link {{ request('status') === 'approved' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                            Disetujui ({{ $approvedCount }})
                        </a>
                        <a href="?status=rejected" class="tab-link {{ request('status') === 'rejected' ? 'border-red-500 text-red-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                            Ditolak ({{ $rejectedCount }})
                        </a>
                    </nav>
                </div>

                @if($requests->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mahasiswa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Request</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($requests as $request)
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
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $request->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($request->status === 'pending')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-clock mr-1"></i>Pending
                                        </span>
                                    @elseif($request->status === 'approved')
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
                                    {{ $request->keterangan ?? 'Tidak ada keterangan' }}
                                    @if($request->approved_at)
                                        <div class="text-xs text-gray-400 mt-1">
                                            Diproses: {{ $request->approved_at->format('d M Y H:i') }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @if($request->status === 'pending')
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
                                    @else
                                        <span class="text-gray-400 text-xs">Sudah diproses</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="mt-4">
                    {{ $requests->appends(request()->query())->links() }}
                </div>
                @else
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-inbox text-4xl mb-4"></i>
                    <p>Belum ada request absensi</p>
                </div>
                @endif
            </div>
        </div>
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