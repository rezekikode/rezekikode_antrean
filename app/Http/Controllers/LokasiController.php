<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Http\Requests\StoreLokasiRequest;
use App\Http\Requests\UpdateLokasiRequest;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.lokasi.index', ['lokasis' => Lokasi::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.lokasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLokasiRequest $request)
    {
        $validatedData = $request->validate([
            'lokasi' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        $lokasi = new Lokasi;
        $lokasi->lokasi = $validatedData['lokasi'];
        $lokasi->status = $validatedData['status'];
        $lokasi->save();

        return redirect()->route('lokasi.index')->with('success', 'Lokasi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lokasi $lokasi)
    {
        return view('admin.lokasi.show', compact('lokasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lokasi $lokasi)
    {
        return view('admin.lokasi.edit', compact('lokasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLokasiRequest $request, Lokasi $lokasi)
    {
        $validatedData = $request->validate([
            'lokasi' => 'required|string|max:255',
            'status' => 'required|string',
        ]);
        $lokasi->lokasi = $validatedData['lokasi'];
        $lokasi->status = $validatedData['status'];
        $lokasi->save();
        return redirect()->route('lokasi.index')->with('success', 'Lokasi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lokasi $lokasi)
    {
        //
        $lokasi->delete();
        return redirect()->route('lokasi.index')->with('success', 'Lokasi berhasil dihapus');
    }
}
