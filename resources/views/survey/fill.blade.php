@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-8 relative overflow-hidden">
    <!-- Dark texture overlay -->
    <div class="absolute inset-0 opacity-30">
        <div class="absolute inset-0 bg-gradient-to-r from-black/20 via-transparent to-black/20"></div>
        <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(circle_at_50%_50%,rgba(103,232,237,0.03)_0%,transparent_50%)] animate-pulse"></div>
        <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-gradient-to-br from-[#67E8ED]/5 to-transparent rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 left-1/4 w-80 h-80 bg-gradient-to-tr from-[#4DD0E1]/5 to-transparent rounded-full blur-3xl"></div>
    </div>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="relative bg-gradient-to-br from-gray-800/90 via-gray-700/80 to-gray-800/90 backdrop-blur-sm rounded-xl shadow-2xl border border-gray-600/30 p-8 mb-8 overflow-hidden">
            <!-- Subtle texture overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-[#67E8ED]/5 via-transparent to-[#4DD0E1]/5 opacity-50"></div>
            <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-[#67E8ED]/10 to-transparent rounded-full blur-2xl"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-[#4DD0E1]/10 to-transparent rounded-full blur-2xl"></div>
            
            <div class="relative z-10">
                <div class="flex items-center gap-4 mb-6">
                    <div class="p-3 bg-gradient-to-br from-[#67E8ED]/20 to-[#4DD0E1]/15 rounded-xl border border-[#67E8ED]/40 shadow-lg shadow-[#67E8ED]/10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#67E8ED]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 8l2 2 4-4" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold bg-gradient-to-r from-white via-gray-100 to-white bg-clip-text text-transparent">{{ $survey->judul_survey }}</h1>
                        <div class="h-1 w-20 bg-gradient-to-r from-[#67E8ED] to-[#4DD0E1] rounded-full mt-2 shadow-lg shadow-[#67E8ED]/30"></div>
                    </div>
                </div>
                
                @if($survey->deskripsi_survey)
                    <div class="bg-black/20 backdrop-blur-sm rounded-xl p-4 mb-6 border border-gray-600/30">
                        <p class="text-gray-200 leading-relaxed">{{ $survey->deskripsi_survey }}</p>
                    </div>
                @endif
                
                <div class="flex flex-wrap gap-6 text-sm">
                    <div class="flex items-center gap-2 bg-gradient-to-r from-[#67E8ED]/15 to-[#4DD0E1]/10 px-4 py-2 rounded-lg border border-[#67E8ED]/40 backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#67E8ED]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-gray-200 font-medium">Periode: {{ $survey->tanggal_mulai->format('d M Y') }} - {{ $survey->tanggal_selesai->format('d M Y') }}</span>
                    </div>
                    <div class="flex items-center gap-2 bg-gradient-to-r from-[#4DD0E1]/15 to-[#67E8ED]/10 px-4 py-2 rounded-lg border border-[#4DD0E1]/40 backdrop-blur-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#4DD0E1]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="text-gray-200 font-medium">{{ $survey->detilSurvey->count() }} Pertanyaan</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Survey Form -->
        <div class="relative bg-gradient-to-br from-gray-800/90 via-gray-700/80 to-gray-800/90 backdrop-blur-sm rounded-xl shadow-2xl border border-gray-600/30 p-8 overflow-hidden">
            <!-- Subtle texture overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-[#67E8ED]/3 via-transparent to-[#4DD0E1]/3 opacity-40"></div>
            <div class="absolute top-0 left-0 w-40 h-40 bg-gradient-to-br from-[#67E8ED]/8 to-transparent rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-32 h-32 bg-gradient-to-tr from-[#4DD0E1]/8 to-transparent rounded-full blur-3xl"></div>
            <div class="relative z-10">
            <form action="{{ route('mahasiswa.survey.submit', $survey->id_master_survey) }}" method="POST" class="space-y-8">
                @csrf
            
            @foreach($survey->detilSurvey as $index => $pertanyaan)
                <div class="relative bg-black/20 backdrop-blur-sm rounded-xl border border-gray-500/30 p-6 hover:border-[#67E8ED]/50 transition-all duration-300">
                    <!-- Question number indicator -->
                    <div class="absolute top-4 right-4 w-10 h-10 bg-gradient-to-br from-[#67E8ED]/30 to-[#4DD0E1]/20 rounded-full border border-[#67E8ED]/40 flex items-center justify-center backdrop-blur-sm">
                        <span class="text-[#67E8ED] font-bold text-sm">{{ $index + 1 }}</span>
                    </div>
                    
                    <div class="relative z-10">
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-100 mb-3 pr-12 leading-relaxed">
                                {{ $pertanyaan->pertanyaan }}
                                @if($pertanyaan->wajib_diisi)
                                    <span class="inline-flex items-center ml-2 px-2 py-1 bg-red-500/20 border border-red-400/30 rounded-full text-red-300 text-xs font-medium backdrop-blur-sm">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        Wajib
                                    </span>
                                @endif
                            </h3>
                            <div class="h-0.5 w-full bg-[#67E8ED]/30 rounded-full"></div>
                        </div>
                    
                        <div class="space-y-4">
                            @php
                                $opsiJawaban = $pertanyaan->opsi_jawaban ?? [];
                                $fieldName = 'jawaban[' . $pertanyaan->id_detil_survey . ']';
                            @endphp
                            
                            @if($pertanyaan->tipe_pertanyaan === 'text')
                                <div class="relative">
                                    <input type="text" 
                                           name="{{ $fieldName }}" 
                                           class="w-full px-4 py-3 bg-black/20 backdrop-blur-sm border border-gray-500/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#67E8ED]/50 focus:border-[#67E8ED]/50 text-gray-100 placeholder-gray-400 transition-all duration-300 hover:border-[#67E8ED]/70"
                                           placeholder="Masukkan jawaban Anda..."
                                           {{ $pertanyaan->wajib_diisi ? 'required' : '' }}>
                                </div>
                            
                            @elseif($pertanyaan->tipe_pertanyaan === 'textarea')
                                <div class="relative">
                                    <textarea name="{{ $fieldName }}" 
                                              rows="4" 
                                              class="w-full px-4 py-3 bg-black/20 backdrop-blur-sm border border-gray-500/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#67E8ED]/50 focus:border-[#67E8ED]/50 text-gray-100 placeholder-gray-400 transition-all duration-300 hover:border-[#67E8ED]/70 resize-none"
                                              placeholder="Masukkan jawaban Anda..."
                                              {{ $pertanyaan->wajib_diisi ? 'required' : '' }}></textarea>
                                </div>
                            
                            @elseif($pertanyaan->tipe_pertanyaan === 'radio')
                                <div class="space-y-3">
                                    @foreach($opsiJawaban as $opsi)
                                        <label class="flex items-center space-x-4 cursor-pointer group p-3 rounded-lg bg-black/10 backdrop-blur-sm border border-gray-500/30 hover:border-[#67E8ED]/40 hover:bg-black/30 peer-checked:bg-[#67E8ED]/20 peer-checked:border-[#67E8ED] peer-checked:shadow-lg peer-checked:shadow-[#67E8ED]/20 transition-all duration-300">
                                            <div class="relative">
                                                <input type="radio" 
                                                       name="{{ $fieldName }}" 
                                                       value="{{ $opsi['value'] }}" 
                                                       class="peer sr-only"
                                                       {{ $pertanyaan->wajib_diisi ? 'required' : '' }}>
                                                <div class="w-6 h-6 border-2 border-[#67E8ED]/60 rounded-full group-hover:border-[#67E8ED] peer-checked:border-[#67E8ED] peer-checked:bg-[#67E8ED]/40 peer-checked:shadow-lg peer-checked:shadow-[#67E8ED]/40 transition-all duration-300 flex items-center justify-center">
                                                    <div class="w-3 h-3 bg-white rounded-full opacity-0 scale-0 transition-all duration-300 peer-checked:opacity-100 peer-checked:scale-100 peer-checked:shadow-md"></div>
                                                </div>
                                            </div>
                                            <span class="text-gray-200 group-hover:text-gray-100 peer-checked:text-white peer-checked:font-semibold transition-all duration-300 font-medium">{{ $opsi['label'] }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            
                            @elseif($pertanyaan->tipe_pertanyaan === 'checkbox')
                                <div class="space-y-3">
                                    @foreach($opsiJawaban as $opsi)
                                        <label class="flex items-center space-x-4 cursor-pointer group p-3 rounded-lg bg-black/10 backdrop-blur-sm border border-gray-500/30 hover:border-[#67E8ED]/40 hover:bg-black/30 peer-checked:bg-[#67E8ED]/20 peer-checked:border-[#67E8ED] peer-checked:shadow-lg peer-checked:shadow-[#67E8ED]/20 transition-all duration-300">
                                            <div class="relative">
                                                <input type="checkbox" 
                                                       name="{{ $fieldName }}[]" 
                                                       value="{{ $opsi['value'] }}" 
                                                       class="peer sr-only">
                                                <div class="w-6 h-6 border-2 border-[#67E8ED]/60 rounded group-hover:border-[#67E8ED] peer-checked:border-[#67E8ED] peer-checked:bg-[#67E8ED]/40 peer-checked:shadow-lg peer-checked:shadow-[#67E8ED]/40 transition-all duration-300 flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-white opacity-0 scale-0 transition-all duration-300 peer-checked:opacity-100 peer-checked:scale-100 peer-checked:drop-shadow-md" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <span class="text-gray-200 group-hover:text-gray-100 peer-checked:text-white peer-checked:font-semibold transition-all duration-300 font-medium">{{ $opsi['label'] }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            
                            @elseif($pertanyaan->tipe_pertanyaan === 'select')
                                <div class="relative">
                                    <select name="{{ $fieldName }}" 
                                            class="w-full px-4 py-3 bg-black/20 backdrop-blur-sm border border-gray-500/30 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#67E8ED]/50 focus:border-[#67E8ED]/50 text-gray-100 transition-all duration-300 hover:border-[#67E8ED]/70 appearance-none cursor-pointer"
                                            {{ $pertanyaan->wajib_diisi ? 'required' : '' }}>
                                        <option value="" class="bg-gray-800 text-gray-200">Pilih jawaban...</option>
                                        @foreach($opsiJawaban as $opsi)
                                            <option value="{{ $opsi['value'] }}" class="bg-gray-800 text-gray-200">{{ $opsi['label'] }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                        <svg class="w-5 h-5 text-[#67E8ED]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            @endif
                        </div>
                    
                        @error('jawaban.' . $pertanyaan->id_detil_survey)
                            <div class="mt-4 p-3 bg-red-500/10 backdrop-blur-sm border border-red-400/30 rounded-lg">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-red-300 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <p class="text-sm text-red-300 font-medium">{{ $message }}</p>
                                </div>
                            </div>
                        @enderror
                    </div>
                </div>
            @endforeach
            
            <!-- Submit Button -->
            <div class="flex justify-between items-center pt-8 border-t border-gray-600/30">
                <a href="{{ route('mahasiswa.dashboard') }}" 
                   class="group relative px-8 py-4 bg-black/20 backdrop-blur-sm border border-gray-500/30 text-gray-200 rounded-lg hover:border-gray-400/50 hover:text-gray-100 hover:bg-black/30 transition-all duration-300 font-medium">
                    <div class="relative flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </div>
                </a>
                
                <button type="submit" 
                        class="group relative px-8 py-4 bg-gradient-to-r from-[#67E8ED] to-[#4DD0E1] text-white rounded-lg hover:from-[#4DD0E1] hover:to-[#67E8ED] transition-all duration-300 font-medium shadow-lg shadow-[#67E8ED]/20 hover:shadow-xl hover:shadow-[#67E8ED]/30 transform hover:-translate-y-0.5">
                    <div class="relative flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Kirim Survey
                    </div>
                </button>
            </div>
            </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Simple form validation
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const requiredFields = form.querySelectorAll('[required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('border-red-500');
                    } else {
                        field.classList.remove('border-red-500');
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    alert('Mohon lengkapi semua field yang wajib diisi.');
                }
            });
        }
    });
</script>
@endsection