@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Set Pertanyaan</h2>
        <form action="{{ route('kpsp-set.update', $kpsp_set->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label>Usia dalam Bulan</label>
                <input type="number" name="usia_dalam_bulan" class="form-control" value="{{ $kpsp_set->usia_dalam_bulan }}" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control">{{ $kpsp_set->deskripsi }}</textarea>
            </div>
            <div class="mb-3">
                <label>Jumlah Pertanyaan</label>
                <input type="number" name="jumlah_pertanyaan" class="form-control" value="{{ $kpsp_set->jumlah_pertanyaan }}" required>
            </div>
            <button class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
