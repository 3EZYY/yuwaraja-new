@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white dark:bg-gray-900 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6 mb-6">
            <div class="flex items-center gap-3 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 8l2 2 4-4" />
                </svg>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $survey->judul_survey }}</h1>
            </div>
            
            @if($survey->deskripsi_survey)
                <p class="text-gray-600 dark:text-gray-300 mb-4">{{ $survey->deskripsi_survey }}</p>
            @endif
            
            <div class="flex flex-wrap gap-4 text-sm text-gray-500 dark:text-gray-400">
                <div class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>Periode: {{ $survey->tanggal_mulai->format('d M Y') }} - {{ $survey->tanggal_selesai->format('d M Y') }}</span>
                </div>
                <div class="flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>{{ $survey->detilSurvey->count() }} Pertanyaan</span>
                </div>
            </div>
        </div>

        <!-- Survey Form -->
        <form action="{{ route('mahasiswa.survey.submit', $survey->id_master_survey) }}" method="POST" class="space-y-6">
            @csrf
            
            @foreach($survey->detilSurvey as $index => $pertanyaan)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                            {{ $index + 1 }}. {{ $pertanyaan->pertanyaan }}
                            @if($pertanyaan->wajib_diisi)
                                <span class="text-red-500">*</span>
                            @endif
                        </h3>
                    </div>
                    
                    <div class="space-y-3">
                        @php
                            $opsiJawaban = $pertanyaan->opsi_jawaban ?? [];
                            $fieldName = 'jawaban[' . $pertanyaan->id_detil_survey . ']';
                        @endphp
                        
                        @if($pertanyaan->tipe_pertanyaan === 'text')
                            <input type="text" 
                                   name="{{ $fieldName }}" 
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 dark:bg-gray-700 dark:text-white"
                                   {{ $pertanyaan->wajib_diisi ? 'required' : '' }}>
                        
                        @elseif($pertanyaan->tipe_pertanyaan === 'textarea')
                            <textarea name="{{ $fieldName }}" 
                                      rows="4" 
                                      class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 dark:bg-gray-700 dark:text-white"
                                      {{ $pertanyaan->wajib_diisi ? 'required' : '' }}></textarea>
                        
                        @elseif($pertanyaan->tipe_pertanyaan === 'radio')
                            @foreach($opsiJawaban as $opsi)
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="radio" 
                                           name="{{ $fieldName }}" 
                                           value="{{ $opsi['value'] }}" 
                                           class="text-purple-500 focus:ring-purple-500"
                                           {{ $pertanyaan->wajib_diisi ? 'required' : '' }}>
                                    <span class="text-gray-700 dark:text-gray-300">{{ $opsi['label'] }}</span>
                                </label>
                            @endforeach
                        
                        @elseif($pertanyaan->tipe_pertanyaan === 'checkbox')
                            @foreach($opsiJawaban as $opsi)
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" 
                                           name="{{ $fieldName }}[]" 
                                           value="{{ $opsi['value'] }}" 
                                           class="text-purple-500 focus:ring-purple-500">
                                    <span class="text-gray-700 dark:text-gray-300">{{ $opsi['label'] }}</span>
                                </label>
                            @endforeach
                        
                        @elseif($pertanyaan->tipe_pertanyaan === 'select')
                            <select name="{{ $fieldName }}" 
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 dark:bg-gray-700 dark:text-white"
                                    {{ $pertanyaan->wajib_diisi ? 'required' : '' }}>
                                <option value="">Pilih jawaban...</option>
                                @foreach($opsiJawaban as $opsi)
                                    <option value="{{ $opsi['value'] }}">{{ $opsi['label'] }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                    
                    @error('jawaban.' . $pertanyaan->id_detil_survey)
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            @endforeach
            
            <!-- Submit Button -->
            <div class="flex justify-between items-center pt-6">
                <a href="{{ route('mahasiswa.dashboard') }}" 
                   class="px-6 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    Kembali
                </a>
                
                <button type="submit" 
                        class="px-8 py-2 bg-purple-500 text-white rounded-md hover:bg-purple-600 transition-colors font-semibold">
                    Kirim Survey
                </button>
            </div>
        </form>
    </div>
</div>
@endsection