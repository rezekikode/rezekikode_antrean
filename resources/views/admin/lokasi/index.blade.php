@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Daftar Lokasi</h1>

        <a href="{{ route('admin.lokasi.create') }}" class="btn btn-sm btn-primary">Tambah Lokasi</a>

        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Lokasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lokasis as $lokasi)
                    <tr>
                        <td>{{ $lokasi->id }}</td>
                        <td>{{ $lokasi->lokasi }}</td>
                        <td>{{ $lokasi->status }}</td>
                        <td>
                            <a href="{{ route('admin.lokasi.edit', $lokasi->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('admin.lokasi.destroy', $lokasi->id) }}" method="POST" class="d-inline">
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