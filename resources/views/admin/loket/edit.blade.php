@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Loket</h1>
    <form action="{{ route('admin.loket.update', $loket->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="loket">Loket</label>
            <input type="text" class="form-control" id="loket" name="loket" value="{{ $loket->loket }}">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status">
                <option value="">Pilih Status</option>
                <option value="aktif" {{ $loket->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="tidak_aktif" {{ $loket->status == 'tidak_aktif' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection