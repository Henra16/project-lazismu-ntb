<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/avatar', [ProfileController::class, 'deleteAvatar'])->name('profile.avatar.delete');
});

require __DIR__.'/auth.php';

Route::get('/donasi', function () {
    return view('frontend.donasi.index');
})->name('donasi');

Route::get('/program', [App\Http\Controllers\Frontend\ProgramController::class, 'index'])->name('program');

use App\Http\Controllers\Frontend\ProgramController;
use App\Http\Controllers\Frontend\BeritaController;
use App\Http\Controllers\Frontend\TentangController;

Route::get('/program/{slug}', [ProgramController::class, 'show'])->name('program.detail');

// Berita Routes
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

// Tentang Route
Route::get('/tentang', [TentangController::class, 'index'])->name('tentang');

// Laporan Route
use App\Http\Controllers\Frontend\LaporanController;
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

// Donation & Payment Gateway Routes
use App\Http\Controllers\Frontend\DonationController;
use App\Http\Controllers\Frontend\TrackingController;

Route::post('/donasi', [DonationController::class, 'store'])->name('donasi.store');

// Tripay Callback — dikecualikan dari CSRF di bootstrap/app.php
Route::post('/payment/tripay/callback', [DonationController::class, 'tripayCallback'])
    ->name('payment.tripay.callback');

Route::get('/donasi/selesai', [DonationController::class, 'finish'])->name('donasi.finish');
Route::get('/donasi/tertunda', [DonationController::class, 'unfinish'])->name('donasi.unfinish');
Route::get('/donasi/gagal', [DonationController::class, 'error'])->name('donasi.error');
Route::get('/donasi/manual/{uuid}', [DonationController::class, 'manualInstructions'])->name('donasi.manual');

Route::middleware('auth')->group(function () {
    Route::get('/donasi/riwayat', [TrackingController::class, 'history'])->name('donasi.history');
});

Route::get('/cek-donasi', [TrackingController::class, 'check'])->name('donasi.check');
Route::post('/cek-donasi', [TrackingController::class, 'search'])->name('donasi.search');
Route::get('/donasi/track/{uuid}', [TrackingController::class, 'track'])->name('donasi.track');
Route::get('/donasi/track/{uuid}/status', [TrackingController::class, 'status'])->name('donasi.status');
Route::post('/donasi/track/{uuid}/cancel', [TrackingController::class, 'cancel'])->name('donasi.cancel');
