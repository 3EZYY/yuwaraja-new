<x-filament-panels::page>
    <div class="space-y-6">
        <!-- Header Info -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Informasi Absensi</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $record->judul }}</p>
                    @if($record->deskripsi)
                        <p class="text-sm text-gray-500 dark:text-gray-500 mt-1">{{ $record->deskripsi }}</p>
                    @endif
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Waktu</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ $record->jam_mulai->format('d/m/Y H:i') }} - {{ $record->jam_selesai->format('d/m/Y H:i') }}
                    </p>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mt-2
                        @if($record->status_color === 'green') bg-green-100 text-green-800
                        @elseif($record->status_color === 'yellow') bg-yellow-100 text-yellow-800
                        @elseif($record->status_color === 'red') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                        {{ $record->status_text }}
                    </span>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Statistik</h3>
                    <div class="space-y-1">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-medium text-green-600">{{ $record->total_hadir }}</span> Hadir
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <span class="font-medium text-red-600">{{ $record->total_belum_hadir }}</span> Belum Absen
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm">
            {{ $this->table }}
        </div>
    </div>
</x-filament-panels::page>