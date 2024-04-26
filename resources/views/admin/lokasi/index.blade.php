@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Daftar Lokasi</h1>

        <a href="{{ route('admin.lokasi.create') }}" class="btn btn-primary">Tambah Lokasi</a>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Lokasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lokasis as $lokasi)
                    <tr>
                        <td>{{ $lokasi->id }}</td>
                        <td>{{ $lokasi->lokasi }}</td>
                        <td>
                            <a href="{{ route('lokasi.edit', $lokasi->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('lokasi.destroy', $lokasi->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection