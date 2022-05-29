<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\AuthController;
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

Route::middleware(['guest'])->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('auth.showLogin');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
});

Route::group(['middleware' => ['auth']], function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/guru', [DashboardController::class, 'index'])->name('guru.index');
        Route::get('/jadwal', [DashboardController::class, 'index'])->name('jadwal.index');
        Route::get('/siswa', [DashboardController::class, 'index'])->name('siswa.index');
        Route::resource('kelas', KelasController::class);
        Route::resource('jurusan', JurusanController::class);
    });
});
