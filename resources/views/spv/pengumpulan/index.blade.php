@extends('layouts.app')

@section('title', 'Daftar Pengumpulan Tugas')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;600;700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Kanit', sans-serif;
        background-color: #020617; /* slate-950 */
        color: #e5e7eb; /* gray-200 */
    }
    .font-poppins {
        font-family: 'Poppins', sans-serif;
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-slate-950 py-8 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <header class="mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h1 class="font-poppins text-2xl sm:text-3xl font-bold text-white">Daftar Pengumpulan Tugas</h1>
                    <p class="text-gray-400 mt-1">Lihat dan review semua tugas yang telah dikumpulkan oleh mahasiswa.</p>
                </div>
                {{-- Anda bisa menambahkan total data di sini jika variabelnya tersedia --}}
                {{-- @if(isset($semuaPengumpulan))
                <div class="bg-gray-800/50 p-3 rounded-lg border border-gray-700 text-center">
                    <div class="font-poppins text-3xl font-bold text-teal-400">{{ $semuaPengumpulan->total() }}</div>
                    <div class="text-sm text-gray-400">Total Data</div>
                </div>
                @endif --}}
            </div>
        </header>

        <!-- Tabel Data Pengumpulan -->
        <div class="bg-slate-900 border border-gray-700/50 rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-300">
                    <thead class="text-xs text-gray-400 uppercase bg-slate-800/50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Mahasiswa</th>
                            <th scope="col" class="px-6 py-3">Judul Tugas</th>
                            <th scope="col" class="px-6 py-3">Tgl. Pengumpulan</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- 
                            CATATAN: Pastikan variabel yang dikirim dari controller Anda adalah $semuaPengumpulan.
                            Jika namanya berbeda (misal: $pengumpulans), ganti variabel di bawah ini.
                        --}}
                        @forelse ($semuaPengumpulan as $item)
                            <tr class="bg-slate-900 border-b border-gray-800 hover:bg-slate-800/40 transition-colors duration-200">
                                <td class="px-6 py-4 font-semibold text-white whitespace-nowrap">
                                    {{ $item->user->name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ Str::limit($item->tugas->judul ?? 'N/A', 40) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 text-xs font-semibold uppercase tracking-wider rounded-full 
                                        @if($item->status == 'submitted') bg-blue-500/10 text-blue-400 
                                        @elseif($item->status == 'reviewed') bg-yellow-500/10 text-yellow-400
                                        @elseif($item->status == 'approved' || $item->status == 'done') bg-green-500/10 text-green-400
                                        @else bg-gray-500/10 text-gray-400 @endif">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('spv.tugas-mahasiswa.review', $item->id) }}" class="font-medium text-teal-400 hover:text-teal-300 transition-colors duration-200">
                                        Review
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-8 px-6">
                                    <div class="flex flex-col items-center gap-2 text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <p class="font-semibold">Belum ada data pengumpulan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($semuaPengumpulan->hasPages())
            <div class="p-4 bg-slate-800/50 border-t border-gray-800">
                {{ $semuaPengumpulan->links() }}
            </div>
            @endif
        </div>

    </div>
</div>
@endsection