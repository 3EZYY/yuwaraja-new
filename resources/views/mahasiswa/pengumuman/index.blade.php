<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pengumuman
        </h2>
    </x-slot>

    <div class="py-12 bg-black">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($pengumuman->count())
                        <ul>
                            @foreach($pengumuman as $item)
                                <li class="mb-4 border-b pb-2">
                                    <a href="{{ route('mahasiswa.pengumuman.detail', $item->id) }}" class="text-lg font-bold text-blue-700 hover:underline">
                                        {{ $item->judul }}
                                    </a>
                                    <div class="text-sm text-gray-500">{{ $item->created_at->format('d M Y H:i') }}</div>
                                    <div class="text-gray-700 mt-1">{{ Str::limit($item->isi, 100) }}</div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-4">{{ $pengumuman->links() }}</div>
                    @else
                        <div class="text-center text-gray-500">Belum ada pengumuman.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
