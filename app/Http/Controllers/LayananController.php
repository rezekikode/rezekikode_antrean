<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Http\Requests\StoreLayananRequest;
use App\Http\Requests\UpdateLayananRequest;
use App\Models\Lokasi;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $layanans = Layanan::all();
        return view('admin.layanan.index', compact('layanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.layanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLayananRequest $request)
    {
        $validatedData = $request->validate([
            'layanan' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        $layanan = new Layanan;
        $layanan->layanan = $validatedData['layanan'];
        $layanan->status = $validatedData['status'];
        $layanan->save();
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Layanan $layanan)
    {
        return view('admin.layanan.show', compact('layanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Layanan $layanan)
    {
        return view('admin.layanan.edit', compact('layanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLayananRequest $request, Layanan $layanan)
    {
        $validatedData = $request->validate([
            'layanan' => 'required|string|max:255',
            'status' => 'required|string',
        ]);
        $layanan->layanan = $validatedData['layanan'];
        $layanan->status = $validatedData['status'];
        $layanan->save();
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Layanan $layanan)
    {
        //
        $layanan->delete();
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus');
    }
}
