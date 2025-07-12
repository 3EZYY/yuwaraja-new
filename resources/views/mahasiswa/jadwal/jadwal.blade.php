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
                    @if(isset($detailMode) && $detailMode)
                        <div class="mb-4 border-b pb-2">
                            <h1 class="text-2xl font-bold text-blue-700 mb-2">{{ $jadwal->nama_acara }}</h1>
                            <div class="text-sm text-gray-500 mb-1">{{ $jadwal->tanggal_mulai->format('d M Y H:i') }} - {{ $jadwal->tanggal_selesai->format('d M Y H:i') }}</div>
                            <div class="text-gray-700 mb-2">{{ $jadwal->lokasi ?? 'Online' }}</div>
                            <div class="text-gray-800 leading-relaxed">{!! nl2br(e($jadwal->deskripsi)) !!}</div>
                        </div>
                        <a href="{{ route('mahasiswa.jadwal.index') }}" class="text-blue-600 hover:underline">&larr; Kembali ke Jadwal</a>
                    @elseif($jadwal->count())
                        <ul>
                            @foreach($jadwal as $item)
                                <li class="mb-4 border-b pb-2">
                                    <a href="{{ route('mahasiswa.jadwal.detail', $item->id) }}" class="text-lg font-bold text-blue-700 hover:underline">
                                        {{ $item->nama_acara }}
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
