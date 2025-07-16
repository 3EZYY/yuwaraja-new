@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto py-10">
        <div class="cyber-card p-8">
            <h1 class="text-3xl font-bold text-cyan-400 mb-4">{{ $jadwal->nama_acara }}</h1>
            <p class="text-gray-400 text-sm mb-2">Tanggal: {{ $jadwal->tanggal_mulai->format('d M Y, H:i') }}</p>
            <p class="text-gray-400 text-sm mb-2">Lokasi: {{ $jadwal->lokasi ?? 'Online' }}</p>
            <div class="text-white leading-relaxed mb-6">{!! nl2br(e($jadwal->deskripsi)) !!}</div>
            <a href="{{ route('mahasiswa.jadwal.index') }}" class="text-cyan-400 hover:underline">&larr; Kembali</a>
        </div>
    </div>
@endsection
