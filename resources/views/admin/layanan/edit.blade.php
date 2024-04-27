@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Layanan</h1>
    <form method="POST" action="{{ route('admin.layanan.update', $layanan->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama">Layanan</label>
            <input type="text" class="form-control" id="layanan" name="layanan" value="{{ $layanan->layanan }}">
            @error('layanan')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="">Pilih Status</option>
                <option value="aktif" {{ $layanan->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="tidak_aktif" {{ $layanan->status == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
            @error('status')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection