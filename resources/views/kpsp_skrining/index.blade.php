@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Hasil Skrining KPSP</h2>
        <a href="{{ route('kpsp-skrining.create') }}" class="btn btn-primary mb-3">+ Tambah Skrining</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered" id="datatable">
            <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Anak</th>
                <th>Usia Set</th>
                <th>Skor</th>
                <th>Interpretasi</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($skrining as $s)
                <tr>
                    <td>{{ $s->tanggal_skrining->format('d-m-Y') }}</td>
                    <td>{{ $s->anak->name }}</td>
                    <td>{{ $s->set->usia_dalam_bulan }} bulan</td>
                    <td>{{ $s->skor_mentah }}</td>
                    <td>{{ $s->hasil_interpretasi }}</td>
                    <td>
                        <a href="{{ route('kpsp-skrining.edit', $s->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('kpsp-skrining.destroy', $s->id) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $skrining->links() }}
    </div>
@endsection
