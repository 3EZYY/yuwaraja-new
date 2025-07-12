<x-spv-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Review Tugas Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-6">Pengumpulan Tugas</h3>

                    @forelse($pengumpulanTugas as $pengumpulan)
                        <div class="border border-gray-200 rounded-lg p-6 mb-4">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-4 mb-3">
                                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                            <span class="text-white font-medium">{{ substr($pengumpulan->user->name, 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900">{{ $pengumpulan->user->name }}</h4>
                                            <p class="text-sm text-gray-600">{{ $pengumpulan->user->kelompok->nama_kelompok ?? 'Kelompok tidak ditemukan' }}</p>
                                        </div>
                                    </div>

                                    <div class="ml-14">
                                        <h5 class="font-medium text-gray-900">{{ $pengumpulan->tugas->judul }}</h5>
                                        <p class="text-sm text-gray-600 mt-1">
                                            <b>Dikumpulkan:</b>
                                            @if($pengumpulan->tanggal_submit)
                                                {{ $pengumpulan->tanggal_submit->format('d M Y, H:i') }}
                                            @else
                                                -
                                            @endif
                                        </p>
                                        <p class="text-sm text-gray-600 mt-1">
                                            <b>Status:</b> <span class="font-semibold">{{ ucfirst($pengumpulan->status) }}</span>
                                            @if($pengumpulan->nilai !== null)
                                                | <b>Nilai:</b> <span class="font-semibold">{{ $pengumpulan->nilai }}</span>
                                            @endif
                                            @if($pengumpulan->keterangan)
                                                | <b>Keterangan:</b> <span class="font-semibold">{{ $pengumpulan->keterangan }}</span>
                                            @endif
                                        </p>
                                        {{-- File download di detail kiri dihilangkan --}}
                                    </div>
                                </div>

                                <div class="flex items-center space-x-3">
                                    @if($pengumpulan->file_path)
                                        <a href="{{ asset('storage/' . $pengumpulan->file_path) }}" target="_blank" class="inline-flex items-center px-3 py-1 bg-blue-500 text-white text-xs font-semibold rounded hover:bg-blue-600 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" /></svg>
                                            Download
                                        </a>
                                    @endif
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{
                                        $pengumpulan->tanggal_submit <= $pengumpulan->tugas->deadline
                                            ? 'bg-green-100 text-green-800'
                                            : 'bg-red-100 text-red-800'
                                    }}">
                                        {{ $pengumpulan->tanggal_submit <= $pengumpulan->tugas->deadline ? 'Tepat Waktu' : 'Terlambat' }}
                                    </span>
                                </div>
                            </div>
                            <form action="{{ route('spv.tugas-mahasiswa.approve', $pengumpulan->id) }}" method="POST" class="mt-4 flex flex-wrap gap-4 items-end">
                                @csrf
                                <div>
                                    <label for="nilai-{{ $pengumpulan->id }}" class="block text-xs font-bold mb-1">Nilai</label>
                                    <input type="number" name="nilai" id="nilai-{{ $pengumpulan->id }}" class="form-input w-24" value="{{ old('nilai', $pengumpulan->nilai) }}" min="0" max="100" required>
                                </div>
                                <div>
                                    <label for="keterangan-{{ $pengumpulan->id }}" class="block text-xs font-bold mb-1">Keterangan</label>
                                    <input type="text" name="keterangan" id="keterangan-{{ $pengumpulan->id }}" class="form-input w-48" value="{{ old('keterangan', $pengumpulan->keterangan) }}">
                                </div>
                                <div>
                                    <label for="status-{{ $pengumpulan->id }}" class="block text-xs font-bold mb-1">Status</label>
                                    <select name="status" id="status-{{ $pengumpulan->id }}" class="form-select">
                                        <option value="reviewed" {{ $pengumpulan->status == 'reviewed' ? 'selected' : '' }}>Perlu Diteliti</option>
                                        <option value="approved" {{ $pengumpulan->status == 'approved' ? 'selected' : '' }}>Approve</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </form>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-file-alt text-gray-400 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Pengumpulan</h3>
                            <p class="text-gray-600">Mahasiswa yang Anda bimbing belum ada yang mengumpulkan tugas.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-spv-layout>
