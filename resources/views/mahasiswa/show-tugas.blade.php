@extends('layouts.app')

@section('content')
<style>
    :root {
        --cyber-primary: #00ffff;
        --cyber-secondary: #0080ff;
        --cyber-accent: #ff0080;
        --cyber-bg-dark: #0a0a0f;
        --cyber-bg-card: #1a1a2e;
        --cyber-text-glow: 0 0 10px var(--cyber-primary);
        --cyber-border: 1px solid rgba(0, 255, 255, 0.3);
    }
    
    .cyber-card {
        background: linear-gradient(135deg, var(--cyber-bg-card) 0%, rgba(26, 26, 46, 0.8) 100%);
        border: var(--cyber-border);
        border-radius: 12px;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }
    
    .cyber-card:hover {
        border-color: var(--cyber-primary);
        box-shadow: 0 0 20px rgba(0, 255, 255, 0.2);
    }
    
    .text-glow-cyan {
        color: var(--cyber-primary);
        text-shadow: var(--cyber-text-glow);
    }
    
    .cyber-input {
        background: rgba(26, 26, 46, 0.8);
        border: 1px solid rgba(0, 255, 255, 0.3);
        color: #e2e8f0;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .cyber-input:focus {
        border-color: var(--cyber-primary);
        box-shadow: 0 0 10px rgba(0, 255, 255, 0.3);
        outline: none;
    }
    
    .cyber-btn {
        background: linear-gradient(135deg, var(--cyber-primary) 0%, var(--cyber-secondary) 100%);
        border: none;
        color: #0a0a0f;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
        text-shadow: none;
    }
    
    .cyber-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 255, 255, 0.3);
    }
    
    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
</style>

<div class="py-12 min-h-screen bg-gradient-to-br from-gray-900 via-black to-blue-900/30 relative overflow-hidden">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Flash Messages -->
        @if(session('success'))
            <div class="cyber-card bg-green-900/50 border-green-400 text-green-300 px-6 py-4 mb-6">
                <i class="fas fa-check-circle mr-2 text-glow-cyan"></i>{{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="cyber-card bg-red-900/50 border-red-400 text-red-300 px-6 py-4 mb-6">
                <i class="fas fa-exclamation-circle mr-2 text-red-400"></i>{{ session('error') }}
            </div>
        @endif

        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-glow-cyan mb-2">📋 MISSION CONTROL</h1>
            <p class="text-gray-400 text-lg">// Access your assigned tasks and submit your work</p>
        </div>

        <!-- Task Details -->
        <div class="cyber-card overflow-hidden">
            <div class="bg-gradient-to-r from-cyan-500/20 to-blue-500/20 px-6 py-6 border-b border-cyan-500/30">
                <h2 class="text-2xl font-bold text-glow-cyan capitalize mb-3">{{ $tugas->judul }}</h2>
                <div class="flex items-center text-gray-300">
                    <i class="fas fa-calendar-alt mr-2 text-cyan-400"></i>
                    <span>Deadline: {{ \Carbon\Carbon::parse($tugas->deadline)->format('d M Y, H:i') }}</span>
                    @if(now() > $tugas->deadline)
                        <span class="ml-4 status-badge bg-red-500 text-white">
                            <i class="fas fa-exclamation-triangle mr-1"></i>Terlambat
                        </span>
                    @elseif(now()->diffInHours($tugas->deadline) <= 24)
                        <span class="ml-4 status-badge bg-yellow-500 text-black">
                            <i class="fas fa-clock mr-1"></i>Segera Berakhir
                        </span>
                    @endif
                </div>
            </div>

            <div class="p-6">
                <!-- Task Description -->
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-glow-cyan mb-4">
                        <i class="fas fa-info-circle mr-2"></i>Detail Tugas
                    </h3>
                    <div class="bg-gray-900/50 rounded-lg p-4 border border-cyan-500/30">
                        <div class="text-gray-300 leading-relaxed">
                            {!! nl2br(e($tugas->deskripsi)) !!}
                        </div>
                    </div>
                </div>

                <!-- Task File Download -->
                @if($tugas->file_path)
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold text-glow-cyan mb-4">
                            <i class="fas fa-file-download mr-2"></i>File Tugas
                        </h3>
                        <div class="bg-gray-900/50 rounded-lg p-4 border border-cyan-500/30">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fas fa-file-alt text-cyan-400 mr-3 text-xl"></i>
                                    <div>
                                        <p class="text-gray-300 font-medium">File tugas tersedia untuk diunduh</p>
                                        <p class="text-gray-400 text-sm">Unduh file ini untuk melihat detail lengkap tugas</p>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $tugas->file_path) }}" 
                                   target="_blank"
                                   class="cyber-btn px-6 py-3">
                                    <i class="fas fa-download mr-2"></i>Download File
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Submission Status -->
                @if($pengumpulan)
                    <div class="cyber-card p-6 mb-6">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-check-circle text-glow-cyan text-2xl mr-3"></i>
                            <div>
                                <h3 class="text-xl font-semibold text-glow-cyan">✅ Upload Tugas Anda</h3>
                                <p class="text-gray-300">Dikumpulkan pada: {{ \Carbon\Carbon::parse($pengumpulan->tanggal_submit)->format('d M Y, H:i') }}</p>
                                <span class="inline-block mt-2 status-badge
                                    {{
                                        $pengumpulan->status == 'done' ? 'bg-green-500 text-white' :
                                        ($pengumpulan->status == 'approved' ? 'bg-blue-500 text-white' :
                                        ($pengumpulan->status == 'reviewed' ? 'bg-yellow-400 text-black' : 'bg-gray-500 text-white'))
                                    }}">
                                    Status: {{ ucfirst($pengumpulan->status) }}
                                </span>
                                @if($pengumpulan->status == 'done')
                                    <span class="block text-green-400 mt-2">✨ Tugas kamu sudah selesai & dinilai!</span>
                                @elseif($pengumpulan->status == 'approved')
                                    <span class="block text-blue-400 mt-2">🔄 Tugas kamu sudah di-approve SPV, menunggu finalisasi.</span>
                                @elseif($pengumpulan->status == 'reviewed')
                                    <span class="block text-yellow-400 mt-2">🔍 Tugas kamu sedang diteliti SPV.</span>
                                @endif
                                @if($pengumpulan->nilai !== null)
                                    <span class="block mt-2 text-cyan-400">📊 Nilai: <b class="text-glow-cyan">{{ $pengumpulan->nilai }}</b></span>
                                @endif
                                @if($pengumpulan->keterangan)
                                    <span class="block mt-2 text-gray-300">💬 Catatan SPV: <i>{{ $pengumpulan->keterangan }}</i></span>
                                @endif
                            </div>
                        </div>
                        <div class="bg-gray-900/50 border border-cyan-500/30 rounded-lg p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fas fa-file-alt text-cyan-400 mr-2"></i>
                                    <span class="text-gray-300">File yang dikumpulkan:</span>
                                </div>
                                <a href="{{ Storage::url($pengumpulan->file_path) }}"
                                   target="_blank"
                                   class="cyber-btn px-4 py-2 text-sm">
                                    <i class="fas fa-download mr-1"></i>Download
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Submission Form -->
                    @if(now() <= $tugas->deadline)
                        <div class="cyber-card p-6">
                            <h3 class="text-xl font-semibold text-glow-cyan mb-6">
                                <i class="fas fa-upload mr-2"></i>Upload Tugas Anda
                            </h3>

                            <form action="{{ route('mahasiswa.tugas.submit', $tugas) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                @csrf

                                <div>
                                    <label for="file" class="block text-sm font-medium text-cyan-400 mb-3">
                                        📁 File Tugas <span class="text-red-400">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="file"
                                               id="file"
                                               name="file"
                                               accept=".pdf,.doc,.docx,.zip,.rar"
                                               class="cyber-input w-full py-4 px-4 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-cyan-500 file:text-black hover:file:bg-cyan-400 cursor-pointer">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                            <i class="fas fa-cloud-upload-alt text-cyan-400"></i>
                                        </div>
                                    </div>
                                    <p class="mt-3 text-sm text-gray-400">
                                        <i class="fas fa-info-circle mr-1 text-cyan-400"></i>
                                        Format: PDF, DOC, DOCX, ZIP, RAR (Maks 10MB)
                                    </p>
                                    @error('file')
                                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="keterangan" class="block text-sm font-medium text-cyan-400 mb-3">
                                        💬 Keterangan (Opsional)
                                    </label>
                                    <textarea id="keterangan"
                                              name="keterangan"
                                              rows="4"
                                              placeholder="Catatan untuk tugas..."
                                              class="cyber-input w-full px-4 py-3 placeholder-gray-500 resize-none">{{ old('keterangan') }}</textarea>
                                    <p class="mt-3 text-sm text-gray-400">
                                        <i class="fas fa-info-circle mr-1 text-cyan-400"></i>
                                        Maksimal 2000 karakter
                                    </p>
                                    @error('keterangan')
                                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="pt-4">
                                    <button type="submit"
                                            class="cyber-btn w-full py-4 px-6 text-lg font-bold">
                                        <i class="fas fa-rocket mr-2"></i>
                                        Kumpulkan Tugas
                                    </button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="cyber-card bg-red-900/30 border-red-500/50 p-6">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-triangle text-red-400 text-2xl mr-3"></i>
                                <div>
                                    <h3 class="text-xl font-semibold text-red-400">⏰ Waktu Pengumpulan Berakhir</h3>
                                    <p class="text-gray-300 mt-2">Deadline tugas sudah terlewati. Anda tidak dapat lagi mengumpulkan tugas ini.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
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

        // File upload validation with modern styling
        const fileInput = document.getElementById('file');
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const fileSize = file.size / 1024 / 1024; // Convert to MB
                    const allowedTypes = [
                        'application/pdf', 
                        'application/msword', 
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/zip',
                        'application/x-rar-compressed'
                    ];

                    if (fileSize > 10) {
                        showNotification('⚠️ File terlalu besar! Maksimal 10MB.', 'error');
                        e.target.value = '';
                        return;
                    }

                    if (!allowedTypes.includes(file.type)) {
                        showNotification('❌ Format file tidak valid! Hanya PDF, DOC, DOCX, ZIP, dan RAR yang diperbolehkan.', 'error');
                        e.target.value = '';
                        return;
                    }

                    showNotification('✅ File berhasil dipilih: ' + file.name, 'success');
                }
            });
        }

        // Modern notification system
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full`;
            
            if (type === 'success') {
                notification.className += ' bg-green-900/90 border border-green-400 text-green-300';
            } else {
                notification.className += ' bg-red-900/90 border border-red-400 text-red-300';
            }
            
            notification.textContent = message;
            document.body.appendChild(notification);
            
            // Animate in
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);
            
            // Animate out and remove
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }

        // Keterangan character count validation
        const keteranganTextarea = document.getElementById('keterangan');
        if (keteranganTextarea) {
            keteranganTextarea.addEventListener('input', function(e) {
                const maxLength = 2000;
                const currentLength = e.target.value.length;
                
                if (currentLength > maxLength) {
                    e.target.value = e.target.value.substring(0, maxLength);
                }
            });
        }
    </script>
    @endpush
@endsection
