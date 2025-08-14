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
            'email_student' => ['nullable', 'string', 'lowercase', 'email', 'max:255'],
            'nim' => [
                'required',
                'string',
                'max:32',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'angkatan' => ['nullable', 'string', 'in:2023,2024,2025'],
            'nomor_telepon' => ['nullable', 'string', 'max:20'],
            'tempat_lahir' => ['nullable', 'string', 'max:100'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => ['nullable', 'string', 'in:Laki-Laki,Perempuan'],
            'agama' => ['nullable', 'string', 'in:Islam,Kristen Protestan,Katolik,Hindu,Buddha,Khonghucu,Kepercayaan'],
            'asal_sekolah_jenis' => ['nullable', 'string', 'in:SMA,SMK,MAN,Lainnya'],
            'asal_sekolah_nama' => ['nullable', 'string', 'max:255'],
            'jurusan_sekolah' => ['nullable', 'string', 'max:255'],
            'asal_kota' => ['nullable', 'string', 'max:100'],
            'provinsi' => ['nullable', 'string', 'max:100'],
            'kota' => ['nullable', 'string', 'in:Kota,Kabupaten'],
            'jalur_masuk' => ['nullable', 'string', 'in:SNBP,SNBT,Mandiri UB,Mandiri Vokasi'],
            'address' => ['nullable', 'string', 'max:500'],
            'program_studi' => ['required', 'string', 'in:D4 Manajemen Perhotelan,D3 Keuangan dan Perbankan,D3 Administrasi Bisnis,D4 Desain Grafis,D3 Teknologi Informasi'],
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
            'email_student.email' => 'Format email student tidak valid.',
            'nim.required' => 'NIM wajib diisi.',
            'nim.unique' => 'NIM sudah digunakan oleh mahasiswa lain.',
            'angkatan.in' => 'Angkatan harus dipilih dari tahun yang tersedia.',
            'tempat_lahir.max' => 'Tempat lahir maksimal 100 karakter.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'jenis_kelamin.in' => 'Jenis kelamin harus dipilih.',
            'asal_sekolah_jenis.in' => 'Jenis sekolah tidak valid.',
            'asal_sekolah_nama.max' => 'Nama sekolah maksimal 255 karakter.',
            'jurusan_sekolah.max' => 'Jurusan sekolah maksimal 255 karakter.',
            'asal_kota.max' => 'Asal kota maksimal 100 karakter.',
            'provinsi.max' => 'Provinsi maksimal 100 karakter.',
            'kota.in' => 'Kota/Kabupaten harus dipilih dari daftar yang tersedia.',
            'jalur_masuk.in' => 'Jalur masuk tidak valid.',
            'program_studi.required' => 'Program studi wajib dipilih.',
            'program_studi.in' => 'Program studi tidak valid.',
            'photo.image' => 'File harus berupa gambar.',
            'photo.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
            'photo.mimes' => 'Format file harus jpeg, png, jpg, atau gif.',
        ];
    }
}
