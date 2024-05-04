<?php

namespace App\Http\Controllers;

use App\Models\Antrean;
use App\Http\Requests\StoreAntreanRequest;
use App\Http\Requests\UpdateAntreanRequest;
use App\Models\Layanan;
use App\Models\Lokasi;

class AntreanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        $lokasi_id = request()->get('lokasi_id');
        $layanan_id = request()->get('layanan_id'); 
        $tanggal_ambil = request()->get('tanggal_ambil');       
        $lokasis = Lokasi::all();
        $layanans = Layanan::all();        
        $antreans = Antrean::when($lokasi_id, function ($query, $lokasi_id) {
            return $query->where('lokasi_id', $lokasi_id);
        })->when($layanan_id, function ($query, $layanan_id) {
            return $query->where('layanan_id', $layanan_id);
        })->when($tanggal_ambil, function ($query, $tanggal_ambil) {
            return $query->where('tanggal_ambil', $tanggal_ambil);
        })
        ->orderBy('tanggal_ambil', 'desc')
        ->orderBy('jam_ambil', 'desc')
        ->get();
        return view('admin.antrean.index', compact(
            'lokasi_id',
            'layanan_id',
            'tanggal_ambil',
            'lokasis',
            'layanans',
            'antreans'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAntreanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Antrean $antrean)
    {
        return view('admin.antrean.show', compact('antrean'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Antrean $antrean)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAntreanRequest $request, Antrean $antrean)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Antrean $antrean)
    {
        //
    }
}
