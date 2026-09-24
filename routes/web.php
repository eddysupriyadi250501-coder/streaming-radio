<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\CustomLoginController;


Route::get('/admin/login', [CustomLoginController::class, 'showLogin'])->name('filament.admin.auth.login');
Route::post('/login-proses', [CustomLoginController::class, 'loginProses']);
Route::get('/login', function () {
    return redirect()->route('filament.admin.auth.login');
})->name('login');

// 1. Landing Page (Cukup satu saja)
Route::get('/', [LandingController::class, 'index'])->name('landing');

// 2. Berita
Route::get('/berita', [LandingController::class, 'indexBerita'])->name('berita.index');
Route::get('/berita/{slug}', [LandingController::class, 'showBerita'])->name('berita.detail');

// 3. Tentang Kami
Route::get('/tentang-kami', function () { return view('tentang'); })->name('tentang');

// 4. Penyiar, Creative, Wisata, UMKM, Sekolah
Route::get('/penyiar/{id}', [LandingController::class, 'showPenyiar'])->name('penyiar.detail');
Route::get('/creative-district', [LandingController::class, 'indexCreativeDistrict'])->name('creative-district.index');
Route::get('/creative-district/{id}', [LandingController::class, 'showCreativeDistrict'])->name('creative-district.show');
Route::get('/wisata', [LandingController::class, 'indexWisata'])->name('wisata.index');
Route::get('/wisata/{id}', [LandingController::class, 'showWisata'])->name('wisata.show');
Route::get('/umkm', [LandingController::class, 'indexUmkm'])->name('umkm.index');
Route::get('/umkm/{id}', [LandingController::class, 'showUmkm'])->name('umkm.show');
Route::get('/layanan-publik', [LandingController::class, 'indexLayanan'])->name('layanan.index');
Route::get('/layanan-publik/{id}', [LandingController::class, 'showLayanan'])->name('layanan.show');
Route::get('/sekolah-kita', [LandingController::class, 'indexSekolah'])->name('sekolah.index');
Route::get('/sekolah-kita/{id}', [LandingController::class, 'showSekolah'])->name('sekolah.show');

// 5. DONOR DARAH
Route::get('/donor-darah', [LandingController::class, 'indexDonorDarah'])->name('donor.index');
Route::post('/permintaan-darah', [PermintaanController::class, 'store'])->name('permintaan.store');
