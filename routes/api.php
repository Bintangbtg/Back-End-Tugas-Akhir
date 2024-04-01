<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\ProfileController;

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