
<?php

// Join Kelompok untuk Mahasiswa
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/join-kelompok', [\App\Http\Controllers\JoinKelompokController::class, 'showForm'])->name('mahasiswa.join-kelompok');
    Route::post('/mahasiswa/join-kelompok', [\App\Http\Controllers\JoinKelompokController::class, 'join'])->name('mahasiswa.join-kelompok.submit');
});

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaDashboardController;
use App\Http\Controllers\SpvDashboardController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\MahasiswaTugasController;
use App\Http\Controllers\MahasiswaPengumumanController;
use App\Http\Controllers\MahasiswaJadwalController;
use App\Http\Controllers\Api\ValidationController;
use App\Http\Controllers\SpvTugasController;
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
        'admin' => redirect('/admin/dashboard'),
        'spv' => redirect('/spv/dashboard'),
        'mahasiswa' => redirect('/mahasiswa/dashboard'),
        default => redirect('/login')
    };
})->middleware(['auth', 'verified'])->name('dashboard');


// Routes untuk ADMIN
Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Route logout khusus admin
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');
});
Route::middleware(['auth', 'verified', 'role:spv'])->prefix('spv')->name('spv.')->group(function () {
    Route::get('/dashboard', [SpvDashboardController::class, 'index'])->name('dashboard');
    Route::get('/kelompok', [SpvDashboardController::class, 'kelompok'])->name('kelompok');
    Route::get('/tugas-review', [SpvDashboardController::class, 'tugasReview'])->name('tugas-review');
    Route::get('/pengumuman/{pengumuman}', [SpvDashboardController::class, 'showPengumuman'])->name('pengumuman.detail');
    Route::get('/jadwal/{jadwal}', [SpvDashboardController::class, 'showJadwal'])->name('jadwal.detail');

    // Tambahan: fitur review tugas mahasiswa
    Route::get('/tugas-mahasiswa', [SpvTugasController::class, 'index'])->name('tugas-mahasiswa.index');
    Route::get('/tugas-mahasiswa/{id}', [SpvTugasController::class, 'show'])->name('tugas-mahasiswa.show');
    Route::post('/tugas-mahasiswa/{id}/approve', [SpvTugasController::class, 'approve'])->name('tugas-mahasiswa.approve');
});

// Routes untuk MAHASISWA
Route::middleware(['auth', 'verified', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [MahasiswaDashboardController::class, 'index'])->name('dashboard');

    // Tugas Routes
    Route::controller(MahasiswaTugasController::class)->group(function () {
        Route::get('/tugas', 'index')->name('tugas.index');
        Route::get('/tugas/{tugas}', 'show')->name('tugas.show');
        Route::get('/tugas/{tugas}/kerjakan', 'kerjakan')->name('tugas.kerjakan');
        Route::post('/tugas/{tugas}/submit', 'submit')->name('tugas.submit');
    });

    // Pengumuman Routes
    Route::controller(MahasiswaPengumumanController::class)->group(function () {
        Route::get('/pengumuman', 'index')->name('pengumuman.index');
        Route::get('/pengumuman/{pengumuman}', 'show')->name('pengumuman.detail');
    });

    // Jadwal Routes
    Route::controller(MahasiswaJadwalController::class)->group(function () {
        Route::get('/jadwal', 'index')->name('jadwal.index');
        Route::get('/jadwal/{jadwal}', 'show')->name('jadwal.detail');
    });
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
