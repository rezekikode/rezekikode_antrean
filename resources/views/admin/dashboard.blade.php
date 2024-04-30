@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <h5 class="card-header">Antrean</h5>
            <div class="card-body">
                {{ $totalAntrean }}
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <h5 class="card-header">Menunggu</h5>
            <div class="card-body">
                {{ $totalAntreanMenunggu }}
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <h5 class="card-header">Selesai</h5>
            <div class="card-body">
                {{ $totalAntreanSelesai }}
            </div>
        </div>
    </div>
</div>
@endsection