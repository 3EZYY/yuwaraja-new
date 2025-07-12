<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Jadwal Acara
        </h2>
    </x-slot>

    <div class="py-12 bg-black">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($jadwal->count())
                        <ul>
                            @foreach($jadwal as $item)
                                <li class="mb-4 border-b pb-2">
                                    <a href="{{ route('mahasiswa.jadwal.detail', $item->id) }}" class="text-lg font-bold text-blue-700 hover:underline">
                                        {{ $item->judul }}
                                    </a>
                                    <div class="text-sm text-gray-500">{{ $item->tanggal_mulai->format('d M Y H:i') }} - {{ $item->tanggal_selesai->format('d M Y H:i') }}</div>
                                    <div class="text-gray-700 mt-1">{{ Str::limit($item->deskripsi, 100) }}</div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-4">{{ $jadwal->links() }}</div>
                    @else
                        <div class="text-center text-gray-500">Belum ada jadwal acara.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
