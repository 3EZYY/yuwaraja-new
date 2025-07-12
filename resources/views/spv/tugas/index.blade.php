@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Daftar Pengumpulan Tugas Mahasiswa</h1>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Nama Mahasiswa</th>
                <th>Kelompok</th>
                <th>Tugas</th>
                <th>Status</th>
                <th>Nilai</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pengumpulans as $pengumpulan)
            <tr>
                <td>{{ $pengumpulan->user->name ?? '-' }}</td>
                <td>{{ $pengumpulan->user->kelompok->nama ?? '-' }}</td>
                <td>{{ $pengumpulan->tugas->judul ?? '-' }}</td>
                <td>{{ $pengumpulan->status }}</td>
                <td>{{ $pengumpulan->nilai ?? '-' }}</td>
                <td>
                    <a href="{{ route('spv.tugas-mahasiswa.show', $pengumpulan->id) }}" class="btn btn-primary btn-sm">Detail &amp; Review</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
