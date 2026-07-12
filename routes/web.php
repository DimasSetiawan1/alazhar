<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\InfaqController;
use App\Http\Controllers\JadwalSholatController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ArtikelAdminController;
use App\Http\Controllers\Admin\InfaqAdminController;
use App\Http\Controllers\Admin\InventarisController;
use App\Http\Controllers\Admin\GaleriController;

// ─── PUBLIC ROUTES ──────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/artikel/{id}', [ArtikelController::class, 'show'])->name('artikel.show');
Route::get('/infaq', [InfaqController::class, 'index'])->name('infaq.index');
Route::get('/infaq/export-pdf', [InfaqController::class, 'exportPdf'])->name('infaq.export-pdf');
Route::post('/infaq/konfirmasi', [InfaqController::class, 'konfirmasi'])->name('infaq.konfirmasi');
Route::get('/jadwal-sholat', [JadwalSholatController::class, 'index'])->name('jadwal-sholat');

// ─── AUTH ROUTES ─────────────────────────────────────────
Route::get('/admin/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/admin/logout', [LoginController::class, 'logout'])->name('logout');

// ─── ADMIN ROUTES (protected) ────────────────────────────
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Artikel
    Route::get('artikel', [ArtikelAdminController::class, 'index'])->name('artikel.index');
    Route::get('artikel/create', [ArtikelAdminController::class, 'create'])->name('artikel.create');
    Route::post('artikel', [ArtikelAdminController::class, 'store'])->name('artikel.store');
    Route::get('artikel/{artikel}/edit', [ArtikelAdminController::class, 'edit'])->name('artikel.edit');
    Route::put('artikel/{artikel}', [ArtikelAdminController::class, 'update'])->name('artikel.update');
    Route::delete('artikel/{artikel}', [ArtikelAdminController::class, 'destroy'])->name('artikel.destroy');

    // Infaq
    Route::get('infaq', [InfaqAdminController::class, 'index'])->name('infaq.index');
    Route::post('infaq', [InfaqAdminController::class, 'store'])->name('infaq.store');
    Route::patch('infaq/{infaq}/confirm', [InfaqAdminController::class, 'confirm'])->name('infaq.confirm');
    Route::delete('infaq/{infaq}', [InfaqAdminController::class, 'destroy'])->name('infaq.destroy');

    // Inventaris
    Route::get('inventaris', [InventarisController::class, 'index'])->name('inventaris.index');
    Route::get('inventaris/create', [InventarisController::class, 'create'])->name('inventaris.create');
    Route::post('inventaris', [InventarisController::class, 'store'])->name('inventaris.store');
    Route::get('inventaris/{inventaris}/edit', [InventarisController::class, 'edit'])->name('inventaris.edit');
    Route::put('inventaris/{inventaris}', [InventarisController::class, 'update'])->name('inventaris.update');
    Route::delete('inventaris/{inventaris}', [InventarisController::class, 'destroy'])->name('inventaris.destroy');

    // Galeri
    Route::get('galeri', [GaleriController::class, 'index'])->name('galeri.index');
    Route::post('galeri', [GaleriController::class, 'store'])->name('galeri.store');
    Route::delete('galeri/{galeri}', [GaleriController::class, 'destroy'])->name('galeri.destroy');
});
