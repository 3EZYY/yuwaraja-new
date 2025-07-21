@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Absensi Aktif</h2>
            
            @if($activeAbsensi->count() > 0)
                <div class="space-y-4">
                    @foreach($activeAbsensi as $absensi)
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                            <h3 class="text-lg font-medium text-gray-900">{{ $absensi->judul }}</h3>
                            @if($absensi->deskripsi)
                                <p class="text-sm text-gray-600 mt-1">{{ $absensi->deskripsi }}</p>
                            @endif
                            
                            <div class="mt-3 flex items-center text-sm text-gray-500">
                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg>
                                {{ $absensi->jam_mulai->format('H:i') }} - {{ $absensi->jam_selesai->format('H:i') }}
                            </div>
                            
                            <div class="mt-4">
                                @php
                                    $attended = $absensi->mahasiswas->contains('id', auth()->id());
                                @endphp
                                
                                @if($attended)
                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                        <svg class="-ml-1 mr-1.5 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        Sudah Absen
                                    </div>
                                @else
                                    <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                        <svg class="-ml-1 mr-1.5 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        Belum Absen
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-6">
                    <button id="scanButton" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                        </svg>
                        Scan QR Code
                    </button>
                </div>
                
                <div id="qrScanner" class="mt-4 hidden">
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <div class="text-center mb-4">
                            <h4 class="text-sm font-medium text-gray-700">Arahkan kamera ke QR Code</h4>
                        </div>
                        <div id="reader" class="w-full"></div>
                    </div>
                </div>
            @else
                <div class="text-center py-4">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada absensi aktif</h3>
                    <p class="mt-1 text-sm text-gray-500">Saat ini tidak ada sesi absensi yang aktif.</p>
                </div>
            @endif
        </div>
        
        <div class="mt-6 bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Riwayat Absensi</h2>
            <a href="{{ route('mahasiswa.absensi.history') }}" class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Lihat Riwayat Absensi
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scanButton = document.getElementById('scanButton');
        const qrScanner = document.getElementById('qrScanner');
        
        if (scanButton) {
            scanButton.addEventListener('click', function() {
                qrScanner.classList.toggle('hidden');
                
                if (!qrScanner.classList.contains('hidden')) {
                    const html5QrCode = new Html5Qrcode("reader");
                    const config = { fps: 10, qrbox: { width: 250, height: 250 } };
                    
                    html5QrCode.start(
                        { facingMode: "environment" }, 
                        config, 
                        (decodedText) => {
                            // On successful scan
                            html5QrCode.stop();
                            window.location.href = decodedText;
                        },
                        (errorMessage) => {
                            // On error
                            console.log(errorMessage);
                        }
                    ).catch((err) => {
                        console.log(`Unable to start scanning: ${err}`);
                    });
                }
            });
        }
    });
</script>
@endpush
@endsection