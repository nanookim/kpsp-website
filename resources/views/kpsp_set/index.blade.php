@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Set Pertanyaan KPSP</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('kpsp-set.import') }}" method="POST" enctype="multipart/form-data" class="mb-3">
            @csrf
            <div class="input-group">
                <input type="file" name="file" class="form-control" required>
                <button class="btn btn-success">Import Excel</button>
            </div>
        </form>

        <a href="{{ route('kpsp-set.create') }}" class="btn btn-primary mb-3">+ Tambah Set Pertanyaan</a>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Usia (bulan)</th>
                <th>Deskripsi</th>
                <th>Jumlah Pertanyaan</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sets as $set)
                <tr>
                    <td>{{ $set->usia_dalam_bulan }}</td>
                    <td>{{ $set->deskripsi }}</td>
                    <td>{{ $set->jumlah_pertanyaan }}</td>
                    <td>
                        <a href="{{ route('kpsp-set.edit', $set->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('kpsp-set.destroy', $set->id) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $sets->links() }}
    </div>
@endsection
