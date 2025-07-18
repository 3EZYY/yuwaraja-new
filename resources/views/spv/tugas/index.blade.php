@extends('layouts.app')

@section('title', 'Daftar Tugas')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #0D1117;
    }
    .font-kanit {
        font-family: 'Kanit', sans-serif;
    }
    ::-webkit-scrollbar {
        width: 8px;
    }
    ::-webkit-scrollbar-track {
        background: #0D1117;
    }
    ::-webkit-scrollbar-thumb {
        background-color: #164e63;
        border-radius: 10px;
        border: 2px solid #0D1117;
    }
    ::-webkit-scrollbar-thumb:hover {
        background-color: #0e7490;
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-[#0D1117] to-[#111827] text-white p-4 sm:p-6 lg:p-8">
    <div class="max-w-7xl mx-auto">
        
        <header class="mb-8 scroll-reveal">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <h1 class="font-kanit text-3xl sm:text-4xl font-bold text-teal-400 tracking-wide">
                        Tugas Mahasiswa
                    </h1>
                    <p class="font-poppins text-gray-400 mt-1">
                        Kelola dan pantau semua tugas Anda di sini.
                    </p>
                </div>
                <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-3 text-center w-full sm:w-auto">
                    <div class="font-kanit text-3xl font-bold text-yellow-400">{{ $tugas->total() }}</div>
                    <div class="text-sm text-gray-400">Total Tugas</div>
                </div>
            </div>
            <div class="h-px bg-gray-700/50 mt-6"></div>
        </header>

        <div class="grid grid-cols-1 gap-6">
            @forelse($tugas as $index => $item)
            <div class="scroll-reveal bg-gray-800/60 border border-gray-700 rounded-lg shadow-lg overflow-hidden transition-all duration-300 hover:border-teal-400/50 hover:shadow-teal-500/10 hover:-translate-y-1"
                 style="transition-delay: {{ $index * 100 }}ms;">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row justify-between md:items-start gap-4">
                        <div class="flex-grow">
                            <div class="flex flex-wrap items-center gap-x-4 gap-y-2 mb-3">
                                <h2 class="font-kanit text-xl lg:text-2xl font-semibold text-white">
                                    {{ $item->judul }}
                                </h2>
                                @if($item->tingkat_kesulitan === 'mudah')
                                    <span class="text-xs font-medium text-green-300 bg-green-900/50 ring-1 ring-green-300/30 px-3 py-1 rounded-full">Mudah</span>
                                @elseif($item->tingkat_kesulitan === 'sedang')
                                    <span class="text-xs font-medium text-yellow-300 bg-yellow-900/50 ring-1 ring-yellow-300/30 px-3 py-1 rounded-full">Sedang</span>
                                @else
                                    <span class="text-xs font-medium text-red-300 bg-red-900/50 ring-1 ring-red-300/30 px-3 py-1 rounded-full">Sulit</span>
                                @endif
                            </div>
                            
                            <p class="font-poppins text-gray-300 text-sm leading-relaxed mb-6">
                                {{ Str::limit($item->deskripsi, 250) }}
                            </p>

                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-sm">
                                <div class="flex items-center gap-3">
                                    <svg class="w-6 h-6 text-teal-400/70 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <div>
                                        <div class="text-gray-400">Deadline</div>
                                        <div class="font-semibold text-white">{{ \Carbon\Carbon::parse($item->deadline)->format('d M Y, H:i') }}</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <svg class="w-6 h-6 text-teal-400/70 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v5m0 0v2.5m0-2.5h2.5m-2.5 0H9.5m7.5-6.5c-1.583-1.583-3.75-2.5-6-2.5S7.083 4.917 5.5 6.5M18.5 6.5c1.583 1.583 2.5 3.75 2.5 6s-.917 4.417-2.5 6M12 21a9 9 0 110-18 9 9 0 010 18z"></path></svg>
                                    <div>
                                        <div class="text-gray-400">Poin</div>
                                        <div class="font-semibold text-white">{{ $item->poin ?? 100 }} Poin</div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                     @if(\Carbon\Carbon::parse($item->deadline)->isPast())
                                        <svg class="w-6 h-6 text-red-400/70 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <div>
                                            <div class="text-gray-400">Status</div>
                                            <div class="font-semibold text-red-400">Berakhir</div>
                                        </div>
                                    @else
                                        <svg class="w-6 h-6 text-green-400/70 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <div>
                                            <div class="text-gray-400">Status</div>
                                            <div class="font-semibold text-green-400">Aktif</div>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex items-center gap-3">
                                    <svg class="w-6 h-6 text-teal-400/70 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <div>
                                        <div class="text-gray-400">Sisa Waktu</div>
                                        <div class="font-semibold text-white">{{ \Carbon\Carbon::parse($item->deadline)->diffForHumans() }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex-shrink-0 mt-4 md:mt-0 md:ml-6">
                             <a href="{{ route('mahasiswa.tugas.show', $item) }}" 
                                class="inline-flex items-center justify-center gap-2 w-full md:w-auto bg-teal-500 text-gray-900 font-semibold text-sm px-5 py-3 rounded-lg shadow-md transition-all duration-300 hover:bg-teal-400 hover:shadow-lg hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-teal-500">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" /></svg>
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="scroll-reveal bg-gray-800/60 border border-dashed border-gray-700 rounded-lg p-12 text-center">
                <svg class="w-20 h-20 mx-auto text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                <h3 class="font-kanit text-2xl font-semibold text-white mt-4">Belum Ada Tugas</h3>
                <p class="text-gray-400 mt-2">Saat ada tugas baru, tugas tersebut akan ditampilkan di sini.</p>
            </div>
            @endforelse
        </div>

        @if($tugas->hasPages())
        <div class="mt-10 flex justify-center">
            {{ $tugas->links() }}
        </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const revealElements = document.querySelectorAll('.scroll-reveal');
    
    revealElements.forEach(el => {
        el.classList.add('opacity-0', 'transform', 'translate-y-5');
        el.classList.add('transition-all', 'duration-700', 'ease-out');
    });

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.remove('opacity-0', 'translate-y-5');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    revealElements.forEach(el => {
        observer.observe(el);
    });
});
</script>
@endsection