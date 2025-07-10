<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-red-600 to-pink-600 overflow-hidden shadow-lg sm:rounded-lg mb-6">
                <div class="p-6 text-white">
                    <h3 class="text-2xl font-bold mb-2">Selamat Datang Admin, {{ $user->name }}! 👋</h3>
                    <p class="text-red-100">Panel Administrator YUWARAJA XVII</p>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <!-- Total Users -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Users</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $totalUsers }}</dd>
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
                                    <dt class="text-sm font-medium text-gray-500 truncate">Mahasiswa</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $totalMahasiswa }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total SPV -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Supervisor</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $totalSpv }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Kelompok -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Kelompok</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $totalKelompok }}</dd>
                                </dl>
                            </div>
                        </div>
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
                            @forelse($pengumumanTerbaru as $pengumuman)
                                <div class="border-l-4 border-blue-500 pl-4">
                                    <p class="text-sm font-medium text-gray-900">{{ $pengumuman->judul }}</p>
                                    <p class="text-xs text-gray-500">{{ $pengumuman->created_at->format('d M Y') }}</p>
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
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Jadwal Terbaru</h3>
                        <div class="space-y-3">
                            @forelse($jadwalTerbaru as $jadwal)
                                <div class="border-l-4 border-green-500 pl-4">
                                    <p class="text-sm font-medium text-gray-900">{{ $jadwal->nama_acara }}</p>
                                    <p class="text-xs text-gray-500">{{ $jadwal->tanggal_mulai->format('d M Y') }}</p>
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
</x-admin-layout>
