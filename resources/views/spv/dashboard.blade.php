<x-spv-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('SPV Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-green-600 to-blue-600 overflow-hidden shadow-lg sm:rounded-lg mb-6">
                <div class="p-6 text-white">
                    <h3 class="text-2xl font-bold mb-2">Selamat Datang SPV, {{ $user->name }}! 👋</h3>
                    <p class="text-green-100">Dashboard Supervisor YUWARAJA XVII</p>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Total Kelompok -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Kelompok Dibimbing</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $totalKelompok }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Mahasiswa -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Mahasiswa Dibimbing</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $totalMahasiswa }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tugas Selesai -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Tugas Dikumpulkan</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $tugasSelesai }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kelompok yang Dibimbing -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Kelompok yang Dibimbing</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @forelse($kelompokDibimbing as $kelompok)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <h4 class="font-semibold text-gray-900">{{ $kelompok->nama_kelompok }}</h4>
                                <p class="text-sm text-gray-500">{{ $kelompok->mahasiswa->count() }} mahasiswa</p>
                                <div class="mt-2">
                                    <a href="{{ route('spv.kelompok') }}" class="text-blue-600 hover:text-blue-900 text-sm">
                                        Lihat Detail →
                                    </a>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 col-span-2">Belum ada kelompok yang dibimbing</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Recent Pengumuman -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Pengumuman Terbaru</h3>
                        <div class="space-y-3">
                            @forelse($pengumuman as $item)
                                <div class="border-l-4 border-blue-500 pl-4">
                                    <a href="{{ route('spv.pengumuman.detail', $item->id) }}" class="hover:underline">
                                        <p class="text-sm font-medium text-gray-900">{{ $item->judul }}</p>
                                    </a>
                                    <p class="text-xs text-gray-500">{{ $item->created_at->format('d M Y') }}</p>
                                </div>
                            @empty
                                <p class="text-gray-500">Belum ada pengumuman</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Recent Jadwal -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Jadwal Mendatang</h3>
                        <div class="space-y-3">
                            @forelse($jadwal as $item)
                                <div class="border-l-4 border-green-500 pl-4">
                                    <a href="{{ route('spv.jadwal.detail', $item->id) }}" class="hover:underline">
                                        <p class="text-sm font-medium text-gray-900">{{ $item->nama_acara }}</p>
                                    </a>
                                    <p class="text-xs text-gray-500">{{ $item->tanggal_mulai->format('d M Y') }}</p>
                                </div>
                            @empty
                                <p class="text-gray-500">Belum ada jadwal</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-spv-layout>
