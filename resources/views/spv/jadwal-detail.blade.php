<x-spv-layout>
    <div class="max-w-3xl mx-auto py-10">
        <div class="bg-white p-8 rounded shadow">
            <h1 class="text-3xl font-bold text-green-600 mb-4">{{ $jadwal->nama_acara }}</h1>
            <p class="text-gray-500 text-sm mb-2">Tanggal: {{ $jadwal->tanggal_mulai->format('d M Y, H:i') }}</p>
            <p class="text-gray-500 text-sm mb-2">Lokasi: {{ $jadwal->lokasi ?? 'Online' }}</p>
            <div class="text-gray-800 leading-relaxed mb-6">{!! nl2br(e($jadwal->deskripsi)) !!}</div>
            <a href="{{ url()->previous() }}" class="text-green-600 hover:underline">&larr; Kembali</a>
        </div>
    </div>
</x-spv-layout>
