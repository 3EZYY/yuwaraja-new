@extends('layouts.app')

@section('title', 'Crop Foto Profil')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&family=Poppins:wght@600;700;900&display=swap');
    .font-display { font-family: 'Poppins', sans-serif; }
    .font-body { font-family: 'Kanit', sans-serif; }
    
    .cropper-container {
        max-width: 100%;
        max-height: 400px;
    }
    
    .cropper-view-box,
    .cropper-face {
        border-radius: 50%;
    }
    
    .preview-container {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid #14b8a6;
        background: #1f2937;
    }
    
    .preview-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .aspect-ratio-btn {
        transition: all 0.3s ease;
    }
    
    .aspect-ratio-btn.active {
        background: linear-gradient(135deg, #14b8a6, #0d9488);
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(20, 184, 166, 0.3);
    }
    
    .crop-container {
        background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
        border: 1px solid #374151;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
    }
</style>

<!-- Include Cropper.js CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">

<div class="font-body bg-gray-900 min-h-screen" style="background-image: radial-gradient(circle at top, #1a202c, #0a0f14);">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <!-- Header -->
        <header class="mb-8">
            <div class="flex items-center gap-4 mb-4">
                @if(Auth::user()->role === 'spv')
                <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 hover:bg-gray-700 text-gray-300 rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Profile
                </a>
                @else
                <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 hover:bg-gray-700 text-gray-300 rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Profile
                </a>
                @endif
            </div>
            <div class="text-center">
                <h1 class="font-display text-3xl font-bold text-white mb-2">
                    Crop Foto Profil
                </h1>
                <p class="text-gray-400">
                    Sesuaikan foto profil Anda dengan mengatur posisi dan ukuran yang diinginkan
                </p>
            </div>
        </header>

        <div class="bg-gray-900/50 backdrop-blur-xl p-6 rounded-2xl border border-teal-500/20">
            
            <!-- Kontrol Aspek Rasio -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-300 mb-3">Pilih Aspek Rasio:</label>
                <div class="flex flex-wrap gap-2">
                    <button type="button" class="aspect-ratio-btn px-4 py-2 bg-teal-500 text-black rounded-lg font-semibold transition-all hover:bg-teal-400" data-ratio="1">
                        1:1 (Persegi)
                    </button>
                    <button type="button" class="aspect-ratio-btn px-4 py-2 bg-gray-700 text-white rounded-lg font-semibold transition-all hover:bg-gray-600" data-ratio="1.33">
                        4:3 (Landscape)
                    </button>
                    <button type="button" class="aspect-ratio-btn px-4 py-2 bg-gray-700 text-white rounded-lg font-semibold transition-all hover:bg-gray-600" data-ratio="0.75">
                        3:4 (Portrait)
                    </button>
                    <button type="button" class="aspect-ratio-btn px-4 py-2 bg-gray-700 text-white rounded-lg font-semibold transition-all hover:bg-gray-600" data-ratio="1.78">
                        16:9 (Widescreen)
                    </button>
                    <button type="button" class="aspect-ratio-btn px-4 py-2 bg-gray-700 text-white rounded-lg font-semibold transition-all hover:bg-gray-600" data-ratio="0">
                        Bebas
                    </button>
                </div>
            </div>

            <!-- Area Crop -->
            <div class="mb-6">
                <div class="bg-gray-800 rounded-lg p-4 text-center">
                    <img id="crop-image" src="{{ asset('profile-pictures/' . $user->photo) }}" alt="Foto untuk di-crop" style="max-width: 100%; max-height: 400px;">
                </div>
            </div>

            <!-- Preview -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-300 mb-3">Preview:</label>
                <div class="flex gap-4">
                    <div class="text-center">
                        <p class="text-xs text-gray-400 mb-2">Kecil (64x64)</p>
                        <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-teal-400 mx-auto">
                            <img id="preview-small" src="" alt="Preview Kecil" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div class="text-center">
                        <p class="text-xs text-gray-400 mb-2">Sedang (128x128)</p>
                        <div class="w-32 h-32 rounded-full overflow-hidden border-2 border-teal-400 mx-auto">
                            <img id="preview-medium" src="" alt="Preview Sedang" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form untuk menyimpan -->
            @if(Auth::user()->role === 'spv')
            <form id="crop-form" method="POST" action="{{ route('profile.save-cropped-photo') }}">
            @else
            <form id="crop-form" method="POST" action="{{ route('profile.save-cropped-photo') }}">
            @endif
                @csrf
                <input type="hidden" id="cropped-image" name="cropped_image">
                <input type="hidden" name="original_photo" value="{{ $user->photo }}">
                
                <div class="flex gap-4 justify-center">
                    <a href="{{ route('profile.edit') }}" class="px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-semibold transition-all">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-teal-500 hover:bg-teal-600 text-black rounded-lg font-semibold transition-all">
                        Simpan Foto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include Cropper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const image = document.getElementById('crop-image');
    const previewSmall = document.getElementById('preview-small');
    const previewMedium = document.getElementById('preview-medium');
    const croppedImageInput = document.getElementById('cropped-image');
    const aspectRatioBtns = document.querySelectorAll('.aspect-ratio-btn');
    
    let cropper = new Cropper(image, {
        aspectRatio: 1, // Default 1:1
        viewMode: 1,
        dragMode: 'move',
        autoCropArea: 0.8,
        restore: false,
        guides: true,
        center: true,
        highlight: false,
        cropBoxMovable: true,
        cropBoxResizable: true,
        toggleDragModeOnDblclick: false,
        crop: function(event) {
            updatePreviews();
        }
    });

    // Handle aspect ratio buttons
    aspectRatioBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Update button styles
            aspectRatioBtns.forEach(b => {
                b.classList.remove('bg-teal-500', 'text-black');
                b.classList.add('bg-gray-700', 'text-white');
            });
            this.classList.remove('bg-gray-700', 'text-white');
            this.classList.add('bg-teal-500', 'text-black');
            
            // Set aspect ratio
            const ratio = parseFloat(this.dataset.ratio);
            if (ratio === 0) {
                cropper.setAspectRatio(NaN); // Free aspect ratio
            } else {
                cropper.setAspectRatio(ratio);
            }
        });
    });

    function updatePreviews() {
        const canvas = cropper.getCroppedCanvas();
        if (canvas) {
            // Update previews
            const smallCanvas = cropper.getCroppedCanvas({
                width: 64,
                height: 64
            });
            const mediumCanvas = cropper.getCroppedCanvas({
                width: 128,
                height: 128
            });
            
            if (smallCanvas) {
                previewSmall.src = smallCanvas.toDataURL();
            }
            if (mediumCanvas) {
                previewMedium.src = mediumCanvas.toDataURL();
            }
        }
    }

    // Handle form submission
    document.getElementById('crop-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const canvas = cropper.getCroppedCanvas({
            width: 300,
            height: 300,
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high'
        });
        
        if (canvas) {
            canvas.toBlob(function(blob) {
                const reader = new FileReader();
                reader.onload = function() {
                    croppedImageInput.value = reader.result;
                    document.getElementById('crop-form').submit();
                };
                reader.readAsDataURL(blob);
            }, 'image/jpeg', 0.9);
        }
    });

    // Initial preview update
    setTimeout(updatePreviews, 500);
});
</script>

@endsection