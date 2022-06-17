<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\MataPelajaranController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\Admin\TahunAkademikController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Guru\JadwalController as GuruJadwalController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest:admin', 'guest:guru'])->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('auth.showLogin');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
});


Route::group(['middleware' => ['auth:guru']], function () {
    Route::group(['prefix' => 'guru'], function () {
        Route::post('logout', [AuthController::class, 'guruLogout'])->name('auth.gurulogout');
        Route::get('/home', [GuruJadwalController::class, 'index'])->name('guru.home');
        Route::get('/jadwal', [GuruJadwalController::class, 'jadwal'])->name('guru.listJadwal');
        Route::get('/jadwal/detail', [GuruJadwalController::class, 'list'])->name('guru.detailJadwal');
    });
});


Route::group(['middleware' => ['auth:admin']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/action', [DashboardController::class, 'action'])->name('dashboard.action');
    // Route::group(['prefix' => 'admin'], function () {
        Route::post('logout', [AuthController::class, 'adminLogout'])->name('auth.adminlogout');
        // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/guru/pengajar/{id}', [GuruController::class, 'pengajar'])->name('guru.pengajar');
        Route::post('/guru/pengajar/simpanmapel', [GuruController::class, 'simpanmapel'])->name('guru.simpanmapel');
        Route::delete('/guru/pengajar/delete/{id}', [GuruController::class, 'hapusmapel'])->name('guru.hapusmapel');
        Route::get('/jadwal/list', [JadwalController::class, 'list'])->name('jadwal.list');
        Route::resource('jadwal', JadwalController::class);
        Route::resource('siswa', SiswaController::class);
        Route::resource('guru', GuruController::class);
        Route::resource('kelas', KelasController::class);
        Route::resource('jurusan', JurusanController::class);
        Route::resource('tahun-akademik', TahunAkademikController::class);
        Route::resource('mapel', MataPelajaranController::class);
    // });
});
