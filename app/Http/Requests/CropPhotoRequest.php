<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CropPhotoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'cropped_image' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    // Validate base64 image format
                    if (!preg_match('/^data:image\/[a-zA-Z]+;base64,/', $value)) {
                        $fail('Format gambar tidak valid.');
                        return;
                    }

                    // Decode and check if valid
                    $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $value));
                    if ($imageData === false) {
                        $fail('Data gambar tidak dapat didecode.');
                        return;
                    }

                    // Check file size (max 5MB for cropped image)
                    if (strlen($imageData) > 5 * 1024 * 1024) {
                        $fail('Ukuran gambar terlalu besar (maksimal 5MB).');
                    }
                }
            ],
            'original_photo' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    // Check if original photo exists
                    $photoPath = public_path('profile-pictures/' . $value);
                    if (!file_exists($photoPath)) {
                        $fail('Foto asli tidak ditemukan.');
                    }
                }
            ]
        ];
    }

    /**
     * Get custom error messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'cropped_image.required' => 'Data gambar yang di-crop harus ada.',
            'cropped_image.string' => 'Data gambar harus berupa string.',
            'original_photo.required' => 'Informasi foto asli harus ada.',
            'original_photo.string' => 'Nama foto asli harus berupa string.',
            'original_photo.max' => 'Nama foto asli terlalu panjang.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'cropped_image' => 'gambar yang di-crop',
            'original_photo' => 'foto asli',
        ];
    }
}