@extends('layouts.spv')

{{-- Menambahkan font poppins dan Kanit jika belum ada di layout utama --}}
@section('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;700&family=Poppins:wght@700;900&display=swap" rel="stylesheet">
<style>
    /* Menggunakan font yang telah ditentukan */
    .font-poppins { font-family: 'Poppins', sans-serif; }
    .font-kanit> { font-family: 'Kanit', sans-serif; }
</style>
@endsection


@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#0F2027] via-[#203A43] to-[#2C5364] p-4 md:p-6 lg:p-8 font-poppins text-gray-200">
    <div class="max-w-full">
        <!-- Header Section Sesuai Tema Logo -->
        <div class="mb-6 lg:mb-8">
            <div class="relative overflow-hidden bg-gradient-to-r from-cyan-600/80 via-teal-700/80 to-cyan-900/80 rounded-2xl p-6 lg:p-8 shadow-2xl border border-cyan-400/30">
                <!-- Efek Visual -->
                <div class="absolute inset-0 bg-black/30"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/10 via-transparent to-teal-500/10"></div>
                <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-cyan-400 to-amber-400 blur-lg opacity-30"></div>
                <div class="absolute inset-[2px] rounded-2xl bg-gradient-to-r from-gray-800 via-gray-900 to-black"></div>
                
                <!-- Konten Header -->
                <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between text-white">
                    <div class="mb-6 lg:mb-0">
                        <div class="flex items-center mb-4">
                            <div class="bg-cyan-400/10 backdrop-blur-sm rounded-xl p-3 mr-4 border border-cyan-300/30">
                                <i class="fas fa-user-shield text-2xl text-cyan-300"></i>
                            </div>
                            <div>
                                <h1 class="text-3xl lg:text-4xl font-kanit font-bold bg-gradient-to-r from-white to-cyan-300 bg-clip-text text-transparent tracking-wider">
                                    ADAPTIVE
                                </h1>
                                <div class="text-lg font-medium text-cyan-200/80 mt-1">Supervisor Control</div>
                            </div>
                        </div>
                        <p class="text-gray-300/80 text-base lg:text-lg leading-relaxed max-w-2xl">
                            Monitor dan kelola absensi mahasiswa dengan sistem terintegrasi real-time.
                        </p>
                    </div>
                    
                    <!-- Stats Dashboard Sesuai Tema Logo -->
                    <div class="relative">
                        <div class="bg-black/40 backdrop-blur-md rounded-xl p-6 border border-cyan-400/20 shadow-2xl">
                            <div class="grid grid-cols-3 gap-4 md:gap-6">
                                <div class="text-center">
                                    <div class="bg-gradient-to-br from-yellow-400 to-amber-500 text-black text-xl lg:text-2xl font-bold rounded-lg px-3 py-2 mb-2 font-kanit">
                                        {{ $pendingRequests->count() }}
                                    </div>
                                    <div class="text-xs lg:text-sm text-yellow-300 font-semibold uppercase tracking-wide">PENDING</div>
                                </div>
                                <div class="text-center border-x border-cyan-400/30">
                                    <div class="bg-gradient-to-br from-cyan-400 to-teal-500 text-black text-xl lg:text-2xl font-bold rounded-lg px-3 py-2 mb-2 font-kanit">
                                        {{ $absensiList->count() }}
                                    </div>
                                    <div class="text-xs lg:text-sm text-cyan-300 font-semibold uppercase tracking-wide">AKTIF</div>
                                </div>
                                <div class="text-center">
                                    <div class="bg-gradient-to-br from-emerald-400 to-green-500 text-black text-xl lg:text-2xl font-bold rounded-lg px-3 py-2 mb-2 font-kanit">
                                        {{ $approvedRequests->count() }}
                                    </div>
                                    <div class="text-xs lg:text-sm text-emerald-300 font-semibold uppercase tracking-wide">DISETUJUI</div>
                                </div>
                            </div>
                        </div>
                        <div class="absolute -inset-1 bg-gradient-to-r from-cyan-400/20 to-amber-400/20 rounded-xl blur opacity-75"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Messages Sesuai Tema Logo -->
        @if(session('success'))
            <div class="bg-gradient-to-r from-green-500/10 to-emerald-500/10 border border-green-400/50 text-green-200 px-6 py-4 rounded-xl mb-6 shadow-lg backdrop-blur-sm">
                <div class="flex items-center">
                    <div class="bg-green-400/20 rounded-lg p-2 mr-4"><i class="fas fa-check-circle text-green-400 text-lg"></i></div>
                    <div>
                        <div class="font-bold text-white">Operasi Berhasil</div>
                        <div class="text-sm text-green-200/80">{{ session('success') }}</div>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-gradient-to-r from-red-500/10 to-rose-500/10 border border-red-400/50 text-red-300 px-6 py-4 rounded-xl mb-6 shadow-lg backdrop-blur-sm">
                <div class="flex items-center">
                    <div class="bg-red-400/20 rounded-lg p-2 mr-4"><i class="fas fa-exclamation-triangle text-red-400 text-lg"></i></div>
                    <div>
                        <div class="font-bold text-white">System Error</div>
                        <div class="text-sm text-red-300/80">{{ session('error') }}</div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Pending Requests Card Sesuai Tema Logo (Kuning/Emas) -->
        @if($pendingRequests->count() > 0)
        <div class="bg-gray-900/70 backdrop-blur-md rounded-2xl shadow-2xl border border-amber-400/30 mb-6 lg:mb-8 overflow-hidden">
            <div class="relative bg-gradient-to-r from-yellow-400 via-amber-500 to-cyan-500 px-6 py-5">
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="relative z-10">
                    <h2 class="text-lg lg:text-xl font-bold text-gray-900 flex items-center">
                        <div class="bg-black/20 backdrop-blur-sm rounded-xl p-3 mr-4 border border-black/30"><i class="fas fa-clock text-amber-300 text-lg"></i></div>
                        <div>
                            <div class="font-kanit text-xl font-black text-white">PENDING REQUESTS</div>
                            <div class="text-sm font-semibold opacity-80">Menunggu Verifikasi</div>
                        </div>
                        <div class="ml-auto bg-black/20 backdrop-blur-sm px-4 py-2 rounded-full"><span class="text-lg font-bold text-white">{{ $pendingRequests->count() }}</span></div>
                    </h2>
                </div>
            </div>
            
            <div class="p-4 md:p-6">
                <!-- Mobile Cards View -->
                <div class="block lg:hidden space-y-4">
                    @foreach($pendingRequests as $request)
                    <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl p-5 border border-gray-700 hover:border-amber-400/50 transition-all duration-300">
                        <div class="flex items-start space-x-4 mb-4">
                            <div class="flex-shrink-0">
                                @if($request->mahasiswa->photo)
                                    <img class="h-14 w-14 rounded-xl object-cover ring-2 ring-amber-400/50" src="{{ asset('profile-pictures/' . $request->mahasiswa->photo) }}" alt="">
                                @else
                                    <div class="h-14 w-14 rounded-xl bg-gradient-to-br from-gray-700 to-gray-800 flex items-center justify-center ring-2 ring-amber-400/50"><i class="fas fa-user text-amber-400 text-lg"></i></div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="font-bold text-white text-base">{{ $request->mahasiswa->name }}</div>
                                <div class="text-sm text-gray-400">{{ $request->mahasiswa->nim }}</div>
                                <div class="text-xs text-cyan-400 font-medium">{{ $request->mahasiswa->kelompok->nama_kelompok ?? 'Belum ada kelompok' }}</div>
                            </div>
                        </div>
                        <div class="space-y-3 mb-5">
                            <div class="flex items-center text-sm"><i class="fas fa-bookmark text-amber-400 mr-3 w-4"></i><span class="font-semibold text-gray-200">{{ $request->absensi->judul }}</span></div>
                            <div class="flex items-center text-sm text-gray-400"><i class="fas fa-info-circle text-cyan-400 mr-3 w-4"></i><span>{{ $request->waktu_absen->format('d M Y, H:i') }}</span></div>
                            @if($request->keterangan)
                            <div class="bg-gray-800/70 rounded-lg p-3 border-l-4 border-amber-400"><div class="text-xs text-gray-300">{{ $request->keterangan }}</div></div>@endif
                        </div>
                        <div class="flex space-x-3">
                            <form action="{{ route('spv.absensi.approve', $request) }}" method="POST" class="flex-1">@csrf @method('PATCH')
                                <button type="submit" class="w-full bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white px-4 py-3 rounded-xl text-sm font-bold transition-all duration-300 transform hover:scale-[1.02] shadow-lg"><i class="fas fa-check mr-2"></i>APPROVE</button>
                            </form>
                            <button onclick="openRejectModal({{ $request->id }})" class="flex-1 bg-gradient-to-r from-rose-500 to-red-600 hover:from-rose-600 hover:to-red-700 text-white px-4 py-3 rounded-xl text-sm font-bold transition-all duration-300 transform hover:scale-[1.02] shadow-lg"><i class="fas fa-times mr-2"></i>REJECT</button>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Desktop Table View -->
                <div class="hidden lg:block overflow-x-auto">
                    <table class="min-w-full"><thead class="bg-gray-900/50"><tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-amber-300 uppercase tracking-wider border-b border-gray-700"><i class="fas fa-user mr-2"></i>Mahasiswa</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-amber-300 uppercase tracking-wider border-b border-gray-700"><i class="fas fa-bookmark mr-2"></i>Absensi</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-amber-300 uppercase tracking-wider border-b border-gray-700"><i class="fas fa-clock mr-2"></i>Waktu Request</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-amber-300 uppercase tracking-wider border-b border-gray-700"><i class="fas fa-comment mr-2"></i>Keterangan</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-amber-300 uppercase tracking-wider border-b border-gray-700"><i class="fas fa-cogs mr-2"></i>Aksi</th>
                    </tr></thead><tbody class="divide-y divide-gray-700">@foreach($pendingRequests as $request)<tr class="hover:bg-amber-500/5 transition-all duration-300 group">
                        <td class="px-6 py-5 whitespace-nowrap"><div class="flex items-center"><div class="flex-shrink-0 h-12 w-12">@if($request->mahasiswa->photo)
                            <img class="h-12 w-12 rounded-xl object-cover ring-2 ring-amber-400/50 group-hover:ring-amber-400 transition-all" src="{{ asset('profile-pictures/' . $request->mahasiswa->photo) }}" alt="">@else
                            <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-gray-700 to-gray-800 flex items-center justify-center ring-2 ring-amber-400/50 group-hover:ring-amber-400 transition-all"><i class="fas fa-user text-amber-400"></i></div>@endif</div>
                            <div class="ml-4"><div class="text-sm font-bold text-white">{{ $request->mahasiswa->name }}</div><div class="text-sm text-gray-400">{{ $request->mahasiswa->nim }}</div><div class="text-xs text-cyan-400">{{ $request->mahasiswa->kelompok->nama_kelompok ?? 'Belum ada kelompok' }}</div></div></div></td>
                        <td class="px-6 py-5 whitespace-nowrap"><div class="text-sm font-semibold text-gray-200">{{ $request->absensi->judul }}</div><div class="text-sm text-gray-400">{{ $request->absensi->tanggal->format('d M Y') }}</div><div class="text-xs text-cyan-400">{{ $request->absensi->jam_mulai_formatted }} - {{ $request->absensi->jam_selesai_formatted }}</div></td>
                        <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-300">{{ $request->waktu_absen->format('d M Y, H:i') }}</td>
                        <td class="px-6 py-5 text-sm text-gray-400 max-w-xs"><div class="truncate">{{ $request->keterangan ?? 'Tidak ada keterangan' }}</div></td>
                        <td class="px-6 py-5 whitespace-nowrap text-sm font-medium"><div class="flex space-x-3">
                            <form action="{{ route('spv.absensi.approve', $request) }}" method="POST">@csrf @method('PATCH')<button type="submit" class="bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white px-4 py-2 rounded-lg text-xs font-bold transition-all transform hover:scale-105 shadow-lg"><i class="fas fa-check mr-1"></i>APPROVE</button></form>
                            <button onclick="openRejectModal({{ $request->id }})" class="bg-gradient-to-r from-rose-500 to-red-600 hover:from-rose-600 hover:to-red-700 text-white px-4 py-2 rounded-lg text-xs font-bold transition-all transform hover:scale-105 shadow-lg"><i class="fas fa-times mr-1"></i>REJECT</button>
                        </div></td></tr>@endforeach</tbody></table>
                </div>
            </div>
        </div>
        @endif

        <!-- Daftar Absensi Aktif Sesuai Tema Logo (Cyan/Teal) -->
        <div class="bg-gray-900/70 backdrop-blur-md rounded-2xl shadow-2xl border border-cyan-400/30 mb-6 lg:mb-8 overflow-hidden">
            <div class="relative bg-gradient-to-r from-cyan-500 via-teal-600 to-cyan-800 px-6 py-5">
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="relative z-10"><h2 class="text-lg lg:text-xl font-bold text-white flex items-center">
                    <div class="bg-black/20 backdrop-blur-sm rounded-xl p-3 mr-4 border border-black/30"><i class="fas fa-database text-cyan-300 text-lg"></i></div>
                    <div><div class="font-kanit text-xl font-black">ACTIVE SESSIONS</div><div class="text-sm font-semibold opacity-80">Sesi Monitoring</div></div>
                </h2></div>
            </div>
            
            <div class="p-4 md:p-6">
                @if($absensiList->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($absensiList as $absensi)
                    <div class="group relative bg-gray-800/40 backdrop-blur-sm border border-gray-700/50 rounded-2xl p-6 hover:border-yellow-400 hover:shadow-2xl hover:shadow-cyan-500/10 transition-all duration-500 transform hover:scale-[1.02]">
                        <div class="absolute inset-0 bg-gradient-to-r from-cyan-400/0 to-teal-400/0 group-hover:from-cyan-400/10 group-hover:to-teal-400/10 rounded-2xl transition-all duration-500"></div>
                        <div class="relative z-10 flex items-start justify-between mb-5">
                            <div class="bg-cyan-400/10 backdrop-blur-sm rounded-xl p-3 group-hover:bg-cyan-400/20 transition-all duration-300 border border-yellow-400/30"><i class="fas fa-calendar-check text-cyan-400 text-lg"></i></div>
                            <div class="text-right"><div class="bg-gradient-to-r from-cyan-500 to-teal-600 text-white text-xs px-3 py-1.5 rounded-full font-bold shadow-lg">{{ $absensi->absensiMahasiswa()->count() }} REQ</div></div>
                        </div>
                        <h3 class="relative z-10 font-bold text-gray-200 group-hover:text-white mb-4 text-base lg:text-lg line-clamp-2 transition-colors">{{ $absensi->judul }}</h3>
                        <div class="relative z-10 space-y-3 mb-5">
                            <div class="flex items-center text-sm text-gray-300 group-hover:text-gray-200"><div class="bg-cyan-400/10 rounded-lg p-1.5 mr-3"><i class="fas fa-calendar text-cyan-400 text-xs"></i></div><span class="font-medium">{{ $absensi->tanggal->format('d M Y') }}</span></div>
                            <div class="flex items-center text-sm text-gray-300 group-hover:text-gray-200"><div class="bg-cyan-400/10 rounded-lg p-1.5 mr-3"><i class="fas fa-clock text-cyan-400 text-xs"></i></div><span class="font-medium">{{ $absensi->jam_mulai_formatted }} - {{ $absensi->jam_selesai_formatted }}</span></div>
                        </div>
                        @if($absensi->deskripsi)
                        <div class="relative z-10 bg-gray-800/50 backdrop-blur-sm rounded-xl p-4 mb-5 border border-gray-600/30 group-hover:border-gray-500/50"><p class="text-xs text-gray-400 group-hover:text-gray-300 line-clamp-2">{{ Str::limit($absensi->deskripsi, 80) }}</p></div>@endif
                        <div class="relative z-10 flex justify-end"><a href="{{ route('spv.absensi.show', $absensi) }}" class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-cyan-500 to-teal-600 hover:from-cyan-600 hover:to-teal-700 text-white text-sm font-bold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-cyan-500/25"><span>VIEW DETAILS</span><i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i></a></div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-16"><div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl w-20 h-20 flex items-center justify-center mx-auto mb-6 border border-gray-700/50"><i class="fas fa-database text-3xl text-gray-500"></i></div><h3 class="text-xl font-bold text-gray-300 mb-3">TIDAK ADA SESI AKTIF</h3><p class="text-gray-500 text-sm max-w-md mx-auto">Sistem belum memiliki sesi absensi aktif yang berjalan.</p></div>
                @endif
            </div>
        </div>

        <!-- Riwayat Disetujui Sesuai Tema Logo (Hijau) -->
        @if($approvedRequests->count() > 0)
        <div class="bg-gray-900/70 backdrop-blur-md rounded-2xl shadow-2xl border border-green-400/30 overflow-hidden">
            <div class="relative bg-gradient-to-r from-emerald-500 via-green-600 to-teal-700 px-6 py-5">
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="relative z-10"><h2 class="text-lg lg:text-xl font-bold text-white flex items-center">
                    <div class="bg-black/20 backdrop-blur-sm rounded-xl p-3 mr-4 border border-black/30"><i class="fas fa-check-circle text-green-300 text-lg"></i></div>
                    <div><div class="font-kanit text-xl font-black">APPROVED RECORDS</div><div class="text-sm font-semibold opacity-80">Riwayat Persetujuan</div></div>
                    <div class="ml-auto bg-black/20 backdrop-blur-sm px-4 py-2 rounded-full"><span class="text-sm font-bold text-white">20 TERAKHIR</span></div>
                </h2></div>
            </div>
            <div class="p-4 md:p-6"><div class="block lg:hidden space-y-4">
                @foreach($approvedRequests as $request)
                <div class="bg-gradient-to-br from-green-500/5 to-emerald-500/5 backdrop-blur-sm rounded-xl p-5 border border-green-400/30 hover:border-green-400/50 transition-all">
                    <div class="flex items-start space-x-4 mb-4"><div class="flex-shrink-0">@if($request->mahasiswa->photo)
                        <img class="h-12 w-12 rounded-xl object-cover ring-2 ring-green-400/50" src="{{ asset('profile-pictures/' . $request->mahasiswa->photo) }}" alt="">@else
                        <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-green-400 to-emerald-600 flex items-center justify-center ring-2 ring-green-400/50"><i class="fas fa-user text-white text-sm"></i></div>@endif</div>
                        <div class="flex-1 min-w-0"><div class="font-bold text-white text-sm">{{ $request->mahasiswa->name }}</div><div class="text-sm text-gray-400">{{ $request->mahasiswa->nim }}</div><div class="text-xs text-green-400 font-medium">{{ $request->absensi->judul }}</div></div>
                        <div class="flex-shrink-0"><span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-green-400/10 text-green-300 border border-green-400/30"><i class="fas fa-check mr-1"></i>APPROVED</span></div>
                    </div>
                </div>
                @endforeach
            </div><div class="hidden lg:block overflow-x-auto"><table class="min-w-full"><thead class="bg-gray-900/50"><tr>
                <th class="px-6 py-4 text-left text-xs font-bold text-green-300 uppercase tracking-wider border-b border-gray-700"><i class="fas fa-user mr-2"></i>Mahasiswa</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-green-300 uppercase tracking-wider border-b border-gray-700"><i class="fas fa-bookmark mr-2"></i>Absensi</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-green-300 uppercase tracking-wider border-b border-gray-700"><i class="fas fa-clock mr-2"></i>Approved At</th>
                <th class="px-6 py-4 text-left text-xs font-bold text-green-300 uppercase tracking-wider border-b border-gray-700"><i class="fas fa-check mr-2"></i>Status</th>
            </tr></thead><tbody class="divide-y divide-gray-700">@foreach($approvedRequests as $request)<tr class="hover:bg-green-500/5 transition-all group">
                <td class="px-6 py-5 whitespace-nowrap"><div class="flex items-center"><div class="flex-shrink-0 h-10 w-10">@if($request->mahasiswa->photo)
                    <img class="h-10 w-10 rounded-xl object-cover ring-2 ring-green-400/50 group-hover:ring-green-400" src="{{ asset('profile-pictures/' . $request->mahasiswa->photo) }}" alt="">@else
                    <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-green-400 to-emerald-600 flex items-center justify-center ring-2 ring-green-400/50 group-hover:ring-green-400"><i class="fas fa-user text-white text-xs"></i></div>@endif</div>
                    <div class="ml-4"><div class="text-sm font-bold text-gray-200 group-hover:text-white">{{ $request->mahasiswa->name }}</div><div class="text-xs text-gray-400">{{ $request->mahasiswa->nim }}</div></div></div></td>
                <td class="px-6 py-5 whitespace-nowrap"><div class="text-sm font-semibold text-gray-200">{{ $request->absensi->judul }}</div><div class="text-xs text-gray-400">{{ $request->absensi->tanggal->format('d M Y') }}</div></td>
                <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-300">{{ $request->approved_at->format('d M Y, H:i') }}</td>
                <td class="px-6 py-5 whitespace-nowrap"><span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-green-400/10 text-green-300 border border-green-400/30"><i class="fas fa-check mr-1"></i>APPROVED</span></td>
            </tr>@endforeach</tbody></table></div></div>
        </div>
        @endif
    </div>
</div>

<!-- Modal Reject Sesuai Tema Logo -->
<div id="rejectModal" class="fixed inset-0 bg-black/70 backdrop-blur-md overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 w-11/12 max-w-md">
        <div class="relative bg-gradient-to-br from-gray-800/95 to-gray-900/95 rounded-2xl shadow-2xl border border-red-500/30 overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-red-500/20 to-rose-500/20 blur-sm"></div>
            <div class="absolute inset-[1px] rounded-2xl bg-gradient-to-br from-gray-800/95 to-gray-900/95"></div>
            <div class="relative z-10 bg-gradient-to-r from-red-500 via-rose-600 to-red-700 px-6 py-5">
                <div class="absolute inset-0 bg-black/20"></div>
                <div class="relative z-10"><h3 class="text-lg font-bold text-white flex items-center">
                    <div class="bg-black/20 backdrop-blur-sm rounded-xl p-3 mr-4 border border-black/30"><i class="fas fa-times text-white text-lg"></i></div>
                    <div><div class="font-kanit text-xl font-black">REJECT REQUEST</div><div class="text-sm font-semibold opacity-80">Konfirmasi Penolakan</div></div>
                </h3></div>
            </div>
            <div class="relative z-10 p-6">
                <p class="text-gray-300 mb-4 text-sm">Anda akan menolak permintaan absensi. Berikan alasan yang jelas pada kolom di bawah.</p>
                <form id="rejectForm" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH')
                    <div><textarea name="keterangan" class="w-full px-4 py-3 bg-gray-800/50 backdrop-blur-sm border border-gray-600/50 rounded-xl text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 resize-none" rows="4" placeholder="Tulis alasan penolakan..." required></textarea></div>
                    <div class="flex flex-col sm:flex-row gap-4 pt-2">
                        <button type="submit" class="flex-1 px-6 py-4 bg-gradient-to-r from-rose-500 to-red-600 hover:from-rose-600 hover:to-red-700 text-white text-sm font-bold rounded-xl transition-all transform hover:scale-[1.02] shadow-lg flex items-center justify-center">
                            <i class="fas fa-times-circle mr-2"></i>KONFIRMASI PENOLAKAN
                        </button>
                        <button type="button" onclick="closeRejectModal()" class="flex-1 px-6 py-4 bg-gray-700/50 hover:bg-gray-600/50 border border-gray-600/50 text-gray-200 text-sm font-bold rounded-xl transition-all transform hover:scale-[1.02] flex items-center justify-center">
                            <i class="fas fa-arrow-left mr-2"></i>BATAL
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function openRejectModal(requestId) {
    // Pastikan route ini sesuai dengan yang ada di web.php Anda
    document.getElementById('rejectForm').action = `/spv/absensi/${requestId}/reject`; 
    document.getElementById('rejectModal').classList.remove('hidden');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
}
</script>
@endsection