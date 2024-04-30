@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Daftar Pemetaan Antrean</h1>

    <a href="{{ route('admin.pemetaan-antrean.create') }}" class="btn btn-primary">Tambah Pemetaan Antrean</a>

    @if (session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
    @endif

    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Lokasi</th>
                <th>Nama Layanan</th>
                <th>Nama Loket</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemetaanAntreans as $pemetaanAntrean)
            <tr>
                <td>{{ $pemetaanAntrean->id }}</td>
                <td>{{ $pemetaanAntrean->lokasi_id }}</td>
                <td>{{ $pemetaanAntrean->layanan_id }}</td>
                <td>{{ $pemetaanAntrean->loket_id }}</td>
                <td>{{ $pemetaanAntrean->status }}</td>
                <td>
                    <a href="{{ route('admin.pemetaan-antrean.edit', $pemetaanAntrean->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.pemetaan-antrean.destroy', $pemetaanAntrean->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection