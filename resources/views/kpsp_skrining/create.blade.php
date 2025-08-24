@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Skrining</h2>
        <form action="{{ route('kpsp-skrining.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nama Anak</label>
                <select name="id_anak" class="form-control" required>
                    @foreach($children as $child)
                        <option value="{{ $child->id }}">{{ $child->name }} ({{ $child->date_of_birth->format('d-m-Y') }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Set Pertanyaan (Usia)</label>
                <select name="id_set_kpsp" class="form-control" required>
                    @foreach($sets as $set)
                        <option value="{{ $set->id }}">{{ $set->usia_dalam_bulan }} bulan</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Tanggal Skrining</label>
                <input type="date" name="tanggal_skrining" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Skor Mentah</label>
                <input type="number" name="skor_mentah" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Hasil Interpretasi</label>
                <input type="text" name="hasil_interpretasi" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Rekomendasi</label>
                <textarea name="rekomendasi" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label>Catatan</label>
                <textarea name="catatan" class="form-control"></textarea>
            </div>
            <button class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
