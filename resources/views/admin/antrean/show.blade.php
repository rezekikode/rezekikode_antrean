@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Detail Antrean</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="lokasi_id">Lokasi</label>
                <input type="text" name="lokasi_id" id="lokasi_id" class="form-control" value="{{ $antrean->lokasi->lokasi }}" readonly>
            </div>
            <div class="form-group mb-3">
                <label for="layanan_id">Layanan</label>
                <input type="text" name="layanan_id" id="layanan_id" class="form-control" value="{{ $antrean->layanan->layanan }}" readonly>
            </div>
            <div class="form-group mb-3">
                <label for="tanggal_ambil">Tanggal Ambil</label>
                <input type="text" name="tanggal_ambil" id="tanggal_ambil" class="form-control" value="{{ $antrean->tanggal_ambil }}" readonly>
            </div>
            <div class="form-group mb-3">
                <label for="jam_ambil">Jam Ambil</label>
                <input type="text" name="jam_ambil" id="jam_ambil" class="form-control" value="{{ $antrean->jam_ambil }}" readonly>
            </div>
        </div>
    </div>
    <a href="{{ route('admin.antrean.index') }}" class="btn btn-primary">Kembali</a>
</div>
@endsection