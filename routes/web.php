<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KpspSetPertanyaanController;
use App\Http\Controllers\KpspPertanyaanController;
use App\Http\Controllers\KpspSkriningController;
use App\Http\Controllers\KpspJawabanController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\KpspUserController;
Route::get('/', function () {
    return view('welcome');
});
Route::resource('users', UserController::class);
Route::resource('children', ChildController::class);
Route::resource('kpsp-set', KpspSetPertanyaanController::class);

Route::resource('kpsp-skrining', KpspSkriningController::class);
Route::resource('kpsp-jawaban', KpspJawabanController::class);
Route::resource('kpsp-set', KpspSetPertanyaanController::class);
Route::post('kpsp-set/import', [KpspSetPertanyaanController::class, 'import'])->name('kpsp-set.import');
// route untuk download template (harus didefinisikan sebelum resource!)
Route::get('kpsp-pertanyaan/template', [KpspPertanyaanController::class, 'template'])
    ->name('kpsp-pertanyaan.template');

Route::post('kpsp-pertanyaan/import', [KpspPertanyaanController::class, 'import'])
    ->name('kpsp-pertanyaan.import');
Route::resource('kpsp-pertanyaan', KpspPertanyaanController::class);

Route::get('/kpsp', [KpspUserController::class, 'index'])->name('kpsp.index'); // pilih set
Route::get('/kpsp/{id_set}', [KpspUserController::class, 'show'])->name('kpsp.show'); // tampil pertanyaan
Route::post('/kpsp/{id_set}', [KpspUserController::class, 'store'])->name('kpsp.store'); // simpan jawaban







