<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'email' => ['required', 'email'],
    ]);

    $email = $request->input('email');
    
    // Cek apakah email ada di field 'email' atau 'email_student'
    $user = \App\Models\User::where('email', $email)
                           ->orWhere('email_student', $email)
                           ->first();
    
    if (!$user) {
        return back()->withErrors(['email' => 'Email tidak ditemukan dalam sistem.']);
    }
    
    // Tentukan field email mana yang cocok untuk reset password
    $resetEmail = $user->email === $email ? 'email' : 'email_student';
    
    // Kirim reset link dengan email yang tepat
    $status = Password::sendResetLink([
        $resetEmail => $email
    ]);

    return $status == Password::RESET_LINK_SENT
                ? back()->with('status', __($status))
                : back()->withInput($request->only('email'))
                    ->withErrors(['email' => __($status)]);
}
}
