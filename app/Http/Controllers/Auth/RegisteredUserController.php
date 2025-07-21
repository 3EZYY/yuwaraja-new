<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nim' => [
                'required', 
                'string', 
                'min:15',
                'max:16',
                'regex:/^(23|24|25)\d{13,14}$/',
                'unique:'.User::class
            ], // Wajib diisi saat register
            'username' => [
                'required', 
                'string', 
                'max:255', 
                'regex:/^[a-zA-Z0-9]+$/',
                'unique:'.User::class
            ],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:'.User::class,
                // ATURAN BARU DI SINI
                function ($attribute, $value, $fail) {
                    if (!(str_ends_with($value, '@gmail.com') || str_ends_with($value, '@student.ub.ac.id'))) {
                        $fail('Alamat email harus menggunakan @gmail.com atau @student.ub.ac.id.');
                    }
                }
            ],
            'email_student' => ['nullable', 'string', 'lowercase', 'email', 'max:255'],
            'program_studi' => ['required', 'string', 'max:255'],
            'angkatan' => ['required', 'string', 'in:2023,2024,2025'],
            'nomor_telepon' => ['required', 'string', 'max:255'], // Tambahan 'required'
            'tanggal_lahir' => ['required', 'date'], // Tambahan 'required'
            'jenis_kelamin' => ['required', 'string', 'in:Laki-laki,Perempuan'], // Tambahan 'required'
            'asal_sekolah_jenis' => ['required', 'string', 'in:SMA,SMK,MAN,Lainnya'],
            'asal_sekolah_nama' => ['required', 'string', 'max:255'],
            'jurusan_sekolah' => ['nullable', 'string', 'max:255'],
            'asal_kota' => ['required', 'string', 'max:255'],
            'alamat_domisili' => ['required', 'string'],
            'provinsi' => ['required', 'string', 'max:255'],
            'kota' => ['required', 'string', 'max:255'],
            'jalur_masuk' => ['required', 'string', 'in:SNBP,SNBT,Mandiri UB,Mandiri Vokasi'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            // Custom error messages
            'name.required' => 'Nama lengkap wajib diisi!',
            'nim.required' => 'NIM wajib diisi!',
            'nim.min' => 'NIM minimal 15 digit.',
            'nim.max' => 'NIM maksimal 16 digit.',
            'nim.regex' => 'NIM harus dimulai dengan 23, 24, atau 25 dan terdiri dari 15-16 digit.',
            'nim.unique' => 'NIM sudah terdaftar!',
            'username.required' => 'Username wajib diisi!',
            'username.regex' => 'Username hanya boleh menggunakan huruf dan angka (tanpa simbol)!',
            'username.unique' => 'Username sudah dipakai nih!',
            'email.required' => 'Email wajib diisi!',
            'email.unique' => 'Email sudah dipakai nih!',
            'email_student.email' => 'Format email student tidak valid.',
            'program_studi.required' => 'Program studi wajib dipilih!',
            'angkatan.required' => 'Angkatan wajib diisi!',
            'angkatan.in' => 'Angkatan hanya boleh 2023, 2024, atau 2025.',
            'nomor_telepon.required' => 'Nomor WhatsApp wajib diisi!',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi!',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih!',
            'asal_sekolah_jenis.required' => 'Asal sekolah wajib dipilih!',
            'asal_sekolah_nama.required' => 'Nama sekolah wajib diisi!',
            'asal_kota.required' => 'Asal kota wajib diisi!',
            'alamat_domisili.required' => 'Alamat domisili wajib diisi!',
            'provinsi.required' => 'Provinsi wajib diisi!',
            'kota.required' => 'Kota domisili wajib diisi!',
            'jalur_masuk.required' => 'Jalur masuk wajib dipilih!',
            'password.required' => 'Password wajib diisi!',
            'password.confirmed' => 'Konfirmasi password tidak cocok!',
        ]);

        $user = User::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'username' => $request->username,
            'email' => $request->email,
            'email_student' => $request->email_student,
            'program_studi' => $request->program_studi,
            'angkatan' => $request->angkatan,
            'nomor_telepon' => $request->nomor_telepon,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'asal_sekolah_jenis' => $request->asal_sekolah_jenis,
            'asal_sekolah_nama' => $request->asal_sekolah_nama,
            'jurusan_sekolah' => $request->jurusan_sekolah,
            'asal_kota' => $request->asal_kota,
            'alamat_domisili' => $request->alamat_domisili,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'jalur_masuk' => $request->jalur_masuk,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa', 
        ]);

        event(new Registered($user));

        // Tidak auto-login, redirect ke halaman login
        return redirect()->route('login')->with('status', 'Registrasi berhasil! Silakan login dengan akun yang baru dibuat.');
    }
}
