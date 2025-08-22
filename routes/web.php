<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KpspSetPertanyaanController;
use App\Http\Controllers\KpspPertanyaanController;
use App\Http\Controllers\KpspSkriningController;
use App\Http\Controllers\KpspJawabanController;
use App\Http\Controllers\ChildController;
Route::get('/', function () {
    return view('welcome');
});
Route::resource('users', UserController::class);
Route::resource('children', ChildController::class);
Route::resource('kpsp-set', KpspSetPertanyaanController::class);
Route::resource('kpsp-pertanyaan', KpspPertanyaanController::class);
Route::resource('kpsp-skrining', KpspSkriningController::class);
Route::resource('kpsp-jawaban', KpspJawabanController::class);


