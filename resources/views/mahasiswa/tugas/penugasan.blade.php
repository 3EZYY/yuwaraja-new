
@extends('layouts.app')

@section('content')
    <div class="py-12 min-h-screen bg-[#0a0a13]">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#181825] shadow-xl rounded-2xl mb-8 border border-[#232347]">
                <div class="p-8">
                    @if(isset($listMode) && $listMode && isset($tugas))
                        {{-- LIST PENUGASAN --}}
                        <h1 class="text-3xl font-extrabold text-[#ffe066] mb-6 tracking-tight drop-shadow">DAFTAR MISI (TUGAS)</h1>
                        @if($tugas->isEmpty())
                            <p class="text-[#b2b2d6] text-lg text-center py-8">Belum ada tugas.</p>
                        @else
                            <div class="space-y-6">
                                @foreach($tugas as $item)
                                    <div class="transition-all duration-200 bg-[#10101a] hover:bg-[#181825] border border-[#232347] shadow-lg rounded-xl px-6 py-5 flex flex-col md:flex-row md:items-center md:justify-between group">
                                        <div>
                                            <a href="{{ route('mahasiswa.tugas.show', $item->id) }}" class="text-xl font-bold text-[#00eaff] group-hover:text-[#ffe066] hover:underline transition">
                                                {{ $item->judul }}
                                            </a>
                                            <div class="flex items-center space-x-3 mt-2">
                                                <span class="inline-flex px-3 py-1 text-xs font-bold rounded-full border
                                                    {{ $item->tipe == 'kelompok'
                                                        ? 'bg-[#232347] text-[#00eaff] border-[#00eaff]'
                                                        : 'bg-[#232347] text-[#ffe066] border-[#ffe066]' }}">
                                                    {{ strtoupper($item->tipe) }}
                                                </span>
                                                <span class="text-xs text-[#b2b2d6] font-medium flex items-center">
                                                    <svg class="inline w-4 h-4 mr-1 text-[#00eaff]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                                    <span class="ml-1">Deadline: <span class="text-[#ffe066]">{{ \Carbon\Carbon::parse($item->deadline)->format('d M Y') }}</span></span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mt-4 md:mt-0 flex items-center">
                                            @php $pengumpulan = $pengumpulanTugas[$item->id] ?? null; @endphp
                                            @if($pengumpulan)
                                                <span class="inline-flex px-4 py-1 text-xs font-bold rounded-full border
                                                    @if($pengumpulan->status == 'submitted') bg-[#ffe066]/20 text-[#ffe066] border-[#ffe066]
                                                    @elseif($pengumpulan->status == 'approved') bg-[#00eaff]/20 text-[#00eaff] border-[#00eaff]
                                                    @elseif($pengumpulan->status == 'rejected') bg-[#e74c3c]/20 text-[#e74c3c] border-[#e74c3c]
                                                    @else bg-[#232347] text-[#b2b2d6] border-[#b2b2d6]
                                                    @endif">
                                                    @if($pengumpulan->status == 'submitted') Sudah Dikumpulkan
                                                    @elseif($pengumpulan->status == 'approved') Diterima
                                                    @elseif($pengumpulan->status == 'rejected') Ditolak
                                                    @else Draft
                                                    @endif
                                                </span>
                                            @else
                                                <span class="inline-flex px-4 py-1 text-xs font-bold rounded-full border bg-[#e74c3c]/20 text-[#e74c3c] border-[#e74c3c]">
                                                    Belum Dikumpulkan
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @elseif(isset($detailMode) && $detailMode && isset($tugas))
                        {{-- DETAIL PENUGASAN --}}
                        <h1 class="text-3xl font-bold mb-6 text-cyan-400 tracking-wide">Detail Tugas</h1>
                        <div class="mb-6 space-y-2">
                            <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
                                <span class="font-bold text-cyan-300">Judul:</span>
                                <span class="text-white text-lg">{{ $tugas->judul }}</span>
                            </div>
                            <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
                                <span class="font-bold text-cyan-300">Deskripsi:</span>
                                <span class="bg-gray-900 text-gray-200 rounded px-3 py-2 w-full">{!! nl2br(e($tugas->deskripsi)) !!}</span>
                            </div>
                            <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
                                <span class="font-bold text-cyan-300">Deadline:</span>
                                <span class="text-yellow-300">{{ $tugas->deadline->format('d M Y, H:i') }}</span>
                            </div>
                            @if($tugas->file_path)
                                <div class="flex flex-col md:flex-row md:items-center md:space-x-4">
                                    <span class="font-bold text-cyan-300">File Tugas:</span>
                                    <a href="{{ Storage::url($tugas->file_path) }}" target="_blank" class="text-blue-400 underline hover:text-blue-200 transition">Download</a>
                                </div>
                            @endif
                        </div>
                        <hr class="my-8 border-cyan-800/40">
                        <h2 class="text-2xl font-semibold mb-4 text-cyan-400">Upload Tugas Anda</h2>
                        @if(session('success'))
                            <div class="bg-green-900/80 border border-green-400 text-green-200 px-4 py-3 rounded mb-4">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="bg-red-900/80 border border-red-400 text-red-200 px-4 py-3 rounded mb-4">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if(isset($pengumpulan) && $pengumpulan->file_path)
                            <div class="mb-4">
                                <span class="font-semibold text-cyan-300">File yang sudah dikumpulkan:</span>
                                <a href="{{ Storage::url($pengumpulan->file_path) }}" target="_blank" class="text-blue-400 underline hover:text-blue-200">Download File</a>
                                <p class="text-xs text-gray-400 mt-1">Dikumpulkan pada: {{ $pengumpulan->submitted_at ? $pengumpulan->submitted_at->format('d M Y, H:i') : '-' }}</p>
                            </div>
                        @endif
                        @if(now() <= $tugas->deadline)
                            <form action="{{ route('mahasiswa.tugas.submit', $tugas) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                @csrf
                                <div>
                                    <label for="file" class="block text-sm font-medium text-cyan-200 mb-2">File Tugas <span class="text-red-400">*</span></label>
                                    <input type="file" id="file" name="file" class="block w-full border border-cyan-700 bg-gray-900 text-white rounded px-3 py-2 focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 transition" accept=".pdf,.doc,.docx,.zip,.rar" required>
                                    <p class="mt-1 text-xs text-cyan-400">Format: PDF, DOC, DOCX, ZIP, RAR (Max: 10MB)</p>
                                    @error('file')
                                        <p class="text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="keterangan" class="block text-sm font-medium text-cyan-200 mb-2">Keterangan (Opsional)</label>
                                    <textarea id="keterangan" name="keterangan" rows="3" class="block w-full border border-cyan-700 bg-gray-900 text-white rounded px-3 py-2 focus:ring-2 focus:ring-cyan-400 focus:border-cyan-400 transition" placeholder="Catatan untuk tugas...">{{ old('keterangan', $pengumpulan->keterangan ?? '') }}</textarea>
                                    @error('keterangan')
                                        <p class="text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="px-8 py-3 bg-cyan-500 hover:bg-cyan-400 text-black font-bold rounded shadow transition">Kumpulkan Tugas</button>
                            </form>
                        @else
                            <div class="bg-red-900/80 border border-red-400 rounded p-4 mt-4">
                                <p class="text-red-200 font-semibold">Deadline tugas sudah berakhir. Anda tidak dapat mengumpulkan tugas ini.</p>
                            </div>
                        @endif
                    @elseif(isset($kerjakanMode) && $kerjakanMode && isset($tugas))
                        {{-- KERJAKAN TUGAS --}}
                        <h2 class="mb-4">Kerjakan Tugas: {{ $tugas->judul }}</h2>
                        <div class="mb-3">
                            <strong>Deskripsi:</strong>
                            <div class="bg-light p-2 rounded">{!! nl2br(e($tugas->deskripsi)) !!}</div>
                        </div>
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
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
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
                    @else
                        <div class="text-center text-gray-500">Tidak ada data tugas.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <style>
        body {
            background: #0a0a13;
        }
        .bg-dashboard-card {
            background: #181825;
        }
        .text-dashboard-yellow {
            color: #ffe066;
        }
        .text-dashboard-cyan {
            color: #00eaff;
        }
        .border-dashboard-cyan {
            border-color: #00eaff;
        }
        .border-dashboard-yellow {
            border-color: #ffe066;
        }
        .bg-dashboard-yellow {
            background: #ffe066;
        }
        .bg-dashboard-cyan {
            background: #00eaff;
        }
    </style>
@endsection
