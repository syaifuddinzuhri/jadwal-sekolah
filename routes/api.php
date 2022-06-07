<?php

use App\Http\Controllers\API\AddressController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('provinces', [AddressController::class, 'getAllProvinces'])->name('provinces');
Route::get('regencies/{id}', [AddressController::class, 'getRegencies'])->name('regencies');
Route::get('districts/{id}', [AddressController::class, 'getDistricts'])->name('districts');
Route::get('villages/{id}', [AddressController::class, 'getVillages'])->name('villages');
