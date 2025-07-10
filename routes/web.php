<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaDashboardController;
use App\Http\Controllers\SpvDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\TugasController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
        'admin' => redirect('/admin/dashboard'),
        'spv' => redirect('/spv/dashboard'),
        'mahasiswa' => redirect('/mahasiswa/dashboard'),
        default => redirect('/login')
    };
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes untuk ADMIN
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminDashboardController::class, 'users'])->name('users');
    Route::get('/kelompok', [AdminDashboardController::class, 'kelompok'])->name('kelompok');
    Route::get('/tugas', [AdminDashboardController::class, 'tugas'])->name('tugas');
    Route::get('/pengumuman', [AdminDashboardController::class, 'pengumuman'])->name('pengumuman');
    Route::get('/jadwal', [AdminDashboardController::class, 'jadwal'])->name('jadwal');
});

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

require __DIR__.'/auth.php';
