<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePemetaanAntreanRequest;
use App\Http\Requests\UpdatePemetaanAntreanRequest;
use App\Models\Layanan;
use App\Models\Lokasi;
use App\Models\Loket;
use App\Models\PemetaanAntrean;

class PemetaanAntreanController extends Controller
{
    // Tambahkan method-method controller di sini

    public function index()
    {
        $pemetaanAntreans = PemetaanAntrean::all();
        return view('admin.pemetaan-antrean.index', compact('pemetaanAntreans'));
    }

    public function create()
    {
        $lokasis = Lokasi::all();
        $layanans = Layanan::all();
        $lokets = Loket::all();
        return view('admin.pemetaan-antrean.create', compact('lokasis', 'layanans', 'lokets'));
    }

    public function store(StorePemetaanAntreanRequest $request)
    {
        $validatedData = $request->validate([
            'lokasi_id' => 'required|integer',
            'layanan_id' => 'required|integer',
            'loket_id' => 'required|integer',
            'status' => 'required|string',
        ]);

        $pemetaanAntrean = new PemetaanAntrean;
        $pemetaanAntrean->lokasi_id = $validatedData['lokasi_id'];
        $pemetaanAntrean->layanan_id = $validatedData['layanan_id'];
        $pemetaanAntrean->loket_id = $validatedData['loket_id'];
        $pemetaanAntrean->status = $validatedData['status'];
        $pemetaanAntrean->save();

        return redirect()->route('admin.pemetaan-antrean.index')->with('success', 'Pemetaan antrean berhasil ditambahkan');
    }

    public function show(PemetaanAntrean $pemetaanAntrean)
    {
        return view('admin.pemetaan-antrean.show', compact('pemetaanAntrean'));
    }

    public function edit(PemetaanAntrean $pemetaanAntrean)
    {
        $lokasis = Lokasi::all();
        $layanans = Layanan::all();
        $lokets = Loket::all();
        return view('admin.pemetaan-antrean.edit', compact('pemetaanAntrean', 'lokasis', 'layanans', 'lokets'));
    }

    public function update(UpdatePemetaanAntreanRequest $request, PemetaanAntrean $pemetaanAntrean)
    {
        $validatedData = $request->validate([
            'lokasi_id' => 'required|integer',
            'layanan_id' => 'required|integer',
            'loket_id' => 'required|integer',
            'status' => 'required|string',
        ]);

        $pemetaanAntrean->lokasi_id = $validatedData['lokasi_id'];
        $pemetaanAntrean->layanan_id = $validatedData['layanan_id'];
        $pemetaanAntrean->loket_id = $validatedData['loket_id'];
        $pemetaanAntrean->status = $validatedData['status'];
        $pemetaanAntrean->save();

        return redirect()->route('admin.pemetaan-antrean.index')->with('success', 'Pemetaan antrean berhasil diubah');
    }

    public function destroy(PemetaanAntrean $pemetaanAntrean)
    {
        $pemetaanAntrean->delete();

        return redirect()->route('admin.pemetaan-antrean.index')->with('success', 'Pemetaan antrean berhasil dihapus');
    }
}