<?php

namespace App\Http\Controllers;

use App\Models\Loket;
use App\Http\Requests\StoreLoketRequest;
use App\Http\Requests\UpdateLoketRequest;

class LoketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.loket.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.loket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLoketRequest $request)
    {
        $validatedData = $request->validate([
            'loket' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        $loket = new Loket;
        $loket->loket = $validatedData['loket'];
        $loket->status = $validatedData['status'];
        $loket->save();
        return redirect()->route('admin.loket.index')->with('success', 'Loket berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Loket $loket)
    {
        return view('admin.loket.show', compact('loket'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Loket $loket)
    {
        return view('admin.loket.edit', compact('loket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLoketRequest $request, Loket $loket)
    {
        $validatedData = $request->validate([
            'loket' => 'required|string|max:255',
            'status' => 'required|string',
        ]);

        $loket->loket = $validatedData['loket'];
        $loket->status = $validatedData['status'];
        $loket->save();
        return redirect()->route('admin.loket.index')->with('success', 'Loket berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Loket $loket)
    {
        $loket->delete();
        return redirect()->route('admin.loket.index')->with('success', 'Loket berhasil dihapus');
    }
}
