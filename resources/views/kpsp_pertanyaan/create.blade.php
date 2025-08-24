@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Pertanyaan</h2>
        <form action="{{ route('kpsp-pertanyaan.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Set Pertanyaan (Usia)</label>
                <select name="id_set_kpsp" class="form-control" required>
                    @foreach($sets as $set)
                        <option value="{{ $set->id }}">{{ $set->usia_dalam_bulan }} bulan</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Nomor Urut</label>
                <input type="number" name="nomor_urut" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Teks Pertanyaan</label>
                <textarea name="teks_pertanyaan" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label>Domain Perkembangan</label>
                <input type="text" name="domain_perkembangan" class="form-control">
            </div>
            <div class="mb-3">
                <label>URL Ilustrasi</label>
                <input type="text" name="url_ilustrasi" class="form-control">
            </div>
            <button class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
