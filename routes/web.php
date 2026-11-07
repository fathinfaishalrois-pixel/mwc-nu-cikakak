<?php

use App\Http\Controllers\Admin\AgendaController as AdminAgendaController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\InfakController as AdminInfakController;
use App\Http\Controllers\Admin\OrganisasiController as AdminOrganisasiController;
use App\Http\Controllers\Admin\WargaNuController as AdminWargaNuController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\KegiatanController as AdminKegiatanController;
use App\Http\Controllers\Admin\PengurusController as AdminPengurusController;
use App\Http\Controllers\PublicBeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\WargaNuPageController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\TentangController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/tentang', TentangController::class)->name('tentang');
Route::get('/kepengurusan', [PengurusController::class, 'index'])->name('pengurus.index');
Route::get('/kepengurusan/{slug}', [PengurusController::class, 'show'])->name('pengurus.show');
Route::get('/berita', [PublicBeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [PublicBeritaController::class, 'show'])->name('berita.show');
Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('kegiatan.index');
Route::get('/kegiatan/{slug}', [KegiatanController::class, 'show'])->name('kegiatan.show');
Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
Route::get('/galeri/{galeri}', [GaleriController::class, 'show'])->name('galeri.show');
Route::get('/kontak', KontakController::class)->name('kontak');
Route::get('/warga-nu', [AnggotaController::class, 'create'])->name('warga-nu.index');
Route::get('/daftar-anggota', fn () => redirect()->route('warga-nu.index'))->name('anggota.daftar');
Route::post('/warga-nu', [AnggotaController::class, 'store'])->middleware('throttle:5,1')->name('anggota.store');
Route::post('/daftar-anggota', fn (\Illuminate\Http\Request $request) => app(AnggotaController::class)->store($request))->middleware('throttle:5,1');
Route::get('/warga-nu/profil/{token}', [AnggotaController::class, 'profile'])->name('anggota.profil');
Route::post('/warga-nu/profil/{token}/foto', [AnggotaController::class, 'updatePhoto'])->middleware('throttle:10,1')->name('anggota.profil.foto');
Route::get('/anggota/profil/{token}', fn (string $token) => redirect()->route('anggota.profil', ['token' => $token]));

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->middleware('throttle:6,1')->name('login.attempt');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->middleware('auth')->name('logout');
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/', AdminDashboardController::class)->name('dashboard');
        Route::get('/dashboard', AdminDashboardController::class)->name('dashboard.home');
        Route::resource('pengurus', AdminPengurusController::class)->except(['show']);
        Route::resource('berita', AdminBeritaController::class)->except(['show'])->parameters(['berita' => 'berita']);
        Route::resource('kegiatan', AdminKegiatanController::class)->except(['show']);
        Route::resource('galeri', AdminGaleriController::class)->except(['show']);
        Route::resource('agenda', AdminAgendaController::class)->except(['show']);
        Route::resource('organisasi', AdminOrganisasiController::class)->except(['show']);
        Route::resource('warga-nu', AdminWargaNuController::class)->except(['show']);
        Route::patch('/warga-nu/{wargaNu}/approve', [AdminWargaNuController::class, 'approve'])->name('warga-nu.approve');
        Route::patch('/warga-nu/{wargaNu}/reject', [AdminWargaNuController::class, 'reject'])->name('warga-nu.reject');
        Route::patch('/warga-nu/{wargaNu}/deactivate', [AdminWargaNuController::class, 'deactivate'])->name('warga-nu.deactivate');
        Route::get('/infak', [AdminInfakController::class, 'index'])->name('infak.index');
        Route::patch('/infak/{infak}/verify', [AdminInfakController::class, 'verify'])->name('infak.verify');
        Route::delete('/infak/{infak}', [AdminInfakController::class, 'destroy'])->name('infak.destroy');
    });
});
