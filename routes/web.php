<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaDashboardController;
use App\Http\Controllers\SpvDashboardController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\Api\ValidationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// API Routes untuk validasi real-time
Route::get('/api/check-username', [ValidationController::class, 'checkUsername']);
Route::get('/api/check-email', [ValidationController::class, 'checkEmail']);

Route::get('/', function () {
    return view('welcome');
});

// Redirect dashboard berdasarkan role
Route::get('/dashboard', function () {
    $user = Auth::user();
    
    if (!$user) {
        return redirect('/login');
    }
    
    return match($user->role) {
        'admin' => redirect('/admin/dashboard'),  // Ke Filament admin panel
        'spv' => redirect('/spv/dashboard'),
        'mahasiswa' => redirect('/mahasiswa/dashboard'),
        default => redirect('/login')
    };
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes untuk SPV
Route::middleware(['auth', 'verified', 'role:spv'])->prefix('spv')->name('spv.')->group(function () {
    Route::get('/dashboard', [SpvDashboardController::class, 'index'])->name('dashboard');
    Route::get('/kelompok', [SpvDashboardController::class, 'kelompok'])->name('kelompok');
    Route::get('/tugas-review', [SpvDashboardController::class, 'tugasReview'])->name('tugas-review');
});

// Routes untuk MAHASISWA
Route::middleware(['auth', 'verified', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/dashboard', [MahasiswaDashboardController::class, 'index'])->name('dashboard');
    Route::get('/tugas/{tugas}', [MahasiswaDashboardController::class, 'showTugas'])->name('tugas.show');
    Route::post('/tugas/{tugas}/submit', [MahasiswaDashboardController::class, 'submitTugas'])->name('tugas.submit');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// API validation routes
Route::prefix('api')->group(function () {
    Route::get('/validate-username', [ValidationController::class, 'validateUsername'])->name('validate.username');
    Route::get('/validate-email', [ValidationController::class, 'validateEmail'])->name('validate.email');
});

require __DIR__.'/auth.php';
