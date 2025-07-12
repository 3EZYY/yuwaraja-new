<x-app-layout>

    <div class="pt-20 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            </div>
        @endif

        <!-- Task Details -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="bg-gradient-to-r from-cyan-500 to-yellow-500 px-6 py-4">
                <h1 class="text-2xl font-bold text-white capitalize">{{ $tugas->judul }}</h1>
                <div class="flex items-center mt-2 text-blue-100">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    <span>Deadline: {{ \Carbon\Carbon::parse($tugas->deadline)->format('d M Y, H:i') }}</span>
                    @if(now() > $tugas->deadline)
                        <span class="ml-4 bg-red-500 text-white px-2 py-1 rounded-full text-xs">
                            <i class="fas fa-exclamation-triangle mr-1"></i>Terlambat
                        </span>
                    @elseif(now()->diffInHours($tugas->deadline) <= 24)
                        <span class="ml-4 bg-yellow-500 text-white px-2 py-1 rounded-full text-xs">
                            <i class="fas fa-clock mr-1"></i>Segera Berakhir
                        </span>
                    @endif
                </div>
            </div>

            <div class="p-6">
                <!-- Task Description -->
                <div class="mb-8">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-info-circle text-blue-600 mr-2"></i>Deskripsi Tugas
                    </h2>
                    <div class="prose max-w-none text-gray-700">
                        {!! nl2br(e($tugas->deskripsi)) !!}
                    </div>
                </div>

                <!-- Submission Status -->
                @if($pengumpulan)
                    <div class="bg-cyan-50 border border-cyan-200 rounded-lg p-6 mb-6">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-check-circle text-yellow-600 text-2xl mr-3"></i>
                            <div>
                                <h3 class="text-lg font-semibold text-green-800">Tugas Sudah Dikumpulkan</h3>
                                <p class="text-green-600">Dikumpulkan pada: {{ \Carbon\Carbon::parse($pengumpulan->tanggal_submit)->format('d M Y, H:i') }}</p>
                                <span class="inline-block mt-2 px-3 py-1 rounded-full text-xs font-semibold
                                    {{
                                        $pengumpulan->status == 'done' ? 'bg-green-600 text-white' :
                                        ($pengumpulan->status == 'approved' ? 'bg-blue-600 text-white' :
                                        ($pengumpulan->status == 'reviewed' ? 'bg-yellow-400 text-black' : 'bg-gray-400 text-white'))
                                    }}">
                                    Status: {{ ucfirst($pengumpulan->status) }}
                                </span>
                                @if($pengumpulan->status == 'done')
                                    <span class="block text-green-700 mt-1">Tugas kamu sudah selesai &amp; dinilai!</span>
                                @elseif($pengumpulan->status == 'approved')
                                    <span class="block text-blue-700 mt-1">Tugas kamu sudah di-approve SPV, menunggu finalisasi.</span>
                                @elseif($pengumpulan->status == 'reviewed')
                                    <span class="block text-yellow-700 mt-1">Tugas kamu sedang diteliti SPV.</span>
                                @endif
                                @if($pengumpulan->nilai !== null)
                                    <span class="block mt-1">Nilai: <b>{{ $pengumpulan->nilai }}</b></span>
                                @endif
                                @if($pengumpulan->keterangan)
                                    <span class="block mt-1">Catatan SPV: <i>{{ $pengumpulan->keterangan }}</i></span>
                                @endif
                            </div>
                        </div>
                        <div class="bg-white border border-green-200 rounded p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fas fa-file-alt text-green-600 mr-2"></i>
                                    <span class="text-gray-700">File yang dikumpulkan:</span>
                                </div>
                                <a href="{{ Storage::url($pengumpulan->file_path) }}"
                                   target="_blank"
                                   class="text-blue-600 hover:text-blue-800 underline">
                                    <i class="fas fa-download mr-1"></i>Download
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Submission Form -->
                    @if(now() <= $tugas->deadline)
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-blue-800 mb-4">
                                <i class="fas fa-upload text-blue-600 mr-2"></i>Upload Tugas
                            </h3>

                            <form action="{{ route('mahasiswa.tugas.submit', $tugas) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                @csrf

                                <div>
                                    <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                                        File Tugas <span class="text-red-500">*</span>
                                    </label>
                                    <input type="file"
                                           id="file"
                                           name="file"
                                           accept=".pdf,.doc,.docx"
                                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-lg cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <p class="mt-2 text-sm text-gray-500">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Format yang diterima: PDF, DOC, DOCX (Maksimal 5MB)
                                    </p>
                                    @error('file')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="pt-4">
                                    <button type="submit"
                                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                        <i class="fas fa-upload mr-2"></i>
                                        Kumpulkan Tugas
                                    </button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="bg-red-50 border border-red-200 rounded-lg p-6">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-triangle text-red-600 text-2xl mr-3"></i>
                                <div>
                                    <h3 class="text-lg font-semibold text-red-800">Waktu Pengumpulan Berakhir</h3>
                                    <p class="text-red-600">Deadline tugas sudah terlewati. Anda tidak dapat lagi mengumpulkan tugas ini.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Auto hide flash messages after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.bg-green-100, .bg-red-100');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s ease-out';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);

        // File upload validation
        document.getElementById('file').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const fileSize = file.size / 1024 / 1024; // Convert to MB
                const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];

                if (fileSize > 5) {
                    alert('File terlalu besar! Maksimal 5MB.');
                    e.target.value = '';
                    return;
                }

                if (!allowedTypes.includes(file.type)) {
                    alert('Format file tidak valid! Hanya PDF, DOC, dan DOCX yang diperbolehkan.');
                    e.target.value = '';
                    return;
                }
            }
        });
    </script>
    @endpush
</x-mahasiswa-layout>
