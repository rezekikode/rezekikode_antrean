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
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//--- Collection
Route::prefix('collection')->group(function () {
    Route::get('users', function () {
        return new UserCollection(User::all());
    });

    Route::get('lokasi', function () {
        return new LokasiCollection(Lokasi::all());
    });

    Route::get('layanan', function () {
        return new LayananCollection(Layanan::all());
    });

    Route::get('loket', function () {
        return new LoketCollection(Loket::all());
    });

    Route::get('antrean', function () {
        return new AntreanCollection(Antrean::all());
    });

    Route::get('antrean-panggil', function () {
        return new AntreanPanggilCollection(AntreanPanggil::all());
    });
});

//--- Resource
Route::prefix('resource')->group(function () {
    Route::resource('lokasi', LokasiController::class);
    Route::resource('layanan', LayananController::class);
    Route::resource('loket', LoketController::class);
    Route::resource('antrean', AntreanController::class);
    Route::resource('antrean-panggil', AntreanPanggilController::class);
});

//--- Ambil
Route::get('ambil', function (Request $request) {
    $id = $request->input('id');
    $dt = Carbon::now();
    if ($id > 0) {
        $antrean = new Antrean();
        $antrean->layanan_id = $id;
        $antrean->tanggal_ambil = $dt->toDateString();
        $antrean->waktu_ambil = $dt->toTimeString();
        $antrean->nomor = Antrean::where('layanan_id', '=', $id)
            ->where('tanggal_ambil', '=', $dt->toDateString())
            ->max('nomor') + 1;
        $antrean->status = 'menunggu';
        $antrean->save();
        return redirect()->route('ambil');
    }
    $layanans = Layanan::where('status', '=', 'aktif')
        ->get();
    return view('ambil/index', compact('layanans'));
})->name('ambil');

//--- Panggil
Route::get('panggil', function (Request $request) {
    $id = $request->input('id');
    $dt = Carbon::now();
    if ($id > 0) {
        $antrean = Antrean::find($id);
        $antrean->status = 'memanggil';
        $antrean->save();
        if ($antrean) {
            $antreanPanggil = new AntreanPanggil();
            $antreanPanggil->antrean_id = $id;
            $antreanPanggil->loket_id = 1;
            $antreanPanggil->tanggal_panggil = $dt->toDateString();
            $antreanPanggil->waktu_panggil = $dt->toTimeString();
            $antreanPanggil->status = 'memanggil';
            $antreanPanggil->save();
        }
        return redirect()->route('panggil');
    }
    $antreans = Antrean::where('status', '=', 'menunggu')
        ->orderBy('nomor')
        ->get();
    return view('panggil/index', compact('antreans'));
})->name('panggil');
