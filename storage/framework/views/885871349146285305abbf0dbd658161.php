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
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z" clip-rule="evenodd" />
                                </svg>

                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-white">Manajemen Absensi</h1>
                                <p class="text-sm text-gray-300">Kelola dan monitor absensi mahasiswa</p>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-3 gap-4">
                        <div class="bg-gradient-to-r from-amber-500 to-amber-600 rounded-lg p-4 text-center shadow-lg">
                            <div class="text-2xl font-bold text-white"><?php echo e($pendingRequests->count()); ?></div>
                            <div class="text-xs text-white font-medium">Pending</div>
                        </div>
                        <div class="bg-gradient-to-r from-teal-500 to-teal-600 rounded-lg p-4 text-center shadow-lg">
                            <div class="text-2xl font-bold text-white"><?php echo e($absensiList->count()); ?></div>
                            <div class="text-xs text-white font-medium">Aktif</div>
                        </div>
                        <div class="bg-gradient-to-r from-gray-600 to-gray-700 rounded-lg p-4 text-center shadow-lg">
                            <div class="text-2xl font-bold text-white"><?php echo e($approvedRequests->count()); ?></div>
                            <div class="text-xs text-white font-medium">Disetujui</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alert Messages -->
        <?php if(session('success')): ?>
        <div class="mb-6 bg-gradient-to-r from-teal-600 to-teal-700 text-white px-4 py-3 rounded-lg shadow-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium"><?php echo e(session('success')); ?></span>
            </div>
        </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <div class="mb-6 bg-gradient-to-r from-red-600 to-rose-600 text-white px-4 py-3 rounded-lg shadow-lg">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium"><?php echo e(session('error')); ?></span>
            </div>
        </div>
        <?php endif; ?>

        <!-- Pending Requests Section -->
        <?php if($pendingRequests->count() > 0): ?>
        <div class="bg-gray-800 rounded-xl shadow-lg border border-gray-700 mb-6 lg:mb-8 overflow-hidden">
            <div class="bg-gradient-to-r from-amber-600 to-orange-600 border-b border-gray-700 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="bg-white bg-opacity-20 rounded-lg p-2 mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-white">Permintaan Pending</h2>
                            <p class="text-sm text-gray-200">Permintaan absensi yang menunggu persetujuan</p>
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-20 px-3 py-1 rounded-full">
                        <span class="text-sm font-semibold text-white"><?php echo e($pendingRequests->count()); ?> Permintaan</span>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <div class="space-y-4">
                    <?php $__currentLoopData = $pendingRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-gray-700 border border-gray-600 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                            <div class="flex items-center mb-3 sm:mb-0">
                                <div class="flex-shrink-0 mr-4">
                                    <?php if($request->mahasiswa->photo): ?>
                                    <img class="h-12 w-12 rounded-lg object-cover" src="<?php echo e(asset('profile-pictures/' . $request->mahasiswa->photo)); ?>" alt="">
                                    <?php else: ?>
                                    <div class="h-12 w-12 rounded-lg bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <div class="font-semibold text-white"><?php echo e($request->mahasiswa->name); ?></div>
                                    <div class="text-sm text-gray-300"><?php echo e($request->mahasiswa->nim); ?></div>
                                    <div class="text-xs text-amber-400 font-medium"><?php echo e($request->mahasiswa->kelompok->nama_kelompok ?? 'Belum ada Cluster'); ?></div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3 sm:mb-0 sm:flex-1 sm:mx-6">
                                <div class="text-sm">
                                    <div class="text-gray-400">Absensi</div>
                                    <div class="font-medium text-white"><?php echo e($request->absensi->judul); ?></div>
                                </div>
                                <div class="text-sm">
                                    <div class="text-gray-400">Waktu Request</div>
                                    <div class="font-medium text-white"><?php echo e($request->waktu_absen->format('d M Y, H:i')); ?></div>
                                </div>
                                <?php if($request->keterangan): ?>
                                <div class="text-sm col-span-2">
                                    <div class="text-gray-400">Keterangan</div>
                                    <div class="font-medium text-gray-300"><?php echo e($request->keterangan); ?></div>
                                </div>
                                <?php endif; ?>
                            </div>

                            <div class="flex space-x-2">
                                <form action="<?php echo e(route('spv.absensi.approve', $request)); ?>" method="POST">
                                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                    <button type="submit" class="bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all shadow-lg">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Setujui
                                    </button>
                                </form>
                                <button onclick="openRejectModal(<?php echo e($request->id); ?>)" class="bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all shadow-lg">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Tolak
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Active Sessions Section -->
        <div class="mb-8">
            <div class="bg-gray-800 rounded-xl shadow-lg border border-gray-700 p-6">
                <div class="flex items-center mb-6">
                    <div class="bg-gradient-to-r from-cyan-500 to-blue-600 rounded-lg p-2 mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd" d="M2.25 6a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3v12a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V6Zm18 3H3.75v9a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V9Zm-15-3.75A.75.75 0 0 0 4.5 6v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V6a.75.75 0 0 0-.75-.75H5.25Zm1.5.75a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H7.5a.75.75 0 0 1-.75-.75V6Zm3-.75A.75.75 0 0 0 9 6v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V6a.75.75 0 0 0-.75-.75H9.75Z" clip-rule="evenodd" />
                        </svg>

                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">Sesi Aktif</h2>
                        <p class="text-sm text-gray-300">Sesi absensi yang sedang berlangsung</p>
                    </div>
                </div>

                <?php if($absensiList->count() > 0): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php $__currentLoopData = $absensiList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $absensi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-gray-700 border border-gray-600 rounded-lg p-6 hover:shadow-lg transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <!-- <div class="bg-gradient-to-r from-emerald-500 to-green-600 rounded-lg p-2">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div> -->
                            <?php
                                $now = now();
                                $absensiStart = \Carbon\Carbon::parse($absensi->tanggal->format('Y-m-d') . ' ' . $absensi->jam_mulai);
                                $absensiEnd = \Carbon\Carbon::parse($absensi->tanggal->format('Y-m-d') . ' ' . $absensi->jam_selesai);
                            ?>
                            
                            <?php if($now < $absensiStart): ?>
                                <span class="bg-gradient-to-r from-blue-500 to-blue-600 text-white text-xs font-medium px-3 py-1 rounded-full flex items-center gap-1">
                                    <div class="w-2 h-2 bg-white rounded-full"></div>
                                    Akan Datang
                                </span>
                            <?php elseif($now >= $absensiStart && $now <= $absensiEnd): ?>
                                <span class="bg-gradient-to-r from-emerald-500 to-green-600 text-white text-xs font-medium px-3 py-1 rounded-full flex items-center gap-1">
                                    <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                                    Aktif
                                </span>
                            <?php else: ?>
                                <span class="bg-gradient-to-r from-red-500 to-red-600 text-white text-xs font-medium px-3 py-1 rounded-full flex items-center gap-1">
                                    <div class="w-2 h-2 bg-white rounded-full"></div>
                                    Berakhir
                                </span>
                            <?php endif; ?>
                        </div>

                        <h3 class="text-lg font-semibold text-white mb-3"><?php echo e($absensi->judul); ?></h3>

                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-sm text-gray-300">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span><?php echo e($absensi->tanggal->format('d M Y')); ?></span>
                            </div>
                            <div class="flex items-center text-sm text-gray-300">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span><?php echo e($absensi->jam_mulai_formatted); ?> - <?php echo e($absensi->jam_selesai_formatted); ?></span>
                            </div>
                            <div class="flex items-center text-sm text-gray-300">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span><?php echo e($absensi->absensiMahasiswa()->count()); ?> permintaan</span>
                            </div>
                        </div>

                        <a href="<?php echo e(route('spv.absensi.show', $absensi)); ?>" class="block w-full bg-gradient-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 text-white font-medium py-2 px-4 rounded-lg transition-colors text-center text-sm shadow-lg">
                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            Lihat Detail
                        </a>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php else: ?>
                <div class="text-center py-12">
                    <div class="bg-gray-700 rounded-full p-6 w-20 h-20 mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">Tidak Ada Sesi Aktif</h3>
                    <p class="text-gray-300">Belum ada sesi absensi yang sedang berlangsung</p>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Approved Requests Section -->
        <?php if($approvedRequests->count() > 0): ?>
        <div class="mb-8">
            <div class="bg-gray-800 rounded-xl shadow-lg border border-gray-700 p-6">
                <div class="flex items-center mb-6">
                    <div class="bg-gradient-to-r from-teal-500 to-teal-600 rounded-lg p-2 mr-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">Permintaan Disetujui</h2>
                        <p class="text-sm text-gray-300">20 permintaan terakhir yang telah disetujui</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-600">
                        <thead class="bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Mahasiswa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Absensi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Waktu Request</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-gray-800 divide-y divide-gray-600">
                            <?php $__currentLoopData = $approvedRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-700">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <?php if($request->mahasiswa->photo): ?>
                                            <img class="h-10 w-10 rounded-lg object-cover" src="<?php echo e(asset('profile-pictures/' . $request->mahasiswa->photo)); ?>" alt="">
                                            <?php else: ?>
                                            <div class="h-10 w-10 rounded-lg bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-white"><?php echo e($request->mahasiswa->name); ?></div>
                                            <div class="text-sm text-gray-300"><?php echo e($request->mahasiswa->nim); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-white"><?php echo e($request->absensi->judul); ?></div>
                                    <div class="text-sm text-gray-300"><?php echo e($request->absensi->tanggal->format('d M Y')); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                                    <?php echo e($request->waktu_absen->format('d M Y, H:i')); ?>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gradient-to-r from-emerald-500 to-green-600 text-white">
                                        Disetujui
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="mb-8">
            <div class="bg-gray-800 rounded-xl shadow-lg border border-gray-700 p-6">
                <div class="flex items-center mb-6">
                    <div class="bg-gradient-to-r from-emerald-500 to-green-600 rounded-lg p-2 mr-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">Permintaan Disetujui</h2>
                        <p class="text-sm text-gray-300">20 permintaan terakhir yang telah disetujui</p>
                    </div>
                </div>

                <div class="text-center py-12">
                    <div class="bg-gray-700 rounded-full p-6 w-20 h-20 mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">Belum Ada Permintaan Disetujui</h3>
                    <p class="text-gray-300">Belum ada permintaan absensi yang disetujui</p>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Reject Request Modal -->
<div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-gray-800 rounded-lg p-6 max-w-md w-full mx-4 shadow-xl border border-gray-700">
        <div class="flex items-center mb-4">
            <div class="bg-gradient-to-r from-red-500 to-rose-600 rounded-lg p-2 mr-3">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-white">Tolak Permintaan</h3>
                <p class="text-sm text-gray-300">Berikan alasan penolakan</p>
            </div>
        </div>

        <form id="rejectForm" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>
            <div class="mb-4">
                <label for="alasan_penolakan" class="block text-sm font-medium text-gray-300 mb-2">Alasan Penolakan</label>
                <textarea id="alasan_penolakan" name="alasan_penolakan" rows="4" class="w-full border border-gray-600 bg-gray-700 rounded-lg px-3 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Masukkan alasan penolakan..." required></textarea>
            </div>

            <div class="flex space-x-3">
                <button type="button" onclick="closeRejectModal()" class="flex-1 bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                    Batal
                </button>
                <button type="submit" class="flex-1 bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white font-medium py-2 px-4 rounded-lg transition-all shadow-lg">
                    Tolak
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openRejectModal(requestId) {
        // Pastikan route ini sesuai dengan yang ada di web.php Anda
        document.getElementById('rejectForm').action = `/spv/absensi/${requestId}/reject`;
        document.getElementById('rejectModal').classList.remove('hidden');
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.spv', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\yuwaraja-new\resources\views/spv/absensi/index.blade.php ENDPATH**/ ?>