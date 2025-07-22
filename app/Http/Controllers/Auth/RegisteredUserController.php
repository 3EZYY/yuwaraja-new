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
                'unique:' . User::class
            ], // NIM 15-16 digit dengan awalan 23/24/25
            'username' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9]+$/',
                'unique:' . User::class
            ],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class,
                // ATURAN BARU DI SINI
                function ($attribute, $value, $fail) {
                    if (!(str_ends_with($value, '@gmail.com') || str_ends_with($value, '@student.ub.ac.id'))) {
                        $fail('Alamat email harus menggunakan @gmail.com');
                    }
                }
            ],
            'email_student' => [
                'nullable',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class,
                // ATURAN BARU DI SINI
                function ($attribute, $value, $fail) {
                    if ($value && !str_ends_with($value, '@student.ub.ac.id')) {
                        $fail('Alamat email harus menggunakan @student.ub.ac.id');
                    }
                }
            ],
            'program_studi' => ['required', 'string', 'max:255'],
            'angkatan' => ['required', 'string', 'in:2023,2024,2025'],
            'nomor_telepon' => ['required', 'string', 'max:255'], // Tambahan 'required'
            'tempat_lahir' => ['required', 'string', 'max:255'], // Tambahan field tempat lahir
            'tanggal_lahir' => ['required', 'date'], // Tambahan 'required'
            'jenis_kelamin' => ['required', 'string', 'in:Laki-laki,Perempuan'], // Tambahan 'required'
            'asal_sekolah_jenis' => ['required', 'string', 'in:SMA,SMK,MAN,Lainnya'],
            'asal_sekolah_nama' => ['required', 'string', 'max:255'],
            'jurusan_sekolah' => ['nullable', 'string', 'max:255'],
            'asal_kota' => ['required', 'string', 'max:255'],
            'alamat_domisili' => ['required', 'string'],
            'provinsi' => ['required', 'string', 'max:255'],
            'kota' => ['required', 'string', 'in:Kota,Kabupaten'],
            'jalur_masuk' => ['required', 'string', 'in:SNBP,SNBT,Mandiri UB,Mandiri Vokasi'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,jpg,png,svg', 'max:5120'], // 5MB max
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            // Custom error messages
            'name.required' => 'Nama lengkap wajib diisi!',
            'nim.required' => 'NIM wajib diisi!',
            'nim.min' => 'NIM minimal 15 digit.',
            'nim.max' => 'NIM maksimal 16 digit.',
            'nim.regex' => 'NIM harus 15-16 digit dan dimulai dengan 23, 24, atau 25.',
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
            'tempat_lahir.required' => 'Tempat lahir wajib diisi!',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi!',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih!',
            'asal_sekolah_jenis.required' => 'Asal sekolah wajib dipilih!',
            'asal_sekolah_nama.required' => 'Nama sekolah wajib diisi!',
            'asal_kota.required' => 'Asal kota wajib diisi!',
            'alamat_domisili.required' => 'Alamat domisili wajib diisi!',
            'provinsi.required' => 'Provinsi wajib diisi!',
            'kota.required' => 'Kota/Kabupaten wajib dipilih!',
            'kota.in' => 'Pilihan hanya boleh Kota atau Kabupaten.',
            'jalur_masuk.required' => 'Jalur masuk wajib dipilih!',
            'photo.image' => 'File harus berupa gambar!',
            'photo.mimes' => 'Format foto harus JPEG, JPG, PNG, atau SVG!',
            'photo.max' => 'Ukuran foto maksimal 5MB!',
            'password.required' => 'Password wajib diisi!',
            'password.confirmed' => 'Konfirmasi password tidak cocok!',
        ]);

        // Handle photo upload
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = 'profile_' . time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
            
            // Create directory if it doesn't exist
            $uploadPath = public_path('profile-pictures');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            // Move the uploaded file
            $photo->move($uploadPath, $photoName);
            $photoPath = $photoName;
        }

        $user = User::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'username' => $request->username,
            'email' => $request->email,
            'email_student' => $request->email_student,
            'program_studi' => $request->program_studi,
            'angkatan' => $request->angkatan,
            'nomor_telepon' => $request->nomor_telepon,
            'tempat_lahir' => $request->tempat_lahir,
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
            'photo' => $photoPath,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa',
        ]);

        event(new Registered($user));

        // Tidak auto-login, redirect ke halaman login
        return redirect()->route('login')->with('status', 'Registrasi berhasil! Silakan login dengan akun yang baru dibuat.');
    }
}
