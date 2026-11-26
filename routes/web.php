<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HousekeeperController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:6,1')->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegistration'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    // ===== Modul A: Master Kamar (Je) =====
    // Tambahkan route Master Kamar di bagian ini.

    // ===== Modul B: Data Penghuni (Jdm) =====
    // Tambahkan route Data Penghuni di bagian ini.

    // ===== Modul C: Housekeeper (Iq) =====
    // Tambahkan route Housekeeper di bagian ini.
    // ===== Modul C: Housekeeper (Iq) =====
    Route::get('/housekeepers', [HousekeeperController::class, 'index'])
        ->middleware('role:admin,penghuni')
        ->name('housekeepers.index');
    Route::resource('housekeepers', HousekeeperController::class)
        ->except('index')
        ->middleware('role:admin');
    // ===== Modul D: Inventaris Aset (Sas) =====
    Route::get('/', [AssetController::class, 'index'])
        ->middleware('role:admin,housekeeper,penghuni')
        ->name('assets.index');
    Route::resource('assets', AssetController::class)
        ->except('index')
        ->middleware('role:admin');
});
