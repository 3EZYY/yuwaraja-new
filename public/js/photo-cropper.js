/**
 * Photo Cropper Component
 * Reusable JavaScript component for photo cropping functionality
 */
class PhotoCropper {
    constructor(options = {}) {
        this.options = {
            imageSelector: '#crop-image',
            previewSelectors: {
                small: '#preview-small',
                medium: '#preview-medium'
            },
            aspectRatioButtons: '.aspect-ratio-btn',
            formSelector: '#crop-form',
            croppedImageInput: '#cropped-image',
            defaultAspectRatio: 1,
            cropperOptions: {
                viewMode: 1,
                dragMode: 'move',
                autoCropArea: 0.8,
                restore: false,
                guides: true,
                center: true,
                highlight: false,
                cropBoxMovable: true,
                cropBoxResizable: true,
                toggleDragModeOnDblclick: false
            },
            outputOptions: {
                width: 300,
                height: 300,
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high'
            },
            ...options
        };

        this.cropper = null;
        this.init();
    }

    init() {
        this.initCropper();
        this.bindEvents();
        this.updatePreviews();
    }

    initCropper() {
        const image = document.querySelector(this.options.imageSelector);
        if (!image) {
            console.error('Image element not found');
            return;
        }

        this.cropper = new Cropper(image, {
            ...this.options.cropperOptions,
            aspectRatio: this.options.defaultAspectRatio,
            crop: () => this.updatePreviews()
        });
    }

    bindEvents() {
        // Aspect ratio buttons
        document.querySelectorAll(this.options.aspectRatioButtons).forEach(btn => {
            btn.addEventListener('click', (e) => this.handleAspectRatioChange(e));
        });

        // Form submission
        const form = document.querySelector(this.options.formSelector);
        if (form) {
            form.addEventListener('submit', (e) => this.handleFormSubmit(e));
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => this.handleKeyboardShortcuts(e));
    }

    handleAspectRatioChange(event) {
        const button = event.target;
        const ratio = parseFloat(button.dataset.ratio);

        // Update button styles
        this.updateAspectRatioButtons(button);

        // Set aspect ratio
        if (ratio === 0) {
            this.cropper.setAspectRatio(NaN); // Free aspect ratio
        } else {
            this.cropper.setAspectRatio(ratio);
        }
    }

    updateAspectRatioButtons(activeButton) {
        document.querySelectorAll(this.options.aspectRatioButtons).forEach(btn => {
            btn.classList.remove('bg-teal-500', 'text-black', 'active');
            btn.classList.add('bg-gray-700', 'text-white');
        });

        activeButton.classList.remove('bg-gray-700', 'text-white');
        activeButton.classList.add('bg-teal-500', 'text-black', 'active');
    }

    updatePreviews() {
        if (!this.cropper) return;

        const canvas = this.cropper.getCroppedCanvas();
        if (!canvas) return;

        // Update small preview
        const smallPreview = document.querySelector(this.options.previewSelectors.small);
        if (smallPreview) {
            const smallCanvas = this.cropper.getCroppedCanvas({ width: 64, height: 64 });
            if (smallCanvas) {
                smallPreview.src = smallCanvas.toDataURL();
            }
        }

        // Update medium preview
        const mediumPreview = document.querySelector(this.options.previewSelectors.medium);
        if (mediumPreview) {
            const mediumCanvas = this.cropper.getCroppedCanvas({ width: 128, height: 128 });
            if (mediumCanvas) {
                mediumPreview.src = mediumCanvas.toDataURL();
            }
        }
    }

    handleFormSubmit(event) {
        event.preventDefault();

        if (!this.cropper) {
            console.error('Cropper not initialized');
            return;
        }

        const canvas = this.cropper.getCroppedCanvas(this.options.outputOptions);
        
        if (!canvas) {
            console.error('Failed to get cropped canvas');
            return;
        }

        // Show loading state
        this.setLoadingState(true);

        canvas.toBlob((blob) => {
            if (!blob) {
                console.error('Failed to create blob');
                this.setLoadingState(false);
                return;
            }

            const reader = new FileReader();
            reader.onload = () => {
                const croppedImageInput = document.querySelector(this.options.croppedImageInput);
                if (croppedImageInput) {
                    croppedImageInput.value = reader.result;
                    event.target.submit();
                }
            };
            reader.onerror = () => {
                console.error('Failed to read blob');
                this.setLoadingState(false);
            };
            reader.readAsDataURL(blob);
        }, 'image/jpeg', 0.9);
    }

    handleKeyboardShortcuts(event) {
        if (!this.cropper) return;

        switch(event.key) {
            case 'Enter':
                if (event.ctrlKey || event.metaKey) {
                    event.preventDefault();
                    const form = document.querySelector(this.options.formSelector);
                    if (form) form.dispatchEvent(new Event('submit'));
                }
                break;
            case 'Escape':
                event.preventDefault();
                window.history.back();
                break;
            case '1':
                if (event.ctrlKey || event.metaKey) {
                    event.preventDefault();
                    this.setAspectRatio(1);
                }
                break;
        }
    }

    setAspectRatio(ratio) {
        if (this.cropper) {
            this.cropper.setAspectRatio(ratio);
            
            // Update button state
            const button = document.querySelector(`[data-ratio="${ratio}"]`);
            if (button) {
                this.updateAspectRatioButtons(button);
            }
        }
    }

    setLoadingState(loading) {
        const submitButton = document.querySelector('button[type="submit"]');
        if (submitButton) {
            if (loading) {
                submitButton.disabled = true;
                submitButton.innerHTML = `
                    <svg class="animate-spin w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Menyimpan...
                `;
            } else {
                submitButton.disabled = false;
                submitButton.innerHTML = `
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Foto
                `;
            }
        }
    }

    destroy() {
        if (this.cropper) {
            this.cropper.destroy();
            this.cropper = null;
        }
    }

    reset() {
        if (this.cropper) {
            this.cropper.reset();
            this.updatePreviews();
        }
    }

    rotate(degree) {
        if (this.cropper) {
            this.cropper.rotate(degree);
        }
    }

    zoom(ratio) {
        if (this.cropper) {
            this.cropper.zoom(ratio);
        }
    }
}

// Auto-initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector('#crop-image')) {
        window.photoCropper = new PhotoCropper();
    }
});