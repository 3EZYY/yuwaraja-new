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
            'nim' => ['required', 'string', 'unique:'.User::class], // Wajib diisi saat register
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
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
            'angkatan' => ['required', 'string', 'max:255'],
            'nomor_telepon' => ['required', 'string', 'max:255'], // Tambahan 'required'
            'tanggal_lahir' => ['required', 'date'], // Tambahan 'required'
            'jenis_kelamin' => ['required', 'string', 'in:Laki-laki,Perempuan'], // Tambahan 'required'
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
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

        Auth::login($user);

        return redirect()->route('login')->with('status', 'Registrasi berhasil! Silakan login.');
    }
}
