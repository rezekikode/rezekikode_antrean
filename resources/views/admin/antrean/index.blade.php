@extends('layouts.admin')

@section('content')
<div class="container">
    <form action="{{ route('admin.antrean.index') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="lokasi_id">Lokasi</label>
                    <select name="lokasi_id" id="lokasi_id" class="form-control">
                        <option value="">Pilih Lokasi</option>
                        @foreach ($lokasis as $lokasi)
                        <option value="{{ $lokasi->id }}" {{ request('lokasi_id') == $lokasi->id ? 'selected' : '' }}>{{ $lokasi->lokasi }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="layanan_id">Layanan</label>
                    <select name="layanan_id" id="layanan_id" class="form-control">
                        <option value="">Pilih Layanan</option>
                        @foreach ($layanans as $layanan)
                        <option value="{{ $layanan->id }}" {{ request('layanan_id') == $layanan->id ? 'selected' : '' }}>{{ $layanan->layanan }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="tanggal_ambil">Tanggal Ambil</label>
                    <input type="date" name="tanggal_ambil" id="tanggal_ambil" class="form-control" value="{{ request('tanggal_ambil') }}">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Filter</button>
    </form>
    <h1>Daftar Antrean</h1>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Lokasi</th>
                <th>Nama Layanan</th>
                <th>Tanggal Ambil</th>
                <th>Jam Ambil</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($antreans as $antrean)
            <tr>
                <td>{{ $antrean->id }}</td>
                <td>{{ $antrean->lokasi_id }} - {{ $antrean->lokasi->lokasi }}</td>
                <td>{{ $antrean->layanan_id }} - {{ $antrean->layanan->layanan }}</td>
                <td>{{ $antrean->tanggal_ambil }}</td>
                <td>{{ $antrean->jam_ambil }}</td>
                <td>
                    <a href="{{ route('admin.antrean.show', $antrean->id) }}" class="btn btn-sm btn-primary">Lihat</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection