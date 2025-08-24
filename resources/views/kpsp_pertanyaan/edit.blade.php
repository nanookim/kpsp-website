@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Pertanyaan</h2>
        <form action="{{ route('kpsp-pertanyaan.update', $kpsp_pertanyaan->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label>Set Pertanyaan (Usia)</label>
                <select name="id_set_kpsp" class="form-control" required>
                    @foreach($sets as $set)
                        <option value="{{ $set->id }}" {{ $kpsp_pertanyaan->id_set_kpsp == $set->id ? 'selected' : '' }}>
                            {{ $set->usia_dalam_bulan }} bulan
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Nomor Urut</label>
                <input type="number" name="nomor_urut" class="form-control" value="{{ $kpsp_pertanyaan->nomor_urut }}" required>
            </div>
            <div class="mb-3">
                <label>Teks Pertanyaan</label>
                <textarea name="teks_pertanyaan" class="form-control" required>{{ $kpsp_pertanyaan->teks_pertanyaan }}</textarea>
            </div>
            <div class="mb-3">
                <label>Domain Perkembangan</label>
                <input type="text" name="domain_perkembangan" class="form-control" value="{{ $kpsp_pertanyaan->domain_perkembangan }}">
            </div>
            <div class="mb-3">
                <label>URL Ilustrasi</label>
                <input type="text" name="url_ilustrasi" class="form-control" value="{{ $kpsp_pertanyaan->url_ilustrasi }}">
            </div>
            <button class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
