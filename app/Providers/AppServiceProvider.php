<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Eager load kelompok relationship for authenticated users
        Auth::macro('userWithKelompok', function () {
            $user = Auth::user();
            if ($user && !$user->relationLoaded('kelompok')) {
                $user->load(['kelompok.users', 'kelompok.anggota']);
            }
            return $user;
        });
    }
}
