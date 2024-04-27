@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Tambah Loket</h1>
    <form action="{{ route('admin.loket.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="loket">Loket:</label>
            <input type="text" name="loket" id="loket" class="form-control">
            @error('loket')
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