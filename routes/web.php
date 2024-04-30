<?php

use App\Http\Controllers\AntreanController;
use App\Http\Controllers\AntreanPanggilController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\LoketController;
use App\Http\Controllers\PemetaanAntreanController;
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
use Illuminate\Database\Eloquent\Builder;
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

//--- Ambil
Route::get('ambil', function (Request $request) {
    $id = $request->input('id');
    $dt = Carbon::now();
    if ($id > 0) {
        $antrean = new Antrean();
        $antrean->lokasi_id = 1;
        $antrean->layanan_id = $id;
        $antrean->tanggal_ambil = $dt->toDateString();
        $antrean->jam_ambil = $dt->toTimeString();
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
    $lokasi_id = (int) $request->input('lokasi_id');
    $layanan_id = (int) $request->input('layanan_id');
    $loket_id = (int) $request->input('loket_id');
    $antrean_id = (int) $request->input('antrean_id');

    $dt = Carbon::now();

    if ($lokasi_id > 0 && $layanan_id > 0 && $loket_id > 0 && $antrean_id > 0) {
        $antrean = Antrean::find($antrean_id);
        $antrean->status = 'memanggil';
        $antrean->save();
        if ($antrean) {
            $antreanPanggil = new AntreanPanggil();
            $antreanPanggil->antrean_id = $antrean_id;
            $antreanPanggil->lokasi_id = $lokasi_id;
            $antreanPanggil->layanan_id = $layanan_id;
            $antreanPanggil->loket_id = $loket_id;
            $antreanPanggil->tanggal_panggil = $dt->toDateString();
            $antreanPanggil->jam_panggil = $dt->toTimeString();
            $antreanPanggil->status = 'memanggil';
            $antreanPanggil->save();
        }
        return redirect()->route(
            'panggil',
            [
                'lokasi_id' => $lokasi_id,
                'layanan_id' => $layanan_id,
                'loket_id' => $loket_id
            ]
        );
    }

    $lokasis = Lokasi::all();
    $layanans = Layanan::where('status', '=', 'aktif')
        ->get();
    $lokets = Loket::all();

    $antrean_menunggu = Antrean::where('status', '=', 'menunggu')
        ->where('lokasi_id', '=', $lokasi_id)
        ->where('layanan_id', '=', $layanan_id)
        ->where('tanggal_ambil', '=', $dt->toDateString())
        ->orderBy('nomor')
        ->take(1)
        ->get();

    $antrean_memanggil = AntreanPanggil::where('status', '=', 'memanggil')
        ->where('lokasi_id', '=', $lokasi_id)
        ->where('layanan_id', '=', $layanan_id)
        ->where('tanggal_panggil', '=', $dt->toDateString())
        ->orderBy('tanggal_panggil')
        ->orderBy('jam_panggil')
        ->get();

    $antrean_selesai = Antrean::where('status', '=', 'selesai')
        ->where('lokasi_id', '=', $lokasi_id)
        ->where('layanan_id', '=', $layanan_id)
        ->where('tanggal_ambil', '=', $dt->toDateString())
        ->orderBy('tanggal_ambil', 'DESC')
        ->orderBy('jam_ambil', 'DESC')
        ->orderBy('nomor', 'DESC')
        ->get();

    return view('panggil/index', compact(
        'lokasis',
        'layanans',
        'lokets',
        'lokasi_id',
        'layanan_id',
        'loket_id',
        'antrean_menunggu',
        'antrean_memanggil',
        'antrean_selesai'
    ));
})->name('panggil');

//--- Selesai Panggil
Route::get('selesai', function (Request $request) {
    $lokasi_id = (int) $request->input('lokasi_id');
    $layanan_id = (int) $request->input('layanan_id');
    $loket_id = (int) $request->input('loket_id');
    $antrean_panggil_id = (int) $request->input('antrean_panggil_id');
    if ($lokasi_id > 0 && $layanan_id > 0 && $loket_id > 0 && $antrean_panggil_id > 0) {
        $antrean_panggil = AntreanPanggil::find($antrean_panggil_id);
        $antrean_panggil->status = 'selesai';
        $antrean_panggil->save();
        if ($antrean_panggil) {
            $antrean = Antrean::find($antrean_panggil->antrean_id);
            $antrean->status = 'selesai';
            $antrean->save();
        }
    }
    return redirect()->route('panggil', [
        'lokasi_id' => $lokasi_id,
        'layanan_id' => $layanan_id,
        'loket_id' => $loket_id
    ]);
})->name('selesai');

//--- Tampil
Route::get('tampil', function (Request $request) {
    $layanans = Layanan::where('status', '=', 'aktif')
        ->get();
    return view('tampil/index', compact('layanans'));
})->name('tampil');


//--- Admin
Route::prefix('admin')->group(function () {
    //--- Index
    Route::get('/', function () {
        return view('admin/index');
    })->name('admin.index');

    //--- Dashboard
    Route::get('/dashboard', function () {
        return view('admin/dashboard');
    })->name('admin.dashboard');

    //--- Master
    Route::prefix('master')->group(function () {
        //--- Lokasi
        Route::prefix('lokasi')->group(function () {
            Route::get('/', [LokasiController::class, 'index'])->name('admin.lokasi.index');
            Route::get('/create', [LokasiController::class, 'create'])->name('admin.lokasi.create');
            Route::post('/', [LokasiController::class, 'store'])->name('admin.lokasi.store');
            Route::get('/{lokasi}', [LokasiController::class, 'show'])->name('admin.lokasi.show');
            Route::get('/{lokasi}/edit', [LokasiController::class, 'edit'])->name('admin.lokasi.edit');
            Route::put('/{lokasi}', [LokasiController::class, 'update'])->name('admin.lokasi.update');
            Route::delete('/{lokasi}', [LokasiController::class, 'destroy'])->name('admin.lokasi.destroy');
        });

        //--- Layanan
        Route::prefix('layanan')->group(function () {
            Route::get('/', [LayananController::class, 'index'])->name('admin.layanan.index');
            Route::get('/create', [LayananController::class, 'create'])->name('admin.layanan.create');
            Route::post('/', [LayananController::class, 'store'])->name('admin.layanan.store');
            Route::get('/{layanan}', [LayananController::class, 'show'])->name('admin.layanan.show');
            Route::get('/{layanan}/edit', [LayananController::class, 'edit'])->name('admin.layanan.edit');
            Route::put('/{layanan}', [LayananController::class, 'update'])->name('admin.layanan.update');
            Route::delete('/{layanan}', [LayananController::class, 'destroy'])->name('admin.layanan.destroy');
        });

        //--- Loket
        Route::prefix('loket')->group(function () {
            Route::get('/', [LoketController::class, 'index'])->name('admin.loket.index');
            Route::get('/create', [LoketController::class, 'create'])->name('admin.loket.create');
            Route::post('/', [LoketController::class, 'store'])->name('admin.loket.store');
            Route::get('/{loket}', [LoketController::class, 'show'])->name('admin.loket.show');
            Route::get('/{loket}/edit', [LoketController::class, 'edit'])->name('admin.loket.edit');
            Route::put('/{loket}', [LoketController::class, 'update'])->name('admin.loket.update');
            Route::delete('/{loket}', [LoketController::class, 'destroy'])->name('admin.loket.destroy');
        });

        //--- Pemetaan Antrean
        Route::prefix('pemetaan-antrean')->group(function () {
            Route::get('/', [PemetaanAntreanController::class, 'index'])->name('admin.pemetaan-antrean.index');
            Route::get('/create', [PemetaanAntreanController::class, 'create'])->name('admin.pemetaan-antrean.create');
            Route::post('/', [PemetaanAntreanController::class, 'store'])->name('admin.pemetaan-antrean.store');
            Route::get('/{pemetaanAntrean}', [PemetaanAntreanController::class, 'show'])->name('admin.pemetaan-antrean.show');
            Route::get('/{pemetaanAntrean}/edit', [PemetaanAntreanController::class, 'edit'])->name('admin.pemetaan-antrean.edit');
            Route::put('/{pemetaanAntrean}', [PemetaanAntreanController::class, 'update'])->name('admin.pemetaan-antrean.update');
            Route::delete('/{pemetaanAntrean}', [PemetaanAntreanController::class, 'destroy'])->name('admin.pemetaan-antrean.destroy');
        });
    });
});
