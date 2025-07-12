<x-filament::page>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Statistik Overview -->
        <div class="col-span-full">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Mahasiswa -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm">
                    <div class="p-6">
                        <div class="flex items-center gap-4">
                            <div class="p-2 bg-primary-100 rounded-lg">
                                <x-heroicon-o-users class="w-6 h-6 text-primary-700"/>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Mahasiswa</p>
                                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">
                                    {{ \App\Models\User::where('role', 'mahasiswa')->count() }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Kelompok -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm">
                    <div class="p-6">
                        <div class="flex items-center gap-4">
                            <div class="p-2 bg-success-100 rounded-lg">
                                <x-heroicon-o-user-group class="w-6 h-6 text-success-700"/>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Kelompok</p>
                                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">
                                    {{ \App\Models\Kelompok::count() }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Tugas -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm">
                    <div class="p-6">
                        <div class="flex items-center gap-4">
                            <div class="p-2 bg-warning-100 rounded-lg">
                                <x-heroicon-o-clipboard-document-list class="w-6 h-6 text-warning-700"/>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Tugas</p>
                                <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">
                                    {{ \App\Models\Tugas::count() }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Aktivitas Terbaru</h2>
                    <div class="space-y-4">
                        @foreach(\App\Models\Pengumuman::latest()->take(5)->get() as $pengumuman)
                        <div class="flex items-start gap-4">
                            <div class="p-2 bg-primary-100 rounded-lg">
                                <x-heroicon-o-bell-alert class="w-5 h-5 text-primary-700"/>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-900 dark:text-white">{{ $pengumuman->judul }}</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ Str::limit($pengumuman->konten, 100) }}
                                </p>
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $pengumuman->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Menu Cepat</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('filament.admin.resources.mahasiswa.index') }}" 
                           class="flex flex-col items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                            <x-heroicon-o-users class="w-6 h-6 text-primary-700 mb-2"/>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Mahasiswa</span>
                        </a>
                        <a href="{{ route('filament.admin.resources.kelompok.index') }}"
                           class="flex flex-col items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                            <x-heroicon-o-user-group class="w-6 h-6 text-success-700 mb-2"/>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Kelompok</span>
                        </a>
                        <a href="{{ route('filament.admin.resources.tugas.index') }}"
                           class="flex flex-col items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                            <x-heroicon-o-clipboard-document-list class="w-6 h-6 text-warning-700 mb-2"/>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Tugas</span>
                        </a>
                        <a href="{{ route('filament.admin.resources.pengumuman.index') }}"
                           class="flex flex-col items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                            <x-heroicon-o-bell-alert class="w-6 h-6 text-danger-700 mb-2"/>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">Pengumuman</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament::page>
