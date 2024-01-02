<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AplikasiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KategoriAssetWallpaperController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Aplikasi
    Route::get('/aplikasi', [AplikasiController::class,'index'])->name('aplikasi.index');
    Route::get('/aplikasi/tambah', [AplikasiController::class,'create'])->name('aplikasi.create');
    Route::post('/aplikasi/tambah/store', [AplikasiController::class,'store'])->name('aplikasi.store');
    Route::get('/aplikasi/show/{id}', [AplikasiController::class,'show'])->name('aplikasi.show');
    Route::post('/aplikasi/edit/{id}', [AplikasiController::class,'store'])->name('aplikasi.edit');
    Route::delete('/aplikasi/destroy/{id}', [AplikasiController::class,'destroy'])->name('aplikasi.destroy');
    // Kategori
    Route::get('/kategori', [KategoriController::class,'index'])->name('kategori.index');
    Route::post('/kategori/tambah/store', [KategoriController::class,'store'])->name('kategori.store');
    // Assets
    Route::get('/assets', [KategoriAssetWallpaperController::class,'index'])->name('assets.index');
    Route::get('/assets/kategori/{id}', [KategoriAssetWallpaperController::class,'getSubcategoriesApiBlade']);
    Route::post('/assets/tambah/store', [KategoriAssetWallpaperController::class,'storeAssets'])->name('assets.store');
});

require __DIR__.'/auth.php';
