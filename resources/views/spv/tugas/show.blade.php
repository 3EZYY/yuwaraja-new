@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Review Tugas Mahasiswa</h1>
    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Nama Mahasiswa:</strong> {{ $pengumpulan->user->name ?? '-' }}</p>
            <p><strong>Kelompok:</strong> {{ $pengumpulan->user->kelompok->nama ?? '-' }}</p>
            <p><strong>Judul Tugas:</strong> {{ $pengumpulan->tugas->judul ?? '-' }}</p>
            <p><strong>Status:</strong> {{ $pengumpulan->status }}</p>
            <p><strong>Nilai:</strong> {{ $pengumpulan->nilai ?? '-' }}</p>
            <p><strong>Keterangan:</strong> {{ $pengumpulan->keterangan ?? '-' }}</p>
            <p><strong>File:</strong>
                @if($pengumpulan->file_path)
                    <a href="{{ asset('storage/' . $pengumpulan->file_path) }}" target="_blank">Download</a>
                @else
                    -
                @endif
            </p>
            <form action="{{ route('spv.tugas-mahasiswa.approve', $pengumpulan->id) }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label for="nilai" class="form-label">Nilai</label>
                    <input type="number" name="nilai" id="nilai" class="form-control" value="{{ old('nilai', $pengumpulan->nilai) }}" min="0" max="100" required>
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control">{{ old('keterangan', $pengumpulan->keterangan) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="reviewed" {{ $pengumpulan->status == 'reviewed' ? 'selected' : '' }}>Perlu Diteliti</option>
                        <option value="approved" {{ $pengumpulan->status == 'approved' ? 'selected' : '' }}>Approve</option>
                        <option value="done" {{ $pengumpulan->status == 'done' ? 'selected' : '' }}>Done/Selesai</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Simpan Status &amp; Nilai</button>
            </form>
        </div>
    </div>
</div>
@endsection
