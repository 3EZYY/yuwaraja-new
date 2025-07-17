<?php

namespace App\Http\Requests;

use App\Rules\FileTypeValidation;
use Illuminate\Foundation\Http\FormRequest;

class TugasRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'deadline' => 'required|date',
            'tipe' => 'required|in:individual,kelompok',
            'file_path' => [
                'nullable',
                'file',
                'max:10240', // 10MB
                new FileTypeValidation()
            ],
            'is_active' => 'required|boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'judul.required' => 'Judul tugas harus diisi.',
            'deskripsi.required' => 'Deskripsi tugas harus diisi.',
            'deadline.required' => 'Deadline tugas harus diisi.',
            'deadline.date' => 'Deadline harus berupa tanggal yang valid.',
            'tipe.required' => 'Tipe tugas harus dipilih.',
            'tipe.in' => 'Tipe tugas harus individual atau kelompok.',
            'file_path.file' => 'File yang diupload harus berupa file yang valid.',
            'file_path.max' => 'Ukuran file maksimal 10MB.',
        ];
    }
}
