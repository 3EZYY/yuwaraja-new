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
                'size:15',
                'regex:/^(23|24|25)\d{13}$/',
                'unique:'.User::class
            ], // Wajib diisi saat register
            'username' => [
                'required', 
                'string', 
                'max:255', 
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
            'program_studi' => ['required', 'string', 'max:255'],
            'angkatan' => ['required', 'string', 'in:2023,2024,2025'],
            'nomor_telepon' => ['required', 'string', 'max:255'], // Tambahan 'required'
            'tanggal_lahir' => ['required', 'date'], // Tambahan 'required'
            'jenis_kelamin' => ['required', 'string', 'in:Laki-laki,Perempuan'], // Tambahan 'required'
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            // Custom error messages
            'name.required' => 'Nama lengkap wajib diisi!',
            'nim.required' => 'NIM wajib diisi!',
            'nim.size' => 'NIM harus terdiri dari 15 digit.',
            'nim.regex' => 'NIM harus dimulai dengan 23, 24, atau 25 dan terdiri dari 15 digit.',
            'nim.unique' => 'NIM sudah terdaftar!',
            'username.required' => 'Username wajib diisi!',
            'username.unique' => 'Username sudah dipakai nih!',
            'email.required' => 'Email wajib diisi!',
            'email.unique' => 'Email sudah dipakai nih!',
            'program_studi.required' => 'Program studi wajib dipilih!',
            'angkatan.required' => 'Angkatan wajib diisi!',
            'angkatan.in' => 'Angkatan hanya boleh 2023, 2024, atau 2025.',
            'nomor_telepon.required' => 'Nomor telepon wajib diisi!',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi!',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih!',
            'password.required' => 'Password wajib diisi!',
            'password.confirmed' => 'Konfirmasi password tidak cocok!',
        ]);

        $user = User::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'username' => $request->username,
            'email' => $request->email,
            'program_studi' => $request->program_studi,
            'angkatan' => $request->angkatan,
            'nomor_telepon' => $request->nomor_telepon,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa', 
        ]);

        event(new Registered($user));

        // Tidak auto-login, redirect ke halaman login
        return redirect()->route('login')->with('status', 'Registrasi berhasil! Silakan login dengan akun yang baru dibuat.');
    }
}
