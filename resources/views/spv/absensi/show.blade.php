@extends('layouts.spv')

@section('content')
<div class="min-h-screen bg-gray-900 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="bg-gray-800 rounded-xl shadow-lg border border-gray-700 p-6">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="mb-4 lg:mb-0">
                        <!-- Back Navigation -->
                        <a href="{{ route('spv.absensi.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 border border-gray-600 rounded-lg text-gray-300 hover:text-white transition-all duration-300 mb-4">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            <span class="font-medium">Kembali ke Dashboard</span>
                        </a>

                        <div class="flex items-center mb-2">
                            <div class="bg-gradient-to-r from-blue-500 to-cyan-600 rounded-lg p-2 mr-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl lg:text-3xl font-bold text-white">
                                    {{ $absensi->judul }}
                                </h1>
                                <p class="text-sm text-gray-300">Detail sesi absensi</p>
                            </div>
                        </div>
                    </div>

                    <!-- Info Cards -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div class="bg-gradient-to-r from-amber-500 to-orange-500 rounded-lg p-4 text-center shadow-lg">
                            <div class="text-lg font-bold text-white">{{ $absensi->tanggal->format('d M Y') }}</div>
                            <div class="text-xs text-white font-medium">Tanggal</div>
                        </div>
                        <div class="bg-gradient-to-r from-cyan-500 to-blue-500 rounded-lg p-4 text-center shadow-lg">
                            <div class="text-lg font-bold text-white">{{ $absensi->jam_mulai_formatted }}-{{ $absensi->jam_selesai_formatted }}</div>
                            <div class="text-xs text-white font-medium">Waktu</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
        <div class="mb-6 bg-gradient-to-r from-green-600 to-emerald-600 text-white px-4 py-3 rounded-lg shadow-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 bg-gradient-to-r from-red-600 to-rose-600 text-white px-4 py-3 rounded-lg shadow-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        </div>
        @endif

        <!-- Informasi Absensi -->
        <div class="bg-gray-800 rounded-xl shadow-lg border border-gray-700 mb-8 overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-4">
                <h2 class="text-lg font-bold text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                    </svg>


                    Informasi Sesi Absensi
                </h2>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Session Details -->
                    <div class="space-y-4">
                        <div>
                            <h3 class="font-bold text-white mb-4 text-lg flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Detail Sesi
                            </h3>
                            <div class="space-y-3">
                                <div class="bg-gray-700 rounded-lg p-4 border border-gray-600">
                                    <div class="flex items-center">
                                        <div class="bg-blue-500 rounded-lg p-2 mr-3">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a1.994 1.994 0 01-1.414.586H7a4 4 0 01-4-4V7a4 4 0 014-4z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs text-gray-400 uppercase tracking-wide">Judul</div>
                                            <div class="text-white font-medium">{{ $absensi->judul }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                    <div class="bg-gray-700 rounded-lg p-4 border border-gray-600">
                                        <div class="flex items-center">
                                            <div class="bg-amber-500 rounded-lg p-2 mr-3">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-xs text-gray-400 uppercase tracking-wide">Tanggal</div>
                                                <div class="text-white font-medium">{{ $absensi->tanggal->format('d M Y') }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-gray-700 rounded-lg p-4 border border-gray-600">
                                        <div class="flex items-center">
                                            <div class="bg-cyan-500 rounded-lg p-2 mr-3">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <div>
                                                <div class="text-xs text-gray-400 uppercase tracking-wide">Waktu</div>
                                                <div class="text-white font-medium">{{ $absensi->jam_mulai_formatted }}-{{ $absensi->jam_selesai_formatted }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gray-700 rounded-lg p-4 border border-gray-600">
                                    <div class="flex items-center">
                                        <div class="bg-green-500 rounded-lg p-2 mr-3">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-xs text-gray-400 uppercase tracking-wide">Status</div>
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium mt-1 {{ $absensi->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ ucfirst($absensi->status) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($absensi->deskripsi)
                        <div>
                            <h4 class="font-bold text-white mb-3 text-base flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Deskripsi
                            </h4>
                            <div class="bg-gray-700 rounded-lg p-4 border border-gray-600">
                                <p class="text-gray-300 leading-relaxed">{{ $absensi->deskripsi }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Statistics Dashboard -->
                    <div>
                        <h3 class="font-bold text-white mb-4 text-lg flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            Statistik Permintaan
                        </h3>
                        <div class="grid grid-cols-2 gap-3">
                            <!-- Total Requests -->
                            <div class="bg-gradient-to-r from-blue-500 to-cyan-500 rounded-lg p-4 text-center shadow-lg">
                                <div class="text-2xl font-bold text-white">{{ $totalRequests }}</div>
                                <div class="text-xs text-white font-medium">Total</div>
                            </div>

                            <!-- Approved -->
                            <div class="bg-gradient-to-r from-emerald-500 to-green-500 rounded-lg p-4 text-center shadow-lg">
                                <div class="text-2xl font-bold text-white">{{ $approvedCount }}</div>
                                <div class="text-xs text-white font-medium">Disetujui</div>
                            </div>

                            <!-- Pending -->
                            <div class="bg-gradient-to-r from-amber-500 to-orange-500 rounded-lg p-4 text-center shadow-lg">
                                <div class="text-2xl font-bold text-white">{{ $pendingCount }}</div>
                                <div class="text-xs text-white font-medium">Menunggu</div>
                            </div>

                            <!-- Rejected -->
                            <div class="bg-gradient-to-r from-red-500 to-rose-500 rounded-lg p-4 text-center shadow-lg">
                                <div class="text-2xl font-bold text-white">{{ $rejectedCount }}</div>
                                <div class="text-xs text-white font-medium">Ditolak</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar Request Absensi -->
        <div class="bg-gray-800 rounded-xl shadow-lg border border-gray-700 overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-4">
                <h2 class="text-lg font-bold text-white flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                        <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                    </svg>

                    Daftar Permintaan Absensi
                </h2>
            </div>

            <div class="p-6">
                <!-- Filter Tabs -->
                <div class="mb-6">
                    <nav class="flex flex-wrap gap-2" aria-label="Tabs">
                        <a href="?status=all" class="{{ request('status', 'all') === 'all' ? 'bg-blue-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }} px-4 py-2 rounded-lg font-medium text-sm transition-colors duration-200">
                            Semua ({{ $totalRequests }})
                        </a>
                        <a href="?status=pending" class="{{ request('status') === 'pending' ? 'bg-yellow-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }} px-4 py-2 rounded-lg font-medium text-sm transition-colors duration-200">
                            Menunggu ({{ $pendingCount }})
                        </a>
                        <a href="?status=approved" class="{{ request('status') === 'approved' ? 'bg-green-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }} px-4 py-2 rounded-lg font-medium text-sm transition-colors duration-200">
                            Disetujui ({{ $approvedCount }})
                        </a>
                        <a href="?status=rejected" class="{{ request('status') === 'rejected' ? 'bg-red-600 text-white' : 'bg-gray-700 text-gray-300 hover:bg-gray-600' }} px-4 py-2 rounded-lg font-medium text-sm transition-colors duration-200">
                            Ditolak ({{ $rejectedCount }})
                        </a>
                    </nav>
                </div>

                @if($requests->count() > 0)
                <!-- Desktop Table View -->
                <div class="overflow-x-auto rounded-lg border border-gray-700">
                    <table class="min-w-full">
                        <thead class="bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Pengguna
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Waktu
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Catatan
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-700">
                            @foreach($requests as $request)
                            <tr class="hover:bg-gray-700 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            @if($request->mahasiswa->photo)
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('profile-pictures/' . $request->mahasiswa->photo) }}" alt="">
                                            @else
                                            <div class="h-10 w-10 rounded-full bg-blue-600 flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-white">{{ $request->mahasiswa->name }}</div>
                                            <div class="text-sm text-gray-400">{{ $request->mahasiswa->nim }}</div>
                                            <div class="text-xs text-gray-500">{{ $request->mahasiswa->kelompok->nama_kelompok ?? 'Tidak Ada Kelompok' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-300">{{ $request->created_at->format('d M Y') }}</div>
                                    <div class="text-xs text-gray-400">{{ $request->created_at->format('H:i') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($request->status === 'pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Menunggu
                                    </span>
                                    @elseif($request->status === 'approved')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Disetujui
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-400 max-w-xs">
                                    <div class="truncate">{{ $request->keterangan ?? 'Tidak ada catatan' }}</div>
                                    @if($request->approved_at)
                                    <div class="text-xs text-gray-500 mt-1">
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
                                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs font-medium transition-colors duration-200">
                                                Setujui
                                            </button>
                                        </form>
                                        <button onclick="openRejectModal({{ $request->id }})" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-medium transition-colors duration-200">
                                            Tolak
                                        </button>
                                    </div>
                                    @else
                                    <span class="text-gray-500 text-xs">
                                        Sudah diproses
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
                <div class="text-center py-12">
                    <div class="bg-gray-700 rounded-lg w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-300 mb-2">Tidak ada permintaan</h3>
                    <p class="text-gray-500 text-sm">
                        Belum ada permintaan absensi dari mahasiswa
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Reject -->
<div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 w-11/12 max-w-md">
        <div class="bg-gray-800 rounded-lg shadow-xl border border-gray-700">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4 rounded-t-lg">
                <h3 class="text-lg font-bold text-white flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Tolak Permintaan
                </h3>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Alasan Penolakan</label>
                    <p class="text-sm text-gray-400 mb-4">Berikan alasan yang jelas untuk menolak permintaan ini</p>
                </div>

                <form id="rejectForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-6">
                        <textarea name="keterangan"
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 resize-none"
                            rows="4"
                            placeholder="Masukkan alasan penolakan..."
                            required></textarea>
                    </div>

                    <!-- Modal Actions -->
                    <div class="flex gap-3">
                        <button type="submit"
                            class="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                            Tolak Permintaan
                        </button>
                        <button type="button"
                            onclick="closeRejectModal()"
                            class="flex-1 px-4 py-2 bg-gray-600 hover:bg-gray-700 text-gray-200 text-sm font-medium rounded-lg transition-colors duration-200">
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