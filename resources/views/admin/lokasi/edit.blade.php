@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Lokasi</h1>
        <form action="{{ route('lokasi.update', $lokasi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="lokasi">Lokasi</label>
                <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ $lokasi->lokasi }}">
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="">Pilih Status</option>
                    <option value="aktif" {{ $lokasi->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="tidak_aktif" {{ $lokasi->status == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>
            
           

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection