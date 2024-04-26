@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Tambah Layanan</h1>
    <form action="{{ route('admin.layanan.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="lokasi_id">Lokasi:</label>
            <select name="lokasi_id" id="lokasi_id" class="form-control">
                <option value="">Pilih Lokasi</option>
                @foreach($lokasis as $lokasi)
                    <option value="{{ $lokasi->id }}">{{ $lokasi->lokasi }}</option>
                @endforeach
            </select>
            @error('lokasi_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="layanan">Layanan</label>
            <input type="text" name="layanan" id="layanan" class="form-control" required>
            @error('layanan')
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
        
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection