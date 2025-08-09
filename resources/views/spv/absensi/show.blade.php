@extends('layouts.spv')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black py-6 lg:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Cyberpunk Header -->
        <div class="mb-6 lg:mb-8">
            <div class="relative overflow-hidden bg-gradient-to-r from-cyan-600 via-cyan-300 to-cyan-200 rounded-2xl p-6 lg:p-8 shadow-2xl border border-cyan-400/30">
                <!-- Animated Background Pattern -->
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/10 via-transparent to-cyan-200/10"></div>
                
                <!-- Glowing Border Effect -->
                <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-cyan-400/50 to-cyan-200/50 blur-sm"></div>
                <div class="absolute inset-[2px] rounded-2xl bg-gradient-to-r from-cyan-600 via-cyan-300 to-cyan-200"></div>
                
                <!-- Content -->
                <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between text-white">
                    <div class="mb-4 lg:mb-0">
                        <!-- Back Navigation -->
                        <a href="{{ route('spv.absensi.index') }}" class="inline-flex items-center px-4 py-2 bg-black/20 backdrop-blur-sm border border-cyan-400/30 rounded-xl text-cyan-200 hover:text-white hover:border-cyan-400/50 transition-all duration-300 mb-4">
                            <i class="fas fa-arrow-left mr-2"></i>
                            <span class="font-medium">Kembali ke Dashboard</span>
                        </a>
                        
                        <div class="flex items-center mb-3">
                            <div class="bg-cyan-400/20 backdrop-blur-sm rounded-xl p-3 mr-4 border border-cyan-300/30">
                                <i class="fas fa-calendar-check text-2xl text-cyan-300"></i>
                            </div>
                            <div>
                                <h1 class="text-2xl lg:text-3xl font-bold bg-gradient-to-r from-cyan-200 to-cyan-300 bg-clip-text text-transparent">
                                    {{ $absensi->judul }}
                                </h1>
                                <div class="text-base text-cyan-100/80 mt-1">Sistem Manajemen Absensi</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Info Cards -->
                    <div class="relative">
                        <div class="bg-black/30 backdrop-blur-md rounded-xl p-4 lg:p-6 border border-cyan-400/20 shadow-2xl">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <div class="text-center lg:text-left">
                                    <div class="bg-gradient-to-br from-cyan-400 to-cyan-300 text-black text-lg lg:text-xl font-bold rounded-lg px-4 py-2 mb-2">
                                        {{ $absensi->tanggal->format('d M Y') }}
                                    </div>
                                    <div class="text-xs lg:text-sm text-cyan-300 font-medium uppercase tracking-wide">
                                        <i class="fas fa-calendar mr-1"></i>Tanggal Sesi
                                    </div>
                                </div>
                                <div class="text-center lg:text-left">
                                    <div class="bg-gradient-to-br from-cyan-200 to-pink-500 text-black text-lg lg:text-xl font-bold rounded-lg px-4 py-2 mb-2">
                                        {{ $absensi->jam_mulai_formatted }}-{{ $absensi->jam_selesai_formatted }}
                                    </div>
                                    <div class="text-xs lg:text-sm text-cyan-200 font-medium uppercase tracking-wide">
                                        <i class="fas fa-clock mr-1"></i>Waktu Aktif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Glowing Effect -->
                        <div class="absolute -inset-1 bg-gradient-to-r from-cyan-400/30 to-cyan-200/30 rounded-xl blur opacity-75"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Messages - Cyberpunk Style -->
        @if(session('success'))
            <div class="bg-gradient-to-r from-green-500/20 to-emerald-500/20 border border-green-400/50 text-green-300 px-6 py-4 rounded-xl mb-6 shadow-lg backdrop-blur-sm">
                <div class="flex items-center">
                    <div class="bg-green-400/20 rounded-lg p-2 mr-4">
                        <i class="fas fa-check-circle text-green-400 text-lg"></i>
                    </div>
                    <div>
                        <div class="font-semibold text-green-200">Sistem Berhasil</div>
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
                        <div class="font-semibold text-red-200">Error Sistem</div>
                        <div class="text-sm text-red-300/80">{{ session('error') }}</div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Informasi Absensi - Dark Cyberpunk -->
        <div class="bg-gradient-to-br from-gray-800/90 to-gray-900/90 backdrop-blur-md rounded-2xl shadow-2xl border border-cyan-400/30 mb-6 lg:mb-8 overflow-hidden">
            <!-- Header -->
            <div class="relative bg-gradient-to-r from-cyan-500 via-cyan-300 to-cyan-500 px-6 py-5">
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="relative z-10">
                    <h2 class="text-lg lg:text-xl font-bold text-white flex items-center">
                        <div class="bg-black/20 backdrop-blur-sm rounded-xl p-3 mr-4 border border-black/30">
                            <i class="fas fa-database text-white text-lg"></i>
                        </div>
                        <div>
                            <div class="text-xl font-black">INFORMASI SESI</div>
                            <div class="text-sm font-medium opacity-80">Data Sesi Absensi</div>
                        </div>
                    </h2>
                </div>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Session Details -->
                    <div class="space-y-6">
                        <div>
                            <h3 class="font-bold text-cyan-300 mb-4 text-lg flex items-center">
                                <i class="fas fa-info-circle text-cyan-400 mr-2"></i>
                                DETAIL SESI
                            </h3>
                            <div class="space-y-4">
                                <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl p-4 border border-gray-600/50">
                                    <div class="flex items-center">
                                        <div class="bg-cyan-400/20 rounded-lg p-2 mr-3">
                                            <i class="fas fa-tag text-cyan-400 text-sm"></i>
                                        </div>
                                        <div>
                                            <div class="text-xs text-gray-400 uppercase tracking-wide">JUDUL</div>
                                            <div class="text-gray-200 font-medium">{{ $absensi->judul }}</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl p-4 border border-gray-600/50">
                                        <div class="flex items-center">
                                            <div class="bg-cyan-300/20 rounded-lg p-2 mr-3">
                                                <i class="fas fa-calendar text-cyan-300 text-sm"></i>
                                            </div>
                                            <div>
                                                <div class="text-xs text-gray-400 uppercase tracking-wide">TANGGAL</div>
                                                <div class="text-gray-200 font-medium">{{ $absensi->tanggal->format('d M Y') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl p-4 border border-gray-600/50">
                                        <div class="flex items-center">
                                            <div class="bg-cyan-200/20 rounded-lg p-2 mr-3">
                                                <i class="fas fa-clock text-cyan-200 text-sm"></i>
                                            </div>
                                            <div>
                                                <div class="text-xs text-gray-400 uppercase tracking-wide">WAKTU</div>
                                                <div class="text-gray-200 font-medium">{{ $absensi->jam_mulai_formatted }}-{{ $absensi->jam_selesai_formatted }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl p-4 border border-gray-600/50">
                                    <div class="flex items-center">
                                        <div class="bg-green-400/20 rounded-lg p-2 mr-3">
                                            <i class="fas fa-power-off text-green-400 text-sm"></i>
                                        </div>
                                        <div>
                                            <div class="text-xs text-gray-400 uppercase tracking-wide">STATUS</div>
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold mt-1 {{ $absensi->status === 'aktif' ? 'bg-gradient-to-r from-green-400/20 to-emerald-400/20 text-green-300 border border-green-400/30' : 'bg-gradient-to-r from-red-400/20 to-pink-400/20 text-red-300 border border-red-400/30' }}">
                                                <i class="fas fa-circle mr-1 text-xs"></i>{{ strtoupper($absensi->status) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @if($absensi->deskripsi)
                        <div>
                            <h4 class="font-bold text-cyan-300 mb-3 text-base flex items-center">
                                <i class="fas fa-file-alt text-cyan-400 mr-2"></i>
                                DESKRIPSI
                            </h4>
                            <div class="bg-gray-800/70 backdrop-blur-sm rounded-xl p-4 border border-gray-600/50">
                                <p class="text-gray-300 leading-relaxed">{{ $absensi->deskripsi }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Statistics Dashboard -->
                    <div>
                        <h3 class="font-bold text-cyan-300 mb-4 text-lg flex items-center">
                            <i class="fas fa-chart-bar text-cyan-400 mr-2"></i>
                            STATISTIK SISTEM
                        </h3>
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Total Requests -->
                            <div class="bg-gradient-to-br from-cyan-300/20 to-cyan-500/20 backdrop-blur-sm rounded-xl p-5 border border-cyan-300/30 text-center group hover:border-cyan-300/50 transition-all duration-300">
                                <div class="bg-cyan-300/20 rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3 group-hover:bg-cyan-300/30 transition-all duration-300">
                                    <i class="fas fa-list text-cyan-300 text-lg"></i>
                                </div>
                                <div class="text-2xl lg:text-3xl font-black text-cyan-300 mb-1">{{ $totalRequests }}</div>
                                <div class="text-xs text-cyan-300 uppercase tracking-wide font-medium">TOTAL PERMINTAAN</div>
                            </div>
                            
                            <!-- Approved -->
                            <div class="bg-gradient-to-br from-green-500/20 to-emerald-500/20 backdrop-blur-sm rounded-xl p-5 border border-green-400/30 text-center group hover:border-green-400/50 transition-all duration-300">
                                <div class="bg-green-400/20 rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3 group-hover:bg-green-400/30 transition-all duration-300">
                                    <i class="fas fa-check text-green-400 text-lg"></i>
                                </div>
                                <div class="text-2xl lg:text-3xl font-black text-green-300 mb-1">{{ $approvedCount }}</div>
                                <div class="text-xs text-green-400 uppercase tracking-wide font-medium">DISETUJUI</div>
                            </div>
                            
                            <!-- Pending -->
                            <div class="bg-gradient-to-br from-yellow-500/20 to-orange-500/20 backdrop-blur-sm rounded-xl p-5 border border-yellow-400/30 text-center group hover:border-yellow-400/50 transition-all duration-300">
                                <div class="bg-yellow-400/20 rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3 group-hover:bg-yellow-400/30 transition-all duration-300">
                                    <i class="fas fa-clock text-yellow-400 text-lg"></i>
                                </div>
                                <div class="text-2xl lg:text-3xl font-black text-yellow-300 mb-1">{{ $pendingCount }}</div>
                                <div class="text-xs text-yellow-400 uppercase tracking-wide font-medium">MENUNGGU</div>
                            </div>
                            
                            <!-- Rejected -->
                            <div class="bg-gradient-to-br from-red-500/20 to-pink-500/20 backdrop-blur-sm rounded-xl p-5 border border-red-400/30 text-center group hover:border-red-400/50 transition-all duration-300">
                                <div class="bg-red-400/20 rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3 group-hover:bg-red-400/30 transition-all duration-300">
                                    <i class="fas fa-times text-red-400 text-lg"></i>
                                </div>
                                <div class="text-2xl lg:text-3xl font-black text-red-300 mb-1">{{ $rejectedCount }}</div>
                                <div class="text-xs text-red-400 uppercase tracking-wide font-medium">DITOLAK</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Request Absensi - Dark Cyberpunk -->
        <div class="bg-gradient-to-br from-gray-800/90 to-gray-900/90 backdrop-blur-md rounded-2xl shadow-2xl border border-cyan-400/30 overflow-hidden">
            <!-- Header -->
            <div class="relative bg-gradient-to-r from-cyan-500 via-cyan-300 to-cyan-200 px-6 py-5">
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="relative z-10">
                    <h2 class="text-lg lg:text-xl font-bold text-white flex items-center">
                        <div class="bg-black/20 backdrop-blur-sm rounded-xl p-3 mr-4 border border-black/30">
                            <i class="fas fa-users text-white text-lg"></i>
                        </div>
                        <div>
                            <div class="text-xl font-black">MONITORING PERMINTAAN</div>
                            <div class="text-sm font-medium opacity-80">Sistem Analisis Permintaan Absensi</div>
                        </div>
                    </h2>
                </div>
            </div>
            
            <div class="p-6">
                <!-- Filter Tabs - Cyberpunk Style -->
                <div class="mb-6">
                    <nav class="flex flex-wrap gap-2" aria-label="Tabs">
                        <a href="?status=all" class="tab-link {{ request('status', 'all') === 'all' ? 'bg-gradient-to-r from-cyan-500 to-cyan-300 text-white border-cyan-400/50' : 'bg-gray-700/50 text-gray-300 border-gray-600/50 hover:bg-gray-600/50 hover:text-gray-200' }} px-4 py-3 rounded-xl border backdrop-blur-sm font-bold text-sm transition-all duration-300 transform hover:scale-[1.02]">
                            <i class="fas fa-list mr-2"></i>TODOS ({{ $totalRequests }})
                        </a>
                        <a href="?status=pending" class="tab-link {{ request('status') === 'pending' ? 'bg-gradient-to-r from-yellow-500 to-orange-600 text-black border-yellow-400/50' : 'bg-gray-700/50 text-gray-300 border-gray-600/50 hover:bg-gray-600/50 hover:text-gray-200' }} px-4 py-3 rounded-xl border backdrop-blur-sm font-bold text-sm transition-all duration-300 transform hover:scale-[1.02]">
                            <i class="fas fa-clock mr-2"></i>MENUNGGU ({{ $pendingCount }})
                        </a>
                        <a href="?status=approved" class="tab-link {{ request('status') === 'approved' ? 'bg-gradient-to-r from-green-500 to-emerald-600 text-white border-green-400/50' : 'bg-gray-700/50 text-gray-300 border-gray-600/50 hover:bg-gray-600/50 hover:text-gray-200' }} px-4 py-3 rounded-xl border backdrop-blur-sm font-bold text-sm transition-all duration-300 transform hover:scale-[1.02]">
                            <i class="fas fa-check mr-2"></i>DISETUJUI ({{ $approvedCount }})
                        </a>
                        <a href="?status=rejected" class="tab-link {{ request('status') === 'rejected' ? 'bg-gradient-to-r from-red-500 to-pink-600 text-white border-red-400/50' : 'bg-gray-700/50 text-gray-300 border-gray-600/50 hover:bg-gray-600/50 hover:text-gray-200' }} px-4 py-3 rounded-xl border backdrop-blur-sm font-bold text-sm transition-all duration-300 transform hover:scale-[1.02]">
                            <i class="fas fa-times mr-2"></i>DITOLAK ({{ $rejectedCount }})
                        </a>
                    </nav>
                </div>

                @if($requests->count() > 0)
                <!-- Desktop Table View -->
                <div class="overflow-x-auto rounded-xl border border-gray-700/50">
                    <table class="min-w-full">
                        <thead class="bg-gradient-to-r from-gray-800 to-gray-900">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-cyan-300 uppercase tracking-wider border-b border-gray-700">
                                    <i class="fas fa-user mr-2"></i>PENGGUNA
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-cyan-300 uppercase tracking-wider border-b border-gray-700">
                                    <i class="fas fa-clock mr-2"></i>WAKTU
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-cyan-300 uppercase tracking-wider border-b border-gray-700">
                                    <i class="fas fa-info-circle mr-2"></i>STATUS
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-cyan-300 uppercase tracking-wider border-b border-gray-700">
                                    <i class="fas fa-comment mr-2"></i>CATATAN
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-cyan-300 uppercase tracking-wider border-b border-gray-700">
                                    <i class="fas fa-cogs mr-2"></i>AKSI
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @foreach($requests as $request)
                            <tr class="hover:bg-gray-700/30 transition-all duration-300 group">
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12">
                                            @if($request->mahasiswa->photo)
                                                <img class="h-12 w-12 rounded-xl object-cover ring-2 ring-cyan-400/50 group-hover:ring-cyan-400 transition-all duration-300" src="{{ asset('profile-pictures/' . $request->mahasiswa->photo) }}" alt="">
                                            @else
                                                <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-cyan-400 to-cyan-300 flex items-center justify-center ring-2 ring-cyan-400/50 group-hover:ring-cyan-400 transition-all duration-300">
                                                    <i class="fas fa-user text-white"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-gray-200 group-hover:text-white transition-colors duration-300">{{ $request->mahasiswa->name }}</div>
                                            <div class="text-sm text-gray-400">{{ $request->mahasiswa->nim }}</div>
                                            <div class="text-xs text-cyan-200">{{ $request->mahasiswa->kelompok->nama_kelompok ?? 'Tidak Ada Kelompok' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="text-sm text-gray-300">{{ $request->created_at->format('d M Y') }}</div>
                                    <div class="text-xs text-gray-400">{{ $request->created_at->format('H:i') }}</div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    @if($request->status === 'pending')
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gradient-to-r from-yellow-400/20 to-orange-400/20 text-yellow-300 border border-yellow-400/30">
                                            <i class="fas fa-clock mr-1"></i>MENUNGGU
                                        </span>
                                    @elseif($request->status === 'approved')
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gradient-to-r from-green-400/20 to-emerald-400/20 text-green-300 border border-green-400/30">
                                            <i class="fas fa-check mr-1"></i>DISETUJUI
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gradient-to-r from-red-400/20 to-pink-400/20 text-red-300 border border-red-400/30">
                                            <i class="fas fa-times mr-1"></i>DITOLAK
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-5 text-sm text-gray-400 max-w-xs">
                                    <div class="truncate">{{ $request->keterangan ?? 'Tidak ada catatan' }}</div>
                                    @if($request->approved_at)
                                        <div class="text-xs text-gray-500 mt-1">
                                            Diproses: {{ $request->approved_at->format('d M Y H:i') }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium">
                                    @if($request->status === 'pending')
                                        <div class="flex space-x-3">
                                            <form action="{{ route('spv.absensi.approve', $request) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white px-4 py-2 rounded-lg text-xs font-bold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                                    <i class="fas fa-check mr-1"></i>SETUJUI
                                                </button>
                                            </form>
                                            <button onclick="openRejectModal({{ $request->id }})" class="bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white px-4 py-2 rounded-lg text-xs font-bold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                                <i class="fas fa-times mr-1"></i>TOLAK
                                            </button>
                                        </div>
                                    @else
                                        <span class="text-gray-500 text-xs font-medium bg-gray-700/30 px-3 py-1.5 rounded-lg border border-gray-600/50">
                                            <i class="fas fa-lock mr-1"></i>SUDAH DIPROSES
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="mt-6">
                    {{ $requests->appends(request()->query())->links() }}
                </div>
                @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="bg-gradient-to-br from-gray-700/50 to-gray-800/50 backdrop-blur-sm rounded-2xl w-20 h-20 flex items-center justify-center mx-auto mb-6 border border-gray-600/50">
                        <i class="fas fa-inbox text-3xl text-gray-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-300 mb-3">TIDAK ADA PERMINTAAN</h3>
                    <p class="text-gray-500 text-sm max-w-md mx-auto">
                        Sistem menunggu permintaan absensi dari mahasiswa
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Cyberpunk Modal untuk Reject -->
<div id="rejectModal" class="fixed inset-0 bg-black/70 backdrop-blur-md overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 w-11/12 max-w-md">
        <div class="relative bg-gradient-to-br from-gray-800/95 to-gray-900/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-red-400/30 overflow-hidden">
            <!-- Glowing Border Effect -->
            <div class="absolute inset-0 bg-gradient-to-r from-red-400/20 to-pink-400/20 blur-sm"></div>
            <div class="absolute inset-[1px] rounded-2xl bg-gradient-to-br from-gray-800/95 to-gray-900/95"></div>
            
            <!-- Modal Header -->
            <div class="relative z-10 bg-gradient-to-r from-red-500 via-red-600 to-pink-600 px-6 py-5">
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="relative z-10">
                    <h3 class="text-lg font-bold text-white flex items-center">
                        <div class="bg-black/20 backdrop-blur-sm rounded-xl p-3 mr-4 border border-black/30">
                            <i class="fas fa-times text-white text-lg"></i>
                        </div>
                        <div>
                            <div class="text-xl font-black">TOLAK PERMINTAAN</div>
                            <div class="text-sm font-medium opacity-80">Sistem Penolakan Permintaan</div>
                        </div>
                    </h3>
                </div>
            </div>
            
            <!-- Modal Body -->
            <div class="relative z-10 p-6">
                <div class="mb-6">
                    <div class="flex items-center mb-4">
                        <div class="bg-red-400/20 rounded-lg p-2 mr-3">
                            <i class="fas fa-exclamation-triangle text-red-400"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-200">Alasan Penolakan</div>
                            <div class="text-sm text-gray-400">Berikan alasan yang jelas untuk menolak permintaan ini</div>
                        </div>
                    </div>
                </div>
                
                <form id="rejectForm" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH')
                    <div>
                        <textarea name="keterangan" 
                                  class="w-full px-4 py-4 bg-gray-800/50 backdrop-blur-sm border border-gray-600/50 rounded-xl text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/50 focus:border-red-400/50 resize-none transition-all duration-300" 
                                  rows="4" 
                                  placeholder="Masukkan alasan penolakan dengan detail yang jelas..." 
                                  required></textarea>
                    </div>
                    
                    <!-- Modal Actions -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-2">
                        <button type="submit" 
                                class="flex-1 px-6 py-4 bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white text-sm font-bold rounded-xl transition-all duration-300 transform hover:scale-[1.02] shadow-lg hover:shadow-red-500/25 flex items-center justify-center">
                            <i class="fas fa-times mr-2"></i>
                            KONFIRMASI PENOLAKAN
                        </button>
                        <button type="button" 
                                onclick="closeRejectModal()" 
                                class="flex-1 px-6 py-4 bg-gray-700/50 hover:bg-gray-600/50 backdrop-blur-sm border border-gray-600/50 hover:border-gray-500/50 text-gray-200 text-sm font-bold rounded-xl transition-all duration-300 transform hover:scale-[1.02] flex items-center justify-center">
                            <i class="fas fa-arrow-left mr-2"></i>
                            BATAL
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