@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Tambah Lokasi</h1>
    <form action="{{ route('admin.lokasi.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="lokasi">Lokasi:</label>
            <input type="text" name="lokasi" id="lokasi" class="form-control">
            @error('lokasi')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control">
                <option value="">Pilih Status</option>
                <option value="aktif">Aktif</option>
                <option value="tidak_aktif">Tidak Aktif</option>
            </select>
            @error('status')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection