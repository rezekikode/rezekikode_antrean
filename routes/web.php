<?php

use App\Http\Controllers\AntreanController;
use App\Http\Controllers\CustomAuthController;
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
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//--- Auth
Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::post('login', [CustomAuthController::class, 'authenticate'])->name('login');
Route::post('logout', [CustomAuthController::class, 'logout'])->name('logout');

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

    //--- profil
    Route::get('/profil', function () {
        return view('admin/profil');
    })->name('admin.profil');

    //--- profil update
    Route::put('/profil', [CustomAuthController::class, 'updateProfil'])->name('admin.profil.update');

    //--- Dashboard
    Route::get('/dashboard', function () {
        $dt = Carbon::now();
        $totalAntrean = Antrean::where('tanggal_ambil', '=', $dt->toDateString())->count();
        $totalAntreanMenunggu = Antrean::where('status', '=', 'menunggu')
            ->where('tanggal_ambil', '=', $dt->toDateString())
            ->count();
        $totalAntreanMemanggil = Antrean::where('status', '=', 'memanggil')
            ->where('tanggal_ambil', '=', $dt->toDateString())
            ->count();
        $totalAntreanSelesai = Antrean::where('status', '=', 'selesai')
            ->where('tanggal_ambil', '=', $dt->toDateString())
            ->count();
        return view(
            'admin/dashboard',
            compact(
                'totalAntrean',
                'totalAntreanMenunggu',
                'totalAntreanMemanggil',
                'totalAntreanSelesai'
            )
        );
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

    //--- Transaksi
    Route::prefix('transaksi')->group(function () {
        //--- Antrean
        Route::prefix('antrean')->group(function () {
            Route::get('/', [AntreanController::class, 'index'])->name('admin.antrean.index');
            Route::get('/create', [AntreanController::class, 'create'])->name('admin.antrean.create');
            Route::post('/', [AntreanController::class, 'store'])->name('admin.antrean.store');
            Route::get('/{antrean}', [AntreanController::class, 'show'])->name('admin.antrean.show');
            Route::get('/{antrean}/edit', [AntreanController::class, 'edit'])->name('admin.antrean.edit');
            Route::put('/{antrean}', [AntreanController::class, 'update'])->name('admin.antrean.update');
            Route::delete('/{antrean}', [AntreanController::class, 'destroy'])->name('admin.antrean.destroy');
        });

        //--- Antrean Panggil
        // Route::prefix('antrean-panggil')->group(function () {
        //     Route::get('/', [AntreanPanggilController::class, 'index'])->name('admin.antrean-panggil.index');
        //     Route::get('/create', [AntreanPanggilController::class, 'create'])->name('admin.antrean-panggil.create');
        //     Route::post('/', [AntreanPanggilController::class, 'store'])->name('admin.antrean-panggil.store');
        //     Route::get('/{antreanPanggil}', [AntreanPanggilController::class, 'show'])->name('admin.antrean-panggil.show');
        //     Route::get('/{antreanPanggil}/edit', [AntreanPanggilController::class, 'edit'])->name('admin.antrean-panggil.edit');
        //     Route::put('/{antreanPanggil}', [AntreanPanggilController::class, 'update'])->name('admin.antrean-panggil.update');
        //     Route::delete('/{antreanPanggil}', [AntreanPanggilController::class, 'destroy'])->name('admin.antrean-panggil.destroy');
        // });
    });
});
