@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Pertanyaan KPSP</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Form Import Excel -->
        <!-- Form Import Excel -->
        <form action="{{ route('kpsp-pertanyaan.import') }}" method="POST" enctype="multipart/form-data" class="mb-3">
            @csrf
            <div class="input-group">
                <input type="file" name="file" class="form-control" required>
                <button class="btn btn-success">Import Excel</button>
                <a href="{{ route('kpsp-pertanyaan.template') }}" class="btn btn-secondary">Download Template</a>
            </div>
        </form>


        <a href="{{ route('kpsp-pertanyaan.create') }}" class="btn btn-primary mb-3">+ Tambah Pertanyaan</a>

        <table class="table table-bordered" id="datatable">
            <thead>
            <tr>
                <th>Usia (bulan)</th>
                <th>No</th>
                <th>Teks Pertanyaan</th>
                <th>Domain</th>
                <th>Ilustrasi</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pertanyaan as $q)
                <tr>
                    <td>{{ $q->set->usia_dalam_bulan }}</td>
                    <td>{{ $q->nomor_urut }}</td>
                    <td>{{ $q->teks_pertanyaan }}</td>
                    <td>{{ $q->domain_perkembangan ?? '-' }}</td>
                    <td>
                        @if($q->url_ilustrasi)
                            <img src="{{ asset('storage/' . $q->url_ilustrasi) }}" alt="Ilustrasi" width="80">
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('kpsp-pertanyaan.edit', $q->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('kpsp-pertanyaan.destroy', $q->id) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $pertanyaan->links() }}
    </div>
@endsection
