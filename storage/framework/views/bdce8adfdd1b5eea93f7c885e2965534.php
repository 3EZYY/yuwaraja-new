<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-900 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="bg-gray-800 rounded-xl shadow-lg border border-gray-700 p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div class="mb-4 sm:mb-0">
                        <div class="flex items-center mb-2">
                            <div class="bg-gradient-to-r from-teal-500 to-teal-600 rounded-lg p-2 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-white size-6">
                                    <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z" clip-rule="evenodd" />
                                </svg>


                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-white">Sistem Absensi</h1>
                                <p class="text-sm text-gray-300">Kelola kehadiran dan riwayat absensi</p>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-3 gap-4">
                        <?php
                        $pendingCount = $riwayatAbsensi->where('status', 'pending')->count();
                        $approvedCount = $riwayatAbsensi->where('status', 'approved')->count();
                        $rejectedCount = $riwayatAbsensi->where('status', 'rejected')->count();
                        ?>
                        <div class="bg-gradient-to-r from-amber-500 to-amber-600 rounded-lg p-4 text-center shadow-lg">
                            <div class="text-2xl font-bold text-white"><?php echo e($pendingCount); ?></div>
                            <div class="text-xs text-white font-medium">Pending</div>
                        </div>
                        <div class="bg-gradient-to-r from-teal-500 to-teal-600 rounded-lg p-4 text-center shadow-lg">
                            <div class="text-2xl font-bold text-white"><?php echo e($approvedCount); ?></div>
                            <div class="text-xs text-white font-medium">Disetujui</div>
                        </div>
                        <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-lg p-4 text-center shadow-lg">
                            <div class="text-2xl font-bold text-white"><?php echo e($rejectedCount); ?></div>
                            <div class="text-xs text-white font-medium">Ditolak</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        <?php if(session('success')): ?>
        <div class="bg-green-800 border border-green-600 text-green-100 px-4 py-3 rounded-lg mb-6 shadow-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium"><?php echo e(session('success')); ?></span>
            </div>
        </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <div class="bg-red-800 border border-red-600 text-red-100 px-4 py-3 rounded-lg mb-6 shadow-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium"><?php echo e(session('error')); ?></span>
            </div>
        </div>
        <?php endif; ?>

        <!-- Absensi Tersedia -->
        <div class="bg-gray-800 rounded-xl shadow-lg border border-gray-700 p-6 mb-6">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="text-white bg-gradient-to-r from-teal-500 to-teal-600 rounded-lg p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd" d="M12 3.75a6.715 6.715 0 0 0-3.722 1.118.75.75 0 1 1-.828-1.25 8.25 8.25 0 0 1 12.8 6.883c0 3.014-.574 5.897-1.62 8.543a.75.75 0 0 1-1.395-.551A21.69 21.69 0 0 0 18.75 10.5 6.75 6.75 0 0 0 12 3.75ZM6.157 5.739a.75.75 0 0 1 .21 1.04A6.715 6.715 0 0 0 5.25 10.5c0 1.613-.463 3.12-1.265 4.393a.75.75 0 0 1-1.27-.8A6.715 6.715 0 0 0 3.75 10.5c0-1.68.503-3.246 1.367-4.55a.75.75 0 0 1 1.04-.211ZM12 7.5a3 3 0 0 0-3 3c0 3.1-1.176 5.927-3.105 8.056a.75.75 0 1 1-1.112-1.008A10.459 10.459 0 0 0 7.5 10.5a4.5 4.5 0 1 1 9 0c0 .547-.022 1.09-.067 1.626a.75.75 0 0 1-1.495-.123c.041-.495.062-.996.062-1.503a3 3 0 0 0-3-3Zm0 2.25a.75.75 0 0 1 .75.75c0 3.908-1.424 7.485-3.781 10.238a.75.75 0 0 1-1.14-.975A14.19 14.19 0 0 0 11.25 10.5a.75.75 0 0 1 .75-.75Zm3.239 5.183a.75.75 0 0 1 .515.927 19.417 19.417 0 0 1-2.585 5.544.75.75 0 0 1-1.243-.84 17.915 17.915 0 0 0 2.386-5.116.75.75 0 0 1 .927-.515Z" clip-rule="evenodd" />
                        </svg>

                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">Absensi Tersedia</h2>
                        <p class="text-gray-400 text-sm">Daftar sesi absensi yang dapat diikuti</p>
                    </div>
                </div>
                <div class="text-sm text-gray-400">
                    Total: <?php echo e($absensiAktif->count()); ?> Absensi
                </div>
            </div>

            <?php if($absensiAktif->count() > 0): ?>
            <div class="space-y-4">
                <?php $__currentLoopData = $absensiAktif; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $absensi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $userRequest = $absensi->absensiMahasiswa()->where('user_id', auth()->id())->first();

                $now = now();
                $tanggalString = $absensi->tanggal instanceof \Carbon\Carbon ? $absensi->tanggal->format('Y-m-d') : $absensi->tanggal;
                $tanggalAbsensi = \Carbon\Carbon::parse($tanggalString . ' ' . $absensi->jam_mulai);
                $batasAbsensi = \Carbon\Carbon::parse($tanggalString . ' ' . $absensi->jam_selesai);

                // Perbaikan logika validasi waktu
                $canAttend = $now->between($tanggalAbsensi, $batasAbsensi) &&
                $now->toDateString() === $tanggalString;

                // Hanya tampilkan countdown jika absensi belum dimulai DAN masih di hari yang sama atau hari mendatang
                $isBeforeStart = $now < $tanggalAbsensi && $now->toDateString() <= $tanggalString;

                        // Absensi sudah berakhir jika lewat jam selesai ATAU sudah lewat tanggal
                        $isAfterEnd=$now> $batasAbsensi || $now->toDateString() > $tanggalString;

                        // Variabel untuk kompatibilitas dengan bagian action button
                        $startTime = $tanggalAbsensi;
                        $endTime = $batasAbsensi;
                        $isActive = $canAttend;
                        $isUpcoming = $isBeforeStart;
                        $isExpired = $isAfterEnd;
                        $userAbsensi = $userRequest;
                        ?>

                        <div class="bg-gray-700 rounded-lg p-4 border border-gray-600 hover:border-gray-500 transition-colors">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center mb-2">
                                        <h3 class="text-lg font-semibold text-white mr-3"><?php echo e($absensi->judul); ?></h3>

                                        <!-- Status Sesi Badge -->
                                        <?php if($canAttend): ?>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-500 text-white">
                                            <span class="w-2 h-2 bg-white rounded-full mr-1 animate-pulse"></span>
                                            Aktif
                                        </span>
                                        <?php elseif($isBeforeStart): ?>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-500 text-white">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                            </svg>
                                            Akan Datang
                                        </span>
                                        <?php else: ?>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-500 text-white">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                            </svg>
                                            Berakhir
                                        </span>
                                        <?php endif; ?>
                                    </div>

                                    <div class="flex items-center text-sm text-gray-300 space-x-4">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                            </svg>
                                            <?php echo e($absensi->tanggal instanceof \Carbon\Carbon ? $absensi->tanggal->format('d M Y') : \Carbon\Carbon::parse($absensi->tanggal)->format('d M Y')); ?>

                                        </span>
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                            </svg>
                                            <?php echo e($absensi->jam_mulai_formatted); ?> - <?php echo e($absensi->jam_selesai_formatted); ?>

                                        </span>
                                    </div>
                                    <?php if($absensi->deskripsi): ?>
                                    <div class="text-sm text-gray-400 mt-2">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="text-gray-500">Deskripsi:</span> <?php echo e($absensi->deskripsi); ?>

                                        </span>
                                    </div>
                                    <?php endif; ?>
                                </div>

                                <div class="flex items-center space-x-3">
                                    <?php if($userRequest): ?>
                                    <!-- Status Absensi User -->
                                    <?php if($userRequest->status === 'pending'): ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-500 text-white">
                                        Pending
                                    </span>
                                    <?php elseif($userRequest->status === 'approved'): ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-500 text-white">
                                        Disetujui
                                    </span>
                                    <?php elseif($userRequest->status === 'rejected'): ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-500 text-white">
                                        Ditolak
                                    </span>
                                    <?php endif; ?>
                                    <button disabled class="px-4 py-2 bg-gray-600 text-gray-300 rounded-lg text-sm cursor-not-allowed">
                                        Sudah Absen
                                    </button>
                                    <?php else: ?>
                                    <?php if($isActive): ?>
                                    <a onclick="openAbsensiModal(<?php echo e($absensi->id); ?>, '<?php echo e($absensi->judul); ?>')"
                                        class="px-4 py-2 bg-gradient-to-r from-teal-500 to-teal-600 hover:from-teal-600 hover:to-teal-700 text-white rounded-lg text-sm font-medium transition-colors">
                                        Absen Sekarang
                                    </a>
                                    <?php elseif($isUpcoming): ?>
                                    <button disabled class="px-4 py-2 bg-gray-600 text-gray-300 rounded-lg text-sm cursor-not-allowed">
                                        Belum Dimulai
                                    </button>
                                    <?php else: ?>
                                    <button disabled class="px-4 py-2 bg-red-600 text-red-100 rounded-lg text-sm cursor-not-allowed">
                                        Waktu Berakhir
                                    </button>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php else: ?>
            <div class="text-center py-12 text-gray-400">
                <div class="bg-gray-600 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8">
                        <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold mb-2 text-gray-300">Tidak Ada Absensi Aktif</h3>
                <p class="text-sm text-gray-400">Belum ada absensi yang tersedia saat ini</p>
            </div>
            <?php endif; ?>
        </div>

        <!-- Riwayat Absensi -->
        <div class="bg-gray-800 rounded-xl shadow-lg border border-gray-700 p-6">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-teal-500 to-teal-600 rounded-lg p-3 mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-white size-6">
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 0 0 0-1.5h-3.75V6Z" clip-rule="evenodd" />
                        </svg>

                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">Riwayat Absensi</h2>
                        <p class="text-gray-400 text-sm">Daftar riwayat kehadiran Anda</p>
                    </div>
                </div>
                <div class="text-sm text-gray-400">
                    Total: <?php echo e($riwayatAbsensi->count()); ?> riwayat
                </div>
            </div>

            <?php if($riwayatAbsensi->count() > 0): ?>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-600">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                Acara
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                Tanggal
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                Waktu Request
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-600">
                        <?php $__currentLoopData = $riwayatAbsensi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $riwayat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-gray-700 transition-colors">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-white"><?php echo e($riwayat->absensi->judul); ?></div>
                                <div class="text-xs text-gray-400 mt-1">
                                    <?php echo e(\Carbon\Carbon::parse($riwayat->absensi->jam_mulai)->format('H:i')); ?> - <?php echo e(\Carbon\Carbon::parse($riwayat->absensi->jam_selesai)->format('H:i')); ?>

                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-300">
                                    <?php echo e($riwayat->absensi->tanggal instanceof \Carbon\Carbon ? $riwayat->absensi->tanggal->format('d M Y') : \Carbon\Carbon::parse($riwayat->absensi->tanggal)->format('d M Y')); ?>

                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-300">
                                    <?php echo e($riwayat->waktu_absen->format('d M Y H:i')); ?>

                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <?php if($riwayat->status === 'pending'): ?>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-amber-500 text-white">
                                    Pending
                                </span>
                                <?php elseif($riwayat->status === 'approved'): ?>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-500 text-white">
                                    Disetujui
                                </span>
                                <?php else: ?>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-500 text-white">
                                    Ditolak
                                </span>
                                <?php endif; ?>
                                <?php if($riwayat->keterangan): ?>
                                <div class="text-xs text-gray-400 mt-1"><?php echo e($riwayat->keterangan); ?></div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination - Cyberpunk Style -->
            <div class="mt-6">
                <div class="flex justify-center">
                    <?php echo e($riwayatAbsensi->links('pagination::tailwind')); ?>

                </div>
            </div>
            <?php else: ?>
            <div class="text-center py-12 sm:py-16 text-gray-400">
                <div class="bg-gray-600/50 rounded-full w-20 h-20 sm:w-24 sm:h-24 flex items-center justify-center mx-auto mb-4 sm:mb-6">
                    <i class="fas fa-inbox text-3xl sm:text-4xl text-gray-500"></i>
                </div>
                <h3 class="text-lg sm:text-xl font-semibold mb-2 text-gray-300">Belum Ada Riwayat</h3>
                <p class="text-sm text-gray-400">Belum ada riwayat absensi yang tersedia</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

</div>
</div>

<!-- Modal Absensi - Enhanced Style -->
<div id="absensiModal" class="fixed inset-0 bg-black/80 backdrop-blur-md overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-10 sm:top-20 mx-auto p-4 border-0 w-full max-w-md shadow-2xl rounded-xl">
        <div class="bg-gray-800/95 border border-teal-500/30 rounded-xl backdrop-blur-sm">
            <div class="p-4 sm:p-6 text-center border-b border-gray-600/50">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-teal-900/50 mb-4 border border-teal-400/30">
                    <i class="fas fa-hand-paper text-teal-400 text-xl"></i>
                </div>
                <h3 class="text-lg font-medium text-white mb-2">Konfirmasi Absensi</h3>
                <p class="text-sm text-gray-300 mb-4">Anda akan mengajukan absensi untuk:</p>
                <p id="absensiTitle" class="text-lg font-semibold text-teal-300 mb-4"></p>

                <form id="absensiForm" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-4">
                        <label for="keterangan" class="block text-sm font-medium text-gray-300 mb-2">Keterangan (Opsional)</label>
                        <textarea name="keterangan" id="keterangan" rows="3"
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500"
                            placeholder="Tambahkan keterangan jika diperlukan..."></textarea>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <button type="submit" class="flex-1 px-4 py-2 bg-gradient-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 text-white text-base font-medium rounded-lg shadow-sm border border-teal-500/30 focus:outline-none focus:ring-2 focus:ring-teal-500 transition-all duration-300">
                            <i class="fas fa-paper-plane mr-2"></i>Kirim Absensi
                        </button>
                        <button type="button" onclick="closeAbsensiModal()" class="flex-1 px-4 py-2 bg-gray-600/80 hover:bg-gray-500/80 text-gray-200 text-base font-medium rounded-lg shadow-sm border border-gray-500/30 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-all duration-300">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openAbsensiModal(absensiId, absensiTitle) {
            document.getElementById('absensiForm').action = `/mahasiswa/absensi/${absensiId}/request`;
            document.getElementById('absensiTitle').textContent = absensiTitle;
            document.getElementById('absensiModal').classList.remove('hidden');
        }

        function closeAbsensiModal() {
            document.getElementById('absensiModal').classList.add('hidden');
            document.getElementById('keterangan').value = '';
        }

        // Tampilkan alert jika ada session success
        <?php if(session('success')): ?>
        alert("<?php echo e(session('success')); ?>");
        <?php endif; ?>

        // Auto refresh setiap 2 menit untuk update status waktu
        setInterval(function() {
            location.reload();
        }, 120000);
    </script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mahasiswa', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\yuwaraja-new\resources\views/mahasiswa/absensi/index.blade.php ENDPATH**/ ?>