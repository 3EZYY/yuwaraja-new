<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahaDashboardController;
use App\Http\Controllers\TugasController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [MahaDashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

// Route untuk tugas
Route::get('/tugas/{tugas}', [MabaDashboardController::class, 'showTugas'])
    ->middleware(['auth', 'verified'])->name('tugas.show');
Route::post('/tugas/{tugas}/submit', [MabaDashboardController::class, 'submitTugas'])
    ->middleware(['auth', 'verified'])->name('tugas.submit');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
