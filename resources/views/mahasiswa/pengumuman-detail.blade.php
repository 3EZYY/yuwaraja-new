@extends('layouts.app')

@section('content')
    {{-- CSS Kustom untuk Font, Animasi, dan Styling --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap');
        
        .font-display { font-family: 'Poppins', sans-serif; }
        .font-body { font-family: 'Inter', sans-serif; }
        
        /* Efek Glow untuk Teks */
        .text-glow-cyan {
            text-shadow: 0 0 20px rgba(6, 182, 212, 0.5), 0 0 40px rgba(6, 182, 212, 0.3);
        }

        /* Animasi Background Grid */
        @keyframes float-grid {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(1deg); }
        }
        
        .animated-grid-background {
            position: absolute; 
            inset: 0; 
            width: 100%; 
            height: 100%; 
            z-index: 0;
            background-image: 
                radial-gradient(circle at 25% 25%, rgba(6, 182, 212, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(251, 191, 36, 0.1) 0%, transparent 50%),
                linear-gradient(rgba(6, 182, 212, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(6, 182, 212, 0.05) 1px, transparent 1px);
            background-size: 800px 800px, 600px 600px, 40px 40px, 40px 40px;
            animation: float-grid 20s ease-in-out infinite;
        }

        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: rgba(17, 24, 39, 0.5);
            border-radius: 3px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(6, 182, 212, 0.5);
            border-radius: 3px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(6, 182, 212, 0.7);
        }

        /* Enhanced Content Styling */
        .content-wrapper {
            line-height: 1.8;
            font-size: 1.1rem;
        }
        
        .content-wrapper h1, .content-wrapper h2, .content-wrapper h3 {
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        
        .content-wrapper p {
            margin-bottom: 1.5rem;
            text-align: justify;
        }
        
        .content-wrapper ul, .content-wrapper ol {
            margin: 1.5rem 0;
            padding-left: 1.5rem;
        }
        
        .content-wrapper li {
            margin-bottom: 0.5rem;
        }
    </style>

<div class="font-body bg-gradient-to-br from-gray-900 via-slate-900 to-gray-900 min-h-screen relative overflow-hidden">
    <!-- Background Animation -->
    <div class="animated-grid-background opacity-30"></div>
    
    <!-- Main Content Container -->
    <div class="relative z-10 min-h-screen py-8 sm:py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Navigation Back Button -->
            <div class="mb-8 sm:mb-12">
                <a href="{{ route('mahasiswa.pengumuman.index') }}" 
                   class="inline-flex items-center gap-3 px-4 py-2 bg-gray-800/50 hover:bg-gray-700/50 
                          border border-cyan-500/30 hover:border-cyan-400/50 rounded-xl 
                          text-cyan-300 hover:text-cyan-200 transition-all duration-300 
                          backdrop-blur-sm group">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                         class="h-5 w-5 transform group-hover:-translate-x-1 transition-transform duration-300" 
                         fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                    </svg>
                    <span class="font-medium">Kembali ke Pusat Informasi</span>
                </a>
            </div>
            
            <!-- Main Article Card -->
            <article class="bg-gray-900/80 backdrop-blur-xl shadow-2xl rounded-3xl border border-cyan-500/20 
                           hover:border-cyan-400/30 transition-all duration-500 overflow-hidden">
                
                <!-- Article Header -->
                <header class="relative px-6 sm:px-8 lg:px-12 pt-8 sm:pt-12 pb-6 sm:pb-8 
                              bg-gradient-to-r from-gray-800/50 to-gray-900/50 
                              border-b border-gray-700/50">
                    
                    <!-- Decorative Elements -->
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cyan-400 via-blue-500 to-purple-600"></div>
                    
                    <!-- Title -->
                    <h1 class="font-display text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-bold 
                              text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-blue-400 
                              text-glow-cyan mb-4 sm:mb-6 leading-tight">
                        {{ $pengumuman->judul }}
                    </h1>
                    
                    <!-- Meta Information -->
                    <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-6 text-sm text-gray-400">
                        <div class="flex items-center gap-2">
                            <div class="p-2 bg-cyan-500/10 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <span>Dipublikasikan pada: 
                                <span class="font-semibold text-amber-300">
                                    {{ ($pengumuman->published_at ?? $pengumuman->created_at)->format('d F Y, H:i') }}
                                </span>
                            </span>
                        </div>
                        
                        <div class="flex items-center gap-2">
                            <div class="p-2 bg-green-500/10 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="text-green-400 font-medium">Pengumuman Resmi</span>
                        </div>
                    </div>
                </header>

                <!-- Article Content -->
                <div class="px-6 sm:px-8 lg:px-12 py-8 sm:py-12">
                    <div class="content-wrapper custom-scrollbar text-gray-300 leading-relaxed
                               prose prose-invert prose-lg max-w-none
                               prose-headings:text-cyan-300 prose-headings:font-semibold prose-headings:mb-4 prose-headings:mt-8
                               prose-p:text-gray-300 prose-p:leading-relaxed prose-p:mb-6 prose-p:text-justify
                               prose-a:text-amber-300 hover:prose-a:text-amber-200 prose-a:underline prose-a:decoration-2 prose-a:underline-offset-4
                               prose-strong:text-white prose-strong:font-semibold
                               prose-em:text-gray-200 prose-em:italic
                               prose-ul:text-gray-300 prose-ol:text-gray-300 prose-ul:my-6 prose-ol:my-6
                               prose-li:mb-2 prose-li:leading-relaxed
                               prose-blockquote:border-l-4 prose-blockquote:border-cyan-400 prose-blockquote:pl-6 prose-blockquote:py-2 
                               prose-blockquote:italic prose-blockquote:text-gray-400 prose-blockquote:bg-gray-800/30 prose-blockquote:rounded-r-lg
                               prose-code:bg-gray-800 prose-code:text-cyan-300 prose-code:px-2 prose-code:py-1 prose-code:rounded prose-code:text-sm
                               prose-pre:bg-gray-800 prose-pre:border prose-pre:border-gray-700 prose-pre:rounded-lg prose-pre:p-4
                               prose-img:rounded-xl prose-img:shadow-2xl prose-img:border prose-img:border-gray-700
                               prose-hr:border-gray-600 prose-hr:my-8
                               prose-table:border-collapse prose-table:border prose-table:border-gray-700
                               prose-th:border prose-th:border-gray-700 prose-th:bg-gray-800 prose-th:p-3
                               prose-td:border prose-td:border-gray-700 prose-td:p-3">
                        {!! $pengumuman->konten !!}
                    </div>
                </div>

                <!-- Article Footer -->
                <footer class="px-6 sm:px-8 lg:px-12 py-6 bg-gray-800/30 border-t border-gray-700/50">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="text-sm text-gray-500">
                            <span>Terakhir diperbarui: {{ ($pengumuman->published_at ?? $pengumuman->updated_at)->format('d F Y, H:i') }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Informasi resmi dari Panitia PPKMB YUWARAJA XVII</span>
                        </div>
                    </div>
                </footer>
                
            </article>
            
            <!-- Bottom Spacing -->
            <div class="h-8 sm:h-12"></div>
            
        </div>
    </div>
</div>
@endsection