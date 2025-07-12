<x-app-layout>
    <div class="p-6 max-w-2xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Detail Tugas</h1>
        <div class="mb-4">
            <p class="font-semibold">Judul: <span class="font-normal">{{ $tugas->judul }}</span></p>
            <p class="font-semibold">Deskripsi:</p>
            <div class="bg-gray-100 rounded p-3 mb-2">{!! nl2br(e($tugas->deskripsi)) !!}</div>
            <p class="font-semibold">Deadline: <span class="font-normal">{{ $tugas->deadline->format('d M Y, H:i') }}</span></p>
            @if($tugas->file_path)
                <p class="font-semibold mt-2">File Tugas:
                    <a href="{{ Storage::url($tugas->file_path) }}" target="_blank" class="text-blue-600 underline ml-2">Download</a>
                </p>
            @endif
        </div>

        <hr class="my-6">

        <h2 class="text-xl font-semibold mb-2">Upload Tugas Anda</h2>
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
        @if(isset($pengumpulan) && $pengumpulan->file_path)
            <div class="mb-4">
                <p class="font-semibold">File yang sudah dikumpulkan:</p>
                <a href="{{ Storage::url($pengumpulan->file_path) }}" target="_blank" class="text-blue-600 underline">Download File</a>
                <p class="text-sm text-gray-500 mt-1">Dikumpulkan pada: {{ $pengumpulan->submitted_at ? $pengumpulan->submitted_at->format('d M Y, H:i') : '-' }}</p>
            </div>
        @endif
        @if(now() <= $tugas->deadline)
            <form action="{{ route('mahasiswa.tugas.submit', $tugas) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="file" class="block text-sm font-medium text-gray-700 mb-2">File Tugas <span class="text-red-500">*</span></label>
                    <input type="file" id="file" name="file" class="block w-full border border-gray-300 rounded p-2" accept=".pdf,.doc,.docx,.zip,.rar" required>
                    <p class="mt-1 text-xs text-gray-500">Format: PDF, DOC, DOCX, ZIP, RAR (Max: 10MB)</p>
                    @error('file')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">Keterangan (Opsional)</label>
                    <textarea id="keterangan" name="keterangan" rows="3" class="block w-full border border-gray-300 rounded p-2" placeholder="Catatan untuk tugas...">{{ old('keterangan', $pengumpulan->keterangan ?? '') }}</textarea>
                    @error('keterangan')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Kumpulkan Tugas</button>
            </form>
        @else
            <div class="bg-red-50 border border-red-200 rounded p-4 mt-4">
                <p class="text-red-700 font-semibold">Deadline tugas sudah berakhir. Anda tidak dapat mengumpulkan tugas ini.</p>
            </div>
        @endif
    </div>
</x-app-layout>
