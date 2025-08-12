<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Mahasiswa YUWARAJA XVII') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome Card -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-white">
                    <h3 class="text-2xl font-bold mb-2">Selamat Datang, {{ $user->name }}! 👋</h3>
                    <p class="text-blue-100">Kelompok: {{ $user->kelompok->nama_kelompok ?? 'Belum ada Cluster' }}</p>
                    <p class="text-blue-100">Jurusan: {{ $user->jurusan ?? 'Belum diisi' }}</p>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Tugas -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-600">Total Tugas</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $tugas->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Pengumuman -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-600">Pengumuman Terbaru</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $pengumuman->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jadwal Mendatang -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zM4 7h12v9H4V7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-600">Jadwal Mendatang</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $jadwal->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Pengumuman Terbaru -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">📢 Pengumuman Terbaru</h3>
                        @if($pengumuman->count() > 0)
                            <div class="space-y-3">
                                @foreach($pengumuman as $announce)
                                <div class="border-l-4 border-blue-500 pl-4 py-2">
                                    <h4 class="font-medium text-gray-900">{{ $announce->judul }}</h4>
                                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($announce->konten, 100) }}</p>
                                    <p class="text-xs text-gray-400 mt-1">{{ $announce->created_at->diffForHumans() }}</p>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 italic">Belum ada pengumuman terbaru</p>
                        @endif
                    </div>
                </div>

                <!-- Jadwal Acara -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">📅 Jadwal Mendatang</h3>
                        @if($jadwal->count() > 0)
                            <div class="space-y-3">
                                @foreach($jadwal as $event)
                                <div class="border-l-4 border-purple-500 pl-4 py-2">
                                    <h4 class="font-medium text-gray-900">{{ $event->nama_acara }}</h4>
                                    <p class="text-sm text-gray-600 mt-1">{{ $event->lokasi ?? 'Lokasi belum ditentukan' }}</p>
                                    <p class="text-xs text-gray-400 mt-1">{{ $event->tanggal_mulai->format('d M Y, H:i') }}</p>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 italic">Belum ada jadwal mendatang</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Daftar Tugas -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">📝 Daftar Tugas</h3>
                    @if($tugas->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Tugas</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deadline</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($tugas as $task)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <a href="{{ route('tugas.show', $task) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                                                {{ $task->judul }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $task->deadline->format('d M Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $task->tipe == 'kelompok' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                                {{ ucfirst($task->tipe) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $task->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $task->is_active ? 'Aktif' : 'Selesai' }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 italic">Belum ada tugas yang diberikan</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
