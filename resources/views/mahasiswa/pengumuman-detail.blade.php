@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto py-10">
        <div class="cyber-card p-8">
            <h1 class="text-3xl font-bold text-yellow-400 mb-4">{{ $pengumuman->judul }}</h1>
            <p class="text-gray-400 text-sm mb-2">Diposting: {{ $pengumuman->created_at->format('d M Y, H:i') }}</p>
            <div class="text-white leading-relaxed mb-6">{!! nl2br(e($pengumuman->konten)) !!}</div>
            <a href="{{ url()->previous() }}" class="text-cyan-400 hover:underline">&larr; Kembali</a>
        </div>
    </div>
@endsection
