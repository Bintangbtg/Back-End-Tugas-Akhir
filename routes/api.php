<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\kompetisiController;
use App\Http\Controllers\TeamController;


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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::prefix('profiles')->group(function () {
    Route::get('/', [ProfileController::class, 'getAll']); // Route untuk mengambil semua profil
    Route::post('/tambah', [ProfileController::class, 'tambah']); // Route untuk menambahkan profil baru
    Route::get('/{id}', [ProfileController::class, 'show']); // Route untuk menampilkan detail profil berdasarkan ID
    Route::put('/update/{id}', [ProfileController::class, 'update']); // Route untuk memperbarui profil berdasarkan ID
    Route::delete('/delete/{id}', [ProfileController::class, 'delete']); // Route untuk menghapus profil berdasarkan ID
});

Route::prefix('kompetisi')->group(function () {
    Route::get('/', [KompetisiController::class, 'getall']);
    Route::post('/tambah', [KompetisiController::class, 'tambah']);
    Route::get('/{id}', [KompetisiController::class, 'show']);
    Route::put('/update/{id}', [KompetisiController::class, 'update']);
    Route::delete('/hapus/{id}', [KompetisiController::class, 'hapus']);
});

Route::prefix('team')->group(function () {
    Route::get('/', [TeamController::class, 'index']);
    Route::post('/tambah', [TeamController::class, 'store']);
    Route::get('/{id}', [TeamController::class, 'show']);
    Route::put('/update/{id}', [TeamController::class, 'update']);
    Route::delete('/hapus/{id}', [TeamController::class, 'destroy']);
});
