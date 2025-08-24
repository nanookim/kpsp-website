@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Jawaban KPSP</h2>
        <a href="{{ route('kpsp-jawaban.create') }}" class="btn btn-primary mb-3">+ Tambah Jawaban</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered" id="datatable">
            <thead>
            <tr>
                <th>Skrining</th>
                <th>Anak</th>
                <th>Pertanyaan</th>
                <th>Jawaban</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($jawaban as $j)
                <tr>
                    <td>{{ $j->skrining->tanggal_skrining->format('d-m-Y') }}</td>
                    <td>{{ $j->skrining->anak->name }}</td>
                    <td>[{{ $j->pertanyaan->set->usia_dalam_bulan }} bln] {{ $j->pertanyaan->nomor_urut }}. {{ $j->pertanyaan->teks_pertanyaan }}</td>
                    <td>
                        @if($j->jawaban)
                            <span class="badge bg-success">Ya</span>
                        @else
                            <span class="badge bg-danger">Tidak</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('kpsp-jawaban.edit', $j->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('kpsp-jawaban.destroy', $j->id) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $jawaban->links() }}
    </div>
@endsection
