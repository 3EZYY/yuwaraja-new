<x-app-layout>
    <div class="py-12 bg-black">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-gray-900 mb-4">Daftar Penugasan</h1>
                    @if($tugas->isEmpty())
                        <p class="text-gray-600">Belum ada tugas.</p>
                    @else
                        <div class="space-y-4">
                            @foreach($tugas as $item)
                                <div class="border-b pb-4 flex flex-col md:flex-row md:items-center md:justify-between">
                                    <div>
                                        <a href="{{ route('mahasiswa.tugas.show', $item->id) }}" class="text-lg font-semibold text-blue-700 hover:underline">
                                            {{ $item->judul }}
                                        </a>
                                        <div class="flex items-center space-x-2 mt-1">
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full {{ $item->tipe == 'kelompok' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                                {{ ucfirst($item->tipe) }}
                                            </span>
                                            <span class="text-xs text-gray-500">
                                                Deadline: {{ \Carbon\Carbon::parse($item->deadline)->format('d M Y') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mt-2 md:mt-0">
                                        @php $pengumpulan = $pengumpulanTugas[$item->id] ?? null; @endphp
                                        @if($pengumpulan)
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full
                                                @if($pengumpulan->status == 'submitted') bg-yellow-100 text-yellow-800
                                                @elseif($pengumpulan->status == 'approved') bg-green-100 text-green-800
                                                @elseif($pengumpulan->status == 'rejected') bg-red-100 text-red-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                @if($pengumpulan->status == 'submitted') Sudah Dikumpulkan
                                                @elseif($pengumpulan->status == 'approved') Diterima
                                                @elseif($pengumpulan->status == 'rejected') Ditolak
                                                @else Draft
                                                @endif
                                            </span>
                                        @else
                                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                Belum Dikumpulkan
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
