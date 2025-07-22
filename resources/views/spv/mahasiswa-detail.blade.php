@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('spv.cluster.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                        </svg>
                        Cluster
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Detail Mahasiswa</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 dark:from-gray-700 dark:to-gray-800 px-8 py-6 rounded-t-2xl">
                <div class="flex items-center space-x-6">
                    <div class="w-20 h-20 rounded-full bg-white/20 flex items-center justify-center text-white font-bold text-2xl">
                        {{ $mahasiswa->name ? strtoupper(substr($mahasiswa->name, 0, 1)) : 'M' }}
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-white">{{ $mahasiswa->name ?? 'Nama tidak tersedia' }}</h1>
                        <p class="text-blue-100 dark:text-gray-300 text-lg font-mono">{{ $mahasiswa->nim ?? 'NIM belum diisi' }}</p>
                        <div class="flex items-center mt-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Mahasiswa Aktif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Profile Information -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Profil Mahasiswa</h2>
                </div>
                
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Nama Lengkap</label>
                            <p class="text-lg text-gray-900 dark:text-white font-medium mt-1">{{ $mahasiswa->name ?? 'Belum diisi' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">NIM</label>
                            <p class="text-lg text-gray-900 dark:text-white font-mono mt-1">{{ $mahasiswa->nim ?? 'Belum diisi' }}</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Program Studi</label>
                            <p class="text-lg text-gray-900 dark:text-white mt-1">{{ $mahasiswa->program_studi ?? 'Belum diisi' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Angkatan</label>
                            <p class="text-lg text-gray-900 dark:text-white mt-1">{{ $mahasiswa->angkatan ?? 'Belum diisi' }}</p>
                        </div>
                    </div>
                    
                    <div>
                        <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Cluster</label>
                        <p class="text-lg text-gray-900 dark:text-white mt-1">{{ $kelompok->nama_kelompok ?? 'Belum diisi' }}</p>
                    </div>
                </div>
            </div>

            <!-- Personal Information -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Informasi Personal</h2>
                </div>
                
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Tempat Lahir</label>
                            <p class="text-lg text-gray-900 dark:text-white mt-1">{{ $mahasiswa->tempat_lahir ?? 'Belum diisi' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Tanggal Lahir</label>
                            <p class="text-lg text-gray-900 dark:text-white mt-1">
                                {{ $mahasiswa->tanggal_lahir ? \Carbon\Carbon::parse($mahasiswa->tanggal_lahir)->format('d F Y') : 'Belum diisi' }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Jenis Kelamin</label>
                            <p class="text-lg text-gray-900 dark:text-white mt-1">{{ $mahasiswa->jenis_kelamin ?? 'Belum diisi' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Asal Kota</label>
                            <p class="text-lg text-gray-900 dark:text-white mt-1">{{ $mahasiswa->asal_kota ?? 'Belum diisi' }}</p>
                        </div>
                    </div>
                    
                    <div>
                        <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Provinsi</label>
                        <p class="text-lg text-gray-900 dark:text-white mt-1">{{ $mahasiswa->provinsi ?? 'Belum diisi' }}</p>
                    </div>
                    
                    <div>
                        <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Alamat Domisili</label>
                        <p class="text-lg text-gray-900 dark:text-white mt-1">{{ $mahasiswa->alamat_domisili ?? 'Belum diisi' }}</p>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Informasi Kontak</h2>
                </div>
                
                <div class="space-y-6">
                    <div>
                        <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Email</label>
                        <p class="text-lg text-gray-900 dark:text-white mt-1 break-all">{{ $mahasiswa->email ?? 'Belum diisi' }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Nomor Telepon</label>
                        <p class="text-lg text-gray-900 dark:text-white font-mono mt-1">{{ $mahasiswa->nomor_telepon ?? 'Belum diisi' }}</p>
                    </div>
                </div>
            </div>

            <!-- Educational Background -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-8 shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Latar Belakang Pendidikan</h2>
                </div>
                
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Jenis Sekolah Asal</label>
                            <p class="text-lg text-gray-900 dark:text-white mt-1">{{ $mahasiswa->asal_sekolah_jenis ?? 'Belum diisi' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Nama Sekolah Asal</label>
                            <p class="text-lg text-gray-900 dark:text-white mt-1">{{ $mahasiswa->asal_sekolah_nama ?? 'Belum diisi' }}</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Jurusan Sekolah</label>
                            <p class="text-lg text-gray-900 dark:text-white mt-1">{{ $mahasiswa->jurusan_sekolah ?? 'Belum diisi' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Jalur Masuk</label>
                            <p class="text-lg text-gray-900 dark:text-white mt-1">{{ $mahasiswa->jalur_masuk ?? 'Belum diisi' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-8 flex justify-center">
            <a href="{{ route('spv.cluster.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Cluster
            </a>
        </div>
    </div>
</div>
@endsection