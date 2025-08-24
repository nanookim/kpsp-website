@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Skrining</h2>
        <form action="{{ route('kpsp-skrining.update', $kpsp_skrining->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label>Nama Anak</label>
                <select name="id_anak" class="form-control" required>
                    @foreach($children as $child)
                        <option value="{{ $child->id }}" {{ $kpsp_skrining->id_anak == $child->id ? 'selected' : '' }}>
                            {{ $child->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Set Pertanyaan (Usia)</label>
                <select name="id_set_kpsp" class="form-control" required>
                    @foreach($sets as $set)
                        <option value="{{ $set->id }}" {{ $kpsp_skrining->id_set_kpsp == $set->id ? 'selected' : '' }}>
                            {{ $set->usia_dalam_bulan }} bulan
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Tanggal Skrining</label>
                <input type="date" name="tanggal_skrining" class="form-control" value="{{ $kpsp_skrining->tanggal_skrining->format('Y-m-d') }}" required>
            </div>
            <div class="mb-3">
                <label>Skor Mentah</label>
                <input type="number" name="skor_mentah" class="form-control" value="{{ $kpsp_skrining->skor_mentah }}" required>
            </div>
            <div class="mb-3">
                <label>Hasil Interpretasi</label>
                <input type="text" name="hasil_interpretasi" class="form-control" value="{{ $kpsp_skrining->hasil_interpretasi }}" required>
            </div>
            <div class="mb-3">
                <label>Rekomendasi</label>
                <textarea name="rekomendasi" class="form-control">{{ $kpsp_skrining->rekomendasi }}</textarea>
            </div>
            <div class="mb-3">
                <label>Catatan</label>
                <textarea name="catatan" class="form-control">{{ $kpsp_skrining->catatan }}</textarea>
            </div>
            <button class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
