<?php

use App\Http\Controllers\AntreanController;
use App\Http\Controllers\AntreanPanggilController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\LoketController;
use App\Http\Resources\AntreanCollection;
use App\Http\Resources\AntreanPanggilCollection;
use App\Http\Resources\LayananCollection;
use App\Http\Resources\LokasiCollection;
use App\Http\Resources\LoketCollection;
use App\Http\Resources\UserCollection;
use App\Models\Antrean;
use App\Models\AntreanPanggil;
use App\Models\Layanan;
use App\Models\Lokasi;
use App\Models\Loket;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/collection/users', function () {
    return new UserCollection(User::all());
});

Route::get('/collection/lokasi', function () {
    return new LokasiCollection(Lokasi::all());
});

Route::get('/collection/layanan', function () {
    return new LayananCollection(Layanan::all());
});

Route::get('/collection/loket', function () {
    return new LoketCollection(Loket::all());
});

Route::get('/collection/antrean', function () {
    return new AntreanCollection(Antrean::all());
});

Route::get('/collection/antrean-panggil', function () {
    return new AntreanPanggilCollection(AntreanPanggil::all());
});

Route::resource('/resource/lokasi', LokasiController::class);
Route::resource('/resource/layanan', LayananController::class);
Route::resource('/resource/loket', LoketController::class);
Route::resource('/resource/antrean', AntreanController::class);
Route::resource('/resource/antrean-panggil', AntreanPanggilController::class);