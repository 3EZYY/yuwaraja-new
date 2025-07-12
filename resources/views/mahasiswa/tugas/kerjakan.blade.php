
@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2 class="mb-4">Kerjakan Tugas: {{ $tugas->judul }}</h2>
    <div class="mb-3">
        <strong>Deskripsi:</strong>
        <div class="bg-light p-2 rounded">{!! nl2br(e($tugas->deskripsi)) !!}</div>
    </div>

    {{-- Notifikasi status tugas --}}
    @if(isset($pengumpulan))
        <div class="mb-3">
            <span class="badge
                @if($pengumpulan->status === 'submitted') bg-warning text-dark
                @elseif($pengumpulan->status === 'done') bg-success
                @elseif($pengumpulan->status === 'revisi') bg-danger
                @else bg-secondary @endif">
                Status: {{ ucfirst($pengumpulan->status) }}
            </span>
        </div>
    @endif

    {{-- Feedback sukses/gagal --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Validasi error --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('mahasiswa.tugas.submit', $tugas->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="konten" class="form-label">Jawaban / Catatan</label>
            <textarea name="konten" id="konten" class="form-control" rows="5" required>{{ old('konten', $pengumpulan->konten ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label for="file" class="form-label">Upload File (opsional, max 10MB)</label>
            <input type="file" name="file" id="file" class="form-control" onchange="previewFile(event)">
            @if(isset($pengumpulan) && $pengumpulan->file)
                <div class="mt-2">
                    <a href="{{ asset('storage/' . $pengumpulan->file) }}" target="_blank">File Sebelumnya</a>
                </div>
            @endif
            <div id="file-preview" class="mt-2"></div>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Tugas</button>
    </form>
</div>

@push('scripts')
<script>
function previewFile(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('file-preview');
    preview.innerHTML = '';
    if (file) {
        if (file.type.startsWith('image/')) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.style.maxWidth = '200px';
            img.className = 'img-thumbnail';
            preview.appendChild(img);
        } else {
            preview.innerHTML = `<span class="text-secondary">File: ${file.name}</span>`;
        }
    }
}
</script>
@endpush
@endsection
