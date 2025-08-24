@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Set Pertanyaan</h2>
        <form action="{{ route('kpsp-set.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Usia dalam Bulan</label>
                <input type="number" name="usia_dalam_bulan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label>Jumlah Pertanyaan</label>
                <input type="number" name="jumlah_pertanyaan" class="form-control" required>
            </div>
            <button class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
