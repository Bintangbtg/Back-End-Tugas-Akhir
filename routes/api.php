<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\kompetisiController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\API\ProccesPaymentController;
use App\Http\Controllers\VerifyPaymentController;
use App\Http\Controllers\DaftarkompetisiController;
use App\Http\Controllers\FeedbackController;


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
    Route::get('/', [kompetisiController::class, 'getall']);
    Route::post('/tambah', [kompetisiController::class, 'tambah']);
    Route::get('/{id}', [kompetisiController::class, 'show']);
    Route::put('/update/{id}', [kompetisiController::class, 'update']);
    Route::delete('/hapus/{id}', [kompetisiController::class, 'hapus']);
});

Route::prefix('team')->group(function () {
    Route::get('/', [TeamController::class, 'index']);
    Route::post('/tambah', [TeamController::class, 'store']);
    Route::get('/{id}', [TeamController::class, 'show']);
    Route::put('/update/{id}', [TeamController::class, 'update']);
    Route::delete('/hapus/{id}', [TeamController::class, 'destroy']);
});

Route::post('procces-payment',[ProccesPaymentController::class, 'invoke']);
Route::post('verify-payment', [VerifyPaymentController::class, 'index']);

Route::prefix('daftar')->group(function () {
    Route::get('/', [DaftarkompetisiController::class, 'index']);
    Route::post('/tambah', [DaftarkompetisiController::class, 'store']);
    Route::get('/{id}', [DaftarkompetisiController::class, 'show']);
    Route::put('/update/{id}', [DaftarkompetisiController::class, 'update']);
    Route::delete('/hapus/{id}', [DaftarkompetisiController::class, 'destroy']);
});

Route::post('/tambahdaftar', [DaftarkompetisiController::class, 'store']);

Route::get('/feedback', [FeedbackController::class, 'index']);
Route::post('/createfeedback', [FeedbackController::class, 'store']);
Route::get('/feedback/{id}', [FeedbackController::class, 'show']);
Route::put('/feedback/{id}', [FeedbackController::class, 'update']);
Route::delete('/feedback/{id}', [FeedbackController::class, 'destroy']);