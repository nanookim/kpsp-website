@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Pilih Set Pertanyaan KPSP</h2>
        <ul class="list-group mt-3">
            @foreach($sets as $set)
                <li class="list-group-item d-flex justify-content-between">
                    <span>Usia {{ $set->usia_dalam_bulan }} bulan - {{ $set->deskripsi }}</span>
                    <a href="{{ route('kpsp.show', $set->id) }}" class="btn btn-primary btn-sm">Mulai</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
