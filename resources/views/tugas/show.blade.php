<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $tugas->judul }}
        </h2>
    </x-slot>

    <div class="py-12 bg-black">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Detail Tugas -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $tugas->judul }}</h1>
                            <div class="flex items-center space-x-4 mt-2">
                                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $tugas->tipe == 'kelompok' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                                    {{ ucfirst($tugas->tipe) }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    Deadline: {{ $tugas->deadline->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Status Badge -->
                        @if($pengumpulan)
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                                @if($pengumpulan->status == 'submitted') bg-yellow-100 text-yellow-800
                                @elseif($pengumpulan->status == 'approved') bg-green-100 text-green-800
                                @elseif($pengumpulan->status == 'rejected') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                @if($pengumpulan->status == 'submitted') Sudah Dikumpulkan
                                @elseif($pengumpulan->status == 'approved') Diterima
                                @elseif($pengumpulan->status == 'rejected') Ditolak
                                @else Draft
                                @endif
                            </span>
                        @else
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                Belum Dikumpulkan
                            </span>
                        @endif
                    </div>

                    <div class="prose max-w-none">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Deskripsi Tugas:</h3>
                        <p class="text-gray-700 leading-relaxed">{{ $tugas->deskripsi }}</p>
                    </div>

                    <!-- Info Pengumpulan Sebelumnya -->
                    @if($pengumpulan && $pengumpulan->submitted_at)
                        <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                            <h4 class="font-semibold text-gray-900 mb-2">Info Pengumpulan:</h4>
                            <p class="text-sm text-gray-600">Dikumpulkan: {{ $pengumpulan->submitted_at->format('d M Y, H:i') }}</p>
                            @if($pengumpulan->keterangan)
                                <p class="text-sm text-gray-600 mt-1">Keterangan: {{ $pengumpulan->keterangan }}</p>
                            @endif
                            @if($pengumpulan->nilai)
                                <p class="text-sm text-gray-600 mt-1">Nilai: {{ $pengumpulan->nilai }}</p>
                            @endif
                            @if($pengumpulan->feedback)
                                <p class="text-sm text-gray-600 mt-1">Feedback: {{ $pengumpulan->feedback }}</p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- Form Pengumpulan -->
            @if(!auth()->user()->kelompok_id)
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">Belum Tergabung dalam Kelompok</h3>
                            <p class="mt-1 text-sm text-yellow-700">Anda harus tergabung dalam kelompok terlebih dahulu sebelum dapat mengumpulkan tugas.</p>
                        </div>
                    </div>
                </div>
            @elseif($tugas->deadline < now())
                <div class="bg-red-50 border border-red-200 rounded-lg p-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Deadline Telah Berakhir</h3>
                            <p class="mt-1 text-sm text-red-700">Maaf, deadline untuk tugas ini sudah berakhir pada {{ $tugas->deadline->format('d M Y') }}.</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">
                            @if($pengumpulan) Update Pengumpulan Tugas @else Kumpulkan Tugas @endif
                        </h3>

                        <form action="{{ route('tugas.submit', $tugas) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            
                            <!-- File Upload -->
                            <div>
                                <label for="file" class="block text-sm font-medium text-gray-700 mb-2">File Tugas</label>
                                <input type="file" 
                                       id="file" 
                                       name="file" 
                                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                       required
                                       accept=".pdf,.doc,.docx,.zip,.rar">
                                <p class="mt-1 text-sm text-gray-500">Format yang diizinkan: PDF, DOC, DOCX, ZIP, RAR (Max: 10MB)</p>
                                @error('file')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Keterangan -->
                            <div>
                                <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">Keterangan (Opsional)</label>
                                <textarea id="keterangan" 
                                          name="keterangan" 
                                          rows="4" 
                                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                          placeholder="Tambahkan keterangan atau catatan untuk tugas ini...">{{ old('keterangan', $pengumpulan->keterangan ?? '') }}</textarea>
                                @error('keterangan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="flex justify-between items-center">
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    ← Kembali ke Dashboard
                                </a>
                                
                                <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"/>
                                    </svg>
                                    @if($pengumpulan) Update Tugas @else Kumpulkan Tugas @endif
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
