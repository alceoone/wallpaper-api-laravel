<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AplikasiWallpaperController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::middleware('auth')->group(function () {
//     Route::get('/kategori/{id}', [KategoriAssetWallpaperController::class,'index'])->name('assets.index');
// });

Route::group(['prefix' => 'v1'], function () {
    Route::get('aplikasi/wallpaper/{key}/home/new', [AplikasiWallpaperController::class, 'getNewView']);

    Route::get('aplikasi/wallpaper/{key}/home/top', [AplikasiWallpaperController::class, 'getTopView']);

    Route::get('aplikasi/wallpaper/{key}/split', [AplikasiWallpaperController::class, 'getPageSplitView']);

    Route::get('aplikasi/wallpaper/{key}/get/all', [AplikasiWallpaperController::class, 'getAllView']);

    // Category
    Route::get('aplikasi/wallpaper/{key}/kategori', [AplikasiWallpaperController::class, 'category']);

    Route::get('aplikasi/wallpaper/kategori/{id}/home/new', [AplikasiWallpaperController::class, 'getKategoriNewView']);

    Route::get('aplikasi/wallpaper/kategori/{id}/home/top', [AplikasiWallpaperController::class, 'getKategoriTopView']);

    Route::get('aplikasi/wallpaper/kategori/{id}/split', [AplikasiWallpaperController::class, 'getKategoriPageSplitView']);

    Route::get('aplikasi/wallpaper/kategori/{id}/get/all', [AplikasiWallpaperController::class, 'getKategoriAllView']);
    
    Route::get('aplikasi/assets/{id}/view', [AplikasiWallpaperController::class, 'viewCountAssets']);
});