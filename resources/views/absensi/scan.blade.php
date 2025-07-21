@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-6">
            @if(session('success'))
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Absensi Berhasil!</h3>
                    <p class="text-sm text-gray-600 mb-4">{{ session('success') }}</p>
                    <div class="space-y-2 text-sm text-gray-500">
                        <p><strong>Waktu:</strong> {{ session('waktu_absen') }}</p>
                        <p><strong>Status:</strong> 
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ session('status') === 'Tepat Waktu' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ session('status') }}
                            </span>
                        </p>
                    </div>
                </div>
            @elseif(session('error'))
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                        <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Absensi Gagal</h3>
                    <p class="text-sm text-red-600 mb-4">{{ session('error') }}</p>
                </div>
            @endif

            <div class="mt-6 flex flex-col space-y-3">
                @auth
                    @if(auth()->user()->role === 'mahasiswa')
                        <a href="{{ route('mahasiswa.dashboard') }}" 
                           class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Kembali ke Dashboard
                        </a>
                        <a href="{{ route('mahasiswa.absensi.history') }}" 
                           class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Lihat Riwayat Absensi
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" 
                       class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Login untuk Absensi
                    </a>
                @endauth
            </div>
        </div>

        @if(isset($absensi))
            <div class="mt-6 bg-white rounded-lg shadow-lg p-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Informasi Absensi</h4>
                <div class="space-y-3 text-sm">
                    <div>
                        <span class="font-medium text-gray-700">Judul:</span>
                        <span class="text-gray-600">{{ $absensi->judul }}</span>
                    </div>
                    @if($absensi->deskripsi)
                        <div>
                            <span class="font-medium text-gray-700">Deskripsi:</span>
                            <span class="text-gray-600">{{ $absensi->deskripsi }}</span>
                        </div>
                    @endif
                    <div>
                        <span class="font-medium text-gray-700">Waktu:</span>
                        <span class="text-gray-600">
                            {{ $absensi->jam_mulai->format('H:i') }} - {{ $absensi->jam_selesai->format('H:i') }}
                        </span>
                    </div>
                    <div>
                        <span class="font-medium text-gray-700">Status:</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $absensi->status_color }}">
                            {{ $absensi->status_text }}
                        </span>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection