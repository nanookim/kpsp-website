<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

Route::get('/ping', fn () => response()->json(['message' => 'API OK']));

Route::apiResource('pengguna', UserController::class);
Route::post('/register', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);

