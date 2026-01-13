<?php

use App\Http\Controllers\Frontsite\DivisiKompetisiController;
use App\Http\Controllers\Backsite\DashboardController;
use App\Http\Controllers\Frontsite\PengumumanController;
use App\Http\Controllers\Frontsite\StatistikController;
use App\Http\Controllers\Frontsite\ProvinsiController;
use App\Http\Controllers\Frontsite\PesertaController;
use App\Http\Controllers\Frontsite\SekolahController;
use App\Http\Controllers\Frontsite\TentangController;
use App\Http\Controllers\Frontsite\UnduhanController;
use App\Http\Controllers\Frontsite\BeritaController;
use App\Http\Controllers\Frontsite\GaleriController;
use App\Http\Controllers\Frontsite\JadwalController;
use App\Http\Controllers\Frontsite\VideoController;
use App\Http\Controllers\Frontsite\HomeController;
use App\Http\Controllers\Frontsite\FaqController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index'])->name('index');

// Auth::routes();
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.auth');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('sinkronisasi/{regCode}/{compCode}', [LoginController::class, 'storeSinkron'])->name('login.store-sinkron');

// Route::name('frontsite.')->middleware('pbh')->group(function () {
    // Tentang
    // Route::get('tentang', [TentangController::class, 'index'])->name('tentang.index');

    // Divisi Kompetisi
    // Route::get('divisi-kompetisi', [DivisiKompetisiController::class, 'index'])->name('divisi-kompetisi.index');
    // Route::get('divisi-kompetisi/{slug}', [DivisiKompetisiController::class, 'show'])->name('divisi-kompetisi.show');

    // Pengumuman
    // Route::get('pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
    // Route::get('pengumuman/{slug}', [PengumumanController::class, 'show'])->name('pengumuman.show');
    
    // Berita
    // Route::get('berita', [BeritaController::class, 'index'])->name('berita.index');
    // Route::get('berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

    // Galeri
    // Route::get('galeri', [GaleriController::class, 'index'])->name('galeri.index');
    // Route::get('galeri/{slug}', [GaleriController::class, 'show'])->name('galeri.show');

    // Video
    // Route::get('video', [VideoController::class, 'index'])->name('video.index');
    // Route::get('video/{slug}', [VideoController::class, 'show'])->name('video.show');

    // Jadwal
    // Route::get('jadwal', [JadwalController::class, 'index'])->name('jadwal.index');

    // FAQ
    // Route::get('faq', [FaqController::class, 'index'])->name('faq.index');
    // Route::get('faq/{id}', [FaqController::class, 'show'])->name('faq.show');

    // Unduhan
    // Route::get('unduhan', [UnduhanController::class, 'index'])->name('unduhan.index');

    // Statistik
//     Route::get('statistik', [StatistikController::class, 'index'])->name('statistik.index');
//     Route::get('get-total', [StatistikController::class, 'getTotal'])->name('statistik.get-total');
//     Route::get('get-tim-divisi', [StatistikController::class, 'getTimDivisi'])->name('statistik.get-tim-divisi');
//     Route::get('tim-provinsi-dtable', [StatistikController::class, 'dtableTimProvinsi'])->name('statistik.dtable-tim-provinsi');

//     Route::get('peserta', [PesertaController::class, 'index'])->name('peserta.index');
//     Route::get('peserta-dtable', [PesertaController::class, 'dtable'])->name('peserta.dtable');

//     Route::get('sekolah', [SekolahController::class, 'index'])->name('sekolah.index');
//     Route::get('sekolah-dtable', [SekolahController::class, 'dtable'])->name('sekolah.dtable');
//     Route::get('sekolah/show/{id}', [SekolahController::class, 'show'])->name('sekolah.show');

//     Route::get('provinsi', [ProvinsiController::class, 'index'])->name('provinsi.index');
//     Route::get('provinsi-dtable', [ProvinsiController::class, 'dtable'])->name('provinsi.dtable');
//     Route::get('provinsi-dtable-kab-kota', [ProvinsiController::class, 'dtableKabKota'])->name('provinsi.dtable-kab-kota');
//     Route::get('provinsi/show/{id}', [ProvinsiController::class, 'show'])->name('provinsi.show');
// });