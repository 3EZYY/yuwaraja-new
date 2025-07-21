
<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpvProfileController;
use App\Http\Controllers\MahasiswaDashboardController;
use App\Http\Controllers\SpvDashboardController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\MahasiswaTugasController;
use App\Http\Controllers\MahasiswaPengumumanController;
use App\Http\Controllers\MahasiswaJadwalController;
use App\Http\Controllers\Api\ValidationController;
use App\Http\Controllers\SpvTugasController;
use App\Http\Controllers\SpvClusterController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\SpvAbsensiController;
use App\Models\Faq;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Join Kelompok untuk Mahasiswa
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/join-kelompok', [\App\Http\Controllers\JoinKelompokController::class, 'showForm'])->name('mahasiswa.join-kelompok');
    Route::post('/mahasiswa/join-kelompok', [\App\Http\Controllers\JoinKelompokController::class, 'join'])->name('mahasiswa.join-kelompok.submit');
    Route::post('/mahasiswa/leave-kelompok', [\App\Http\Controllers\JoinKelompokController::class, 'leave'])->name('mahasiswa.leave-kelompok');
});

// API Routes untuk validasi real-time
Route::get('/api/check-username', [ValidationController::class, 'checkUsername']);
Route::get('/api/check-email', [ValidationController::class, 'checkEmail']);

// Route untuk scan QR Code absensi (publik)
Route::get('/absensi/scan/{qrCode}', [AbsensiController::class, 'scan'])->name('absensi.scan');

Route::get('/', function () {
    $faqs = Faq::active()->ordered()->get();
    return view('welcome', compact('faqs'));
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

// Routes untuk SPV
Route::middleware(['auth', 'verified', 'role:spv'])->prefix('spv')->name('spv.')->group(function () {
    Route::get('/dashboard', [SpvDashboardController::class, 'index'])->name('dashboard');
    Route::get('/cluster', [SpvClusterController::class, 'index'])->name('cluster.index');
    Route::post('/cluster/upload-photo', [SpvClusterController::class, 'uploadPhoto'])->name('cluster.upload-photo');
    Route::delete('/cluster/delete-photo', [SpvClusterController::class, 'deletePhoto'])->name('cluster.delete-photo');
    Route::get('/tugas', [SpvTugasController::class, 'index'])->name('tugas.index');
    Route::get('/tugas/{id}', [SpvTugasController::class, 'show'])->name('tugas.show');
    Route::get('/tugas/pengumpulan/{id}', [SpvTugasController::class, 'showPengumpulan'])->name('tugas.pengumpulan.show');
    Route::post('/tugas/{id}/approve', [SpvTugasController::class, 'approve'])->name('tugas.approve');
    Route::get('/pengumpulan', [SpvTugasController::class, 'pengumpulan'])->name('pengumpulan.index');
    Route::get('/pengumuman', [SpvDashboardController::class, 'pengumuman'])->name('pengumuman.index');
    Route::get('/pengumuman/{pengumuman}', [SpvDashboardController::class, 'showPengumuman'])->name('pengumuman.detail');
    Route::get('/jadwal/{jadwal}', [SpvDashboardController::class, 'showJadwal'])->name('jadwal.detail');
    
    // Absensi Routes untuk SPV
    Route::controller(SpvAbsensiController::class)->prefix('absensi')->name('absensi.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'show')->name('show');
        Route::get('/{id}/export', 'export')->name('export');
    });
    
    // Profile Routes untuk SPV
    Route::get('/profile', [SpvProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [SpvProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/crop-photo', [ProfileController::class, 'cropPhoto'])->name('profile.crop-photo');
    Route::post('/profile/crop-photo', [ProfileController::class, 'saveCroppedPhoto'])->name('profile.save-cropped-photo');
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

    // Absensi Routes untuk Mahasiswa
    Route::controller(AbsensiController::class)->prefix('absensi')->name('absensi.')->group(function () {
        Route::get('/history', 'history')->name('history');
        Route::get('/current', 'current')->name('current');
    });

    // Friendship Routes
    Route::controller(FriendshipController::class)->prefix('cluster')->name('friendship.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/send', 'sendRequest')->name('send');
        Route::post('/accept/{id}', 'acceptRequest')->name('accept');
        Route::post('/reject/{id}', 'rejectRequest')->name('reject');
        Route::delete('/remove/{id}', 'removeFriend')->name('remove');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/upload-photo', [ProfileController::class, 'uploadPhoto'])->name('profile.upload-photo');
    Route::get('/profile/crop-photo', [ProfileController::class, 'cropPhoto'])->name('profile.crop-photo');
    Route::post('/profile/crop-photo', [ProfileController::class, 'saveCroppedPhoto'])->name('profile.save-cropped-photo');
});

// API validation routes
Route::prefix('api')->group(function () {
    Route::get('/validate-username', [ValidationController::class, 'validateUsername'])->name('validate.username');
    Route::get('/validate-email', [ValidationController::class, 'validateEmail'])->name('validate.email');
});

require __DIR__.'/auth.php';
