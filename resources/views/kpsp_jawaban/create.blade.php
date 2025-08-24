@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Jawaban</h2>
        <form action="{{ route('kpsp-jawaban.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Skrining</label>
                <select name="id_skrining" class="form-control" required>
                    @foreach($skrining as $s)
                        <option value="{{ $s->id }}">{{ $s->anak->name }} - {{ $s->tanggal_skrining->format('d-m-Y') }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Pertanyaan</label>
                <select name="id_pertanyaan" class="form-control" required>
                    @foreach($pertanyaan as $p)
                        <option value="{{ $p->id }}">
                            [{{ $p->set->usia_dalam_bulan }} bln] {{ $p->nomor_urut }}. {{ Str::limit($p->teks_pertanyaan, 60) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Jawaban</label>
                <select name="jawaban" class="form-control" required>
                    <option value="1">Ya</option>
                    <option value="0">Tidak</option>
                </select>
            </div>
            <button class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
