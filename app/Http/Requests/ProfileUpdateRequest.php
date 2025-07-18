<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'nim' => [
                'required',
                'string',
                'max:32',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'nomor_telepon' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'program_studi' => ['required', 'string', 'in:D3 Teknologi Informasi,D3 Keuangan Dan Perbankan,D4 Desain Grafis,D4 Manajemen Perhotelan'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
            'photo' => ['nullable', 'image', 'max:2048', 'mimes:jpeg,png,jpg,gif'],
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
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'nim.required' => 'NIM wajib diisi.',
            'nim.unique' => 'NIM sudah digunakan oleh mahasiswa lain.',
            'program_studi.required' => 'Program studi wajib dipilih.',
            'program_studi.in' => 'Program studi tidak valid.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
            'photo.mimes' => 'Format file harus jpeg, png, jpg, atau gif.',
        ];
    }
}
