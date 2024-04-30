@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Daftar Loket</h1>

        <a href="{{ route('admin.loket.create') }}" class="btn btn-sm btn-primary">Tambah Loket</a>

        @if (session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Loket</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lokets as $loket)
                    <tr>
                        <td>{{ $loket->id }}</td>
                        <td>{{ $loket->loket }}</td>
                        <td>{{ $loket->status }}</td>
                        <td>
                            <a href="{{ route('admin.loket.edit', $loket->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('admin.loket.destroy', $loket->id) }}" method="POST" class="d-inline">
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