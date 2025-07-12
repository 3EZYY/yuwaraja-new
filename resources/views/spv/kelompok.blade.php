<x-spv-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelompok yang Dibimbing') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-6">Daftar Kelompok</h3>
                    
                    @forelse($kelompokDibimbing as $kelompok)
                        <div class="border border-gray-200 rounded-lg p-6 mb-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h4 class="text-xl font-semibold text-gray-900">{{ $kelompok->nama_kelompok }}</h4>
                                    <p class="text-gray-600">{{ $kelompok->mahasiswa->count() }} mahasiswa</p>
                                </div>
                                <span class="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded">
                                    Aktif
                                </span>
                            </div>

                            <!-- Daftar Mahasiswa -->
                            <div class="mt-4">
                                <h5 class="font-medium text-gray-900 mb-3">Anggota Kelompok:</h5>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach($kelompok->mahasiswa as $mahasiswa)
                                        <div class="bg-gray-50 p-4 rounded-lg">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                                    <span class="text-white font-medium">{{ substr($mahasiswa->name, 0, 1) }}</span>
                                                </div>
                                                <div>
                                                    <p class="font-medium text-gray-900">{{ $mahasiswa->name }}</p>
                                                    <p class="text-sm text-gray-600">{{ $mahasiswa->nim ?? 'NIM belum diisi' }}</p>
                                                    <p class="text-sm text-gray-600">{{ $mahasiswa->program_studi ?? 'Prodi belum diisi' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-users text-gray-400 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Kelompok</h3>
                            <p class="text-gray-600">Anda belum diberi tanggung jawab untuk membimbing kelompok manapun.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-spv-layout>
