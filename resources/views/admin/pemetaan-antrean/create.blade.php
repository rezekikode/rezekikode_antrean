@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Tambah Pemetaan Antrean</h1>
    <form method="POST" action="{{ route('admin.pemetaan-antrean.store') }}">
        @csrf

        <div class="form-group">
            <label for="lokasi_id">Lokasi:</label>
            <select name="lokasi_id" id="lokasi_id" class="form-control">
                <option value="">Pilih Lokasi</option>
                @foreach ($lokasis as $lokasi)
                <option value="{{ $lokasi->id }}">{{ $lokasi->lokasi }}</option>
                @endforeach
            </select>
            @error('lokasi_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="layanan_id">Layanan:</label>
            <select name="layanan_id" id="layanan_id" class="form-control">
                <option value="">Pilih Layanan</option>
                @foreach ($layanans as $layanan)
                <option value="{{ $layanan->id }}">{{ $layanan->layanan }}</option>
                @endforeach
            </select>
            @error('layanan_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="loket_id">Loket:</label>
            <select name="loket_id" id="loket_id" class="form-control">
                <option value="">Pilih Loket</option>
                @foreach ($lokets as $loket)
                <option value="{{ $loket->id }}">{{ $loket->loket }}</option>
                @endforeach
            </select>
            @error('loket_id')
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