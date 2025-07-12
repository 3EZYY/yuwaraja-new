<x-spv-layout>
    <div class="max-w-3xl mx-auto py-10">
        <div class="bg-white p-8 rounded shadow">
            <h1 class="text-3xl font-bold text-blue-600 mb-4">{{ $pengumuman->judul }}</h1>
            <p class="text-gray-500 text-sm mb-2">Diposting: {{ $pengumuman->created_at->format('d M Y, H:i') }}</p>
            <div class="text-gray-800 leading-relaxed mb-6">{!! nl2br(e($pengumuman->konten)) !!}</div>
            <a href="{{ url()->previous() }}" class="text-blue-600 hover:underline">&larr; Kembali</a>
        </div>
    </div>
</x-spv-layout>
