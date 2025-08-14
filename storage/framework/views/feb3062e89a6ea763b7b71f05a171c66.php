<?php $__env->startSection('content'); ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&family=Poppins:wght@600;700;900&display=swap');

    :root {
        --bg-main: #0a0a0a;
        --surface-card: #111827;
        --border-color: rgba(20, 184, 166, 0.25);
        --brand-teal: #14b8a6;
        --brand-gold: #f59e0b;
        --text-primary: #d1d5db;
        --text-secondary: #6b7280;
    }

    body {
        background-color: var(--bg-main) !important;
        font-family: 'Kanit', sans-serif;
        color: var(--text-primary);
    }

    .font-display {
        font-family: 'Poppins', sans-serif;
    }

    .font-body {
        font-family: 'Kanit', sans-serif;
    }

    .text-glow-teal {
        text-shadow: 0 0 12px rgba(20, 184, 166, 0.5);
    }

    .text-glow-amber {
        text-shadow: 0 0 12px rgba(245, 158, 11, 0.5);
    }

    .themed-card {
        background-color: var(--surface-card);
        border: 1px solid var(--border-color);
        border-radius: 0.75rem;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .themed-card:hover {
        border-color: var(--brand-gold);
        box-shadow: 0 0 20px rgba(245, 158, 11, 0.15);
    }

    .gradient-border {
        border: 1px solid transparent;
        background: linear-gradient(to right, var(--surface-card), var(--surface-card)) padding-box,
            linear-gradient(135deg, var(--brand-teal), var(--brand-gold)) border-box;
    }
</style>

<div class="font-body min-h-screen py-12 sm:py-16" style="background-color: var(--bg-main);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <header class="text-center mb-12">
            <h1 class="font-display text-4xl sm:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-b from-teal-400 to-amber-400 mb-2 text-glow-teal">
                MISSION CONTROL
            </h1>
            <p class="text-gray-300 text-base sm:text-lg">Akses & kumpulkan semua misi yang ditugaskan.</p>
        </header>

        <!-- Kontainer Utama -->
        <main class="themed-card backdrop-blur-xl shadow-2xl">
            <div class="p-6 sm:p-8 md:p-10">

                <?php if(isset($listMode) && $listMode && isset($tugas)): ?>
                
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8">
                    <h2 class="font-display text-2xl sm:text-3xl font-bold text-gray-50 flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Misi Aktif
                    </h2>
                    <p class="text-teal-200/70 text-sm mt-2 sm:mt-0">Ditemukan: <span class="font-bold text-amber-300"><?php echo e($tugas->count()); ?></span> misi</p>
                </div>

                <?php if($tugas->isEmpty()): ?>
                <div class="text-center py-16">
                    <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gray-900 flex items-center justify-center border-2 border-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </div>
                    <p class="font-display text-xl text-gray-400">Tidak Ada Misi Aktif</p>
                    <p class="text-gray-500 text-sm mt-2">Semua misi telah selesai atau belum ada yang ditugaskan.</p>
                </div>
                <?php else: ?>
                <div class="grid gap-6 md:grid-cols-1 lg:grid-cols-2">
                    <?php $__currentLoopData = $tugas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('mahasiswa.tugas.show', $item->id)); ?>" class="group block">
                        <div class="bg-gray-900/80 h-full p-6 rounded-xl border border-teal-500/50 hover:border-gray-700/50 hover:bg-gray-900 transition-all duration-300 shadow-lg hover:shadow-teal-500/10">
                            <div class="flex flex-col h-full">
                                <div class="flex-grow">
                                    <div class="flex items-start justify-between mb-3">
                                        <h3 class="font-display text-xl font-bold text-gray-50 group-hover:text-teal-500 transition-colors duration-300"><?php echo e($item->judul); ?></h3>
                                        <?php
                                        $pengumpulan = $pengumpulanTugas[$item->id] ?? null;
                                        $isExpired = now() > $item->deadline;
                                        ?>
                                        <?php if($pengumpulan): ?>
                                        <?php if($pengumpulan->status == 'done'): ?>
                                        <span class="text-xs font-bold py-1 px-3 rounded-full bg-purple-500/10 text-purple-400 border border-purple-500/20">SELESAI</span>
                                        <?php elseif($pengumpulan->status == 'approved'): ?>
                                        <span class="text-xs font-bold py-1 px-3 rounded-full bg-green-500/10 text-green-400 border border-green-500/20">DISETUJUI</span>
                                        <?php elseif($pengumpulan->status == 'rejected'): ?>
                                        <span class="text-xs font-bold py-1 px-3 rounded-full bg-red-500/10 text-red-400 border border-red-500/20">PERLU PERBAIKAN</span>
                                        <?php elseif($pengumpulan->status == 'reviewed'): ?>
                                        <span class="text-xs font-bold py-1 px-3 rounded-full bg-blue-500/10 text-blue-400 border border-blue-500/20">DIREVIEW</span>
                                        <?php else: ?>
                                        <span class="text-xs font-bold py-1 px-3 rounded-full bg-yellow-500/10 text-yellow-400 border border-yellow-500/20">DIKUMPULKAN</span>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <?php if($isExpired): ?>
                                        <span class="text-xs font-bold py-1 px-3 rounded-full bg-red-500/10 text-red-400 border border-red-500/20">TERLEWAT</span>
                                        <?php else: ?>
                                        <span class="text-xs font-bold py-1 px-3 rounded-full bg-gray-500/10 text-gray-400 border border-gray-500/20">BELUM DIKERJAKAN</span>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex items-center space-x-4 mb-5 text-sm">
                                        <div class="flex items-center gap-2 text-gray-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span>Deadline: <span class="font-semibold text-amber-300"><?php echo e(\Carbon\Carbon::parse($item->deadline)->format('d M Y')); ?></span></span>
                                        </div>
                                        <div class="flex items-center gap-2 text-gray-400">
                                            <?php if($item->tipe == 'kelompok'): ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <?php else: ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            <?php endif; ?>
                                            <span class="capitalize"><?php echo e($item->tipe); ?></span>
                                        </div>
                                        <?php if($item->file_path): ?>
                                        <div class="flex items-center gap-2 text-cyan-400">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <span>Ada File</span>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="mt-auto text-right text-white/70 text-sm font-semibold group-hover:text-amber-300 transition-colors">
                                    Buka Misi →
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php endif; ?>

                <?php elseif(isset($detailMode) && $detailMode && isset($tugas)): ?>
                
                <div class="mb-8">
                    <a href="<?php echo e(route('mahasiswa.tugas.index')); ?>" class="inline-flex items-center gap-2 text-white hover:text-amber-300 transition-colors mb-6 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                        </svg>
                        Kembali ke Daftar Misi
                    </a>
                    <h1 class="font-display text-3xl md:text-4xl font-bold text-teal-200 text-glow-teal"><?php echo e($tugas->judul); ?></h1>
                    <div class="flex items-center gap-2 text-sm text-amber-300 mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.414-1.415L11 9.586V6z" clip-rule="evenodd" />
                        </svg>
                        <span>Deadline: <?php echo e($tugas->deadline->format('d F Y, H:i')); ?> WIB</span>
                    </div>
                </div>

                
                <div class="lg:col-span-3 space-y-6">
                    <div class="mb-5">
                        <h3 class="font-display text-lg font-bold text-gray-50 mb-3 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                            </svg>
                            Deskripsi Misi
                        </h3>
                        <div class="prose prose-invert prose-sm max-w-none text-gray-300 bg-gray-950/70 p-4 rounded-lg border border-gray-800 normal-case"><?php echo nl2br(e($tugas->deskripsi)); ?></div>
                    </div>
                    <?php if($tugas->file_path): ?>
                    <div>
                        <h3 class="font-display text-lg font-bold text-gray-50 mb-3 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625ZM7.5 15a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 7.5 15Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H8.25Z" clip-rule="evenodd" />
                                <path d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
                            </svg>
                            Lampiran
                        </h3>
                        <a href="<?php echo e(route('mahasiswa.tugas.download', $tugas)); ?>" class="mb-5 inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold bg-gray-700 hover:bg-gray-600 text-teal-200 rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Download File Tugas
                        </a>
                    </div>
                    <?php endif; ?>
                </div>

                
                <div class="lg:col-span-2 themed-card p-6">
                    <h2 class="font-display text-xl font-bold mb-5 text-white flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd" d="M10.5 3.75a6 6 0 0 0-5.98 6.496A5.25 5.25 0 0 0 6.75 20.25H18a4.5 4.5 0 0 0 2.206-8.423 3.75 3.75 0 0 0-4.133-4.303A6.001 6.001 0 0 0 10.5 3.75Zm2.25 6a.75.75 0 0 0-1.5 0v4.94l-1.72-1.72a.75.75 0 0 0-1.06 1.06l3 3a.75.75 0 0 0 1.06 0l3-3a.75.75 0 1 0-1.06-1.06l-1.72 1.72V9.75Z" clip-rule="evenodd" />
                        </svg>
                        Status & Pengumpulan
                    </h2>
                    <?php if(session('success')): ?> <div class="bg-green-500/10 border border-green-500/30 text-green-300 text-sm p-3 rounded-lg mb-4 flex items-center gap-3"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg><span><?php echo e(session('success')); ?></span></div> <?php endif; ?>
                    <?php if(session('error')): ?> <div class="bg-red-500/10 border border-red-500/30 text-red-300 text-sm p-3 rounded-lg mb-4 flex items-center gap-3"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg><span><?php echo e(session('error')); ?></span></div> <?php endif; ?>

                    <?php if(isset($pengumpulan) && $pengumpulan->file_path): ?>
                    <div class="bg-gray-800/80 p-4 rounded-lg border border-teal-500/20 mb-4">
                        <p class="text-sm font-semibold text-teal-400 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            File Terkumpul
                        </p>
                        <a href="<?php echo e(route('mahasiswa.pengumpulan.download', $pengumpulan)); ?>" class="text-amber-400 hover:text-amber-300 hover:underline text-sm truncate block mt-1 ml-7"><?php echo e(basename($pengumpulan->file_path)); ?></a>

                        <!-- Status pengumpulan -->
                        <div class="mt-3 pt-3 border-t border-gray-600/50">
                            <p class="text-sm text-gray-300">Status:
                                <?php if($pengumpulan->status == 'reviewed'): ?>
                                <span class="text-blue-400 font-semibold">Sedang Direview SPV</span>
                                <?php elseif($pengumpulan->status == 'rejected'): ?>
                                <span class="text-red-400 font-semibold">Butuh Perbaikan</span>
                                <?php elseif($pengumpulan->status == 'done'): ?>
                                <span class="text-purple-400 font-semibold">Tugas Selesai</span>
                                <?php elseif($pengumpulan->status == 'submitted'): ?>
                                <span class="text-yellow-400 font-semibold">Menunggu Review</span>
                                <?php else: ?>
                                <span class="text-gray-400 font-semibold"><?php echo e(ucfirst($pengumpulan->status)); ?></span>
                                <?php endif; ?>
                            </p>
                            <?php if($pengumpulan->feedback): ?>
                            <p class="text-sm text-gray-400 mt-1">Feedback SPV: <em><?php echo e($pengumpulan->feedback); ?></em></p>
                            <?php endif; ?>
                            <?php if($pengumpulan->status == 'done' && $pengumpulan->nilai !== null): ?>
                            <p class="text-sm text-cyan-400 mt-1">Nilai: <strong><?php echo e($pengumpulan->nilai); ?></strong></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if(now() <= $tugas->deadline && (!isset($pengumpulan) || $pengumpulan->status !== 'done')): ?>
                        <form action="<?php echo e(route('mahasiswa.tugas.submit', $tugas)); ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
                            <?php echo csrf_field(); ?>
                            <div>
                                <label for="file" class="block text-sm font-semibold text-gray-300 mb-1">Upload File <span class="text-red-400">*</span></label>
                                <input type="file" id="file" name="file" class="block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-teal-500/10 file:text-white hover:file:bg-teal-500/20 transition-colors cursor-pointer" accept=".pdf,.doc,.docx,.zip,.rar" required>
                                <p class="mt-1 text-xs text-gray-500">Maks: 10MB (PDF, DOC, ZIP, RAR)</p>
                                <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-sm text-red-400 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div>
                                <label for="keterangan" class="block text-sm font-semibold text-gray-300 mb-1">Keterangan (Opsional)</label>
                                <textarea id="keterangan" name="keterangan" rows="3" class="block w-full border border-gray-700 bg-gray-800 text-white rounded-lg p-2 focus:ring-1 focus:ring-teal-400 focus:border-teal-400 transition" placeholder="Tinggalkan catatan jika perlu..."><?php echo e(old('keterangan', $pengumpulan->keterangan ?? '')); ?></textarea>
                                <?php $__errorArgs = ['keterangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-sm text-red-400 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <button type="submit" class="w-full px-6 py-3 bg-teal-500 hover:bg-teal-600 text-black font-bold rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-teal-500/20 font-display focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-teal-400">
                                <?php if(isset($pengumpulan) && $pengumpulan->status == 'rejected'): ?>
                                Kumpulkan Ulang (Perbaikan)
                                <?php elseif(isset($pengumpulan) && $pengumpulan->file_path): ?>
                                Kirim Versi Baru
                                <?php else: ?>
                                Kirim Misi
                                <?php endif; ?>
                            </button>
                        </form>
                        <?php elseif(isset($pengumpulan) && $pengumpulan->status == 'done'): ?>
                        <div class="bg-green-900/30 border border-green-500/30 rounded-lg p-6 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-green-400 mb-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <p class="text-green-300 font-semibold font-display">Tugas Selesai – Pengumpulan Ditutup</p>
                            <p class="text-green-300/80 text-sm">Tugas telah selesai dan dinilai oleh SPV.</p>
                        </div>
                        <?php else: ?>
                        <div class="bg-red-900/30 border border-red-500/30 rounded-lg p-6 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-red-400 mb-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 616 0z" clip-rule="evenodd" />
                            </svg>
                            <p class="text-red-300 font-semibold font-display">Waktu Habis</p>
                            <p class="text-red-300/80 text-sm">Deadline telah berakhir. Pengumpulan ditutup.</p>
                        </div>
                        <?php endif; ?>
                </div>
                <?php else: ?>
                <div class="text-center text-gray-500 py-10">
                    <p>Mode tidak valid atau tidak ada data yang dapat ditampilkan.</p>
                </div>
                <?php endif; ?>
            </div>
        </main>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\yuwaraja-new\resources\views/mahasiswa/tugas/penugasan.blade.php ENDPATH**/ ?>