@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Daftar Layanan</h1>

        <a href="{{ route('admin.layanan.create') }}" class="btn btn-primary">Tambah Layanan</a>

        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Layanan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($layanans as $layanan)
                    <tr>
                        <td>{{ $layanan->id }}</td>
                        <td>{{ $layanan->layanan }}</td>
                        <td>{{ $layanan->status }}</td>
                        <td>
                            <a href="{{ route('admin.layanan.edit', $layanan->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('admin.layanan.destroy', $layanan->id) }}" method="POST" class="d-inline">
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