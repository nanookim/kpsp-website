<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ChildApiController;
use App\Http\Controllers\Api\SetPertanyaanApiController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/ping', fn () => response()->json(['message' => 'API OK']));

// Public routes
Route::post('/register', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);

// Protected routes (Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);

    // Children routes
    Route::apiResource('children', ChildApiController::class);
});
Route::apiResource('set-pertanyaan', SetPertanyaanApiController::class);
Route::get('/set-pertanyaan/{id}/pertanyaan', [SetPertanyaanApiController::class, 'pertanyaan']);
Route::post('/set-pertanyaan/{id_set}/jawaban', [SetPertanyaanApiController::class, 'submitJawaban']);
Route::get('/set-pertanyaan/riwayat/{id_anak}', [SetPertanyaanApiController::class, 'riwayat']);
Route::get('/reset-password', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->name('password.update');




