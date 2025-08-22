@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Anak</h5>
            <a href="{{ route('children.create') }}" class="btn btn-light btn-sm">+ Tambah Anak</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table id="childrenTable" class="table table-striped table-bordered align-middle">
                    <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Orang Tua</th>
                        <th>Nama Anak</th>
                        <th>Gender</th>
                        <th>Tanggal Lahir</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($children as $child)
                        <tr>
                            <td>{{ $child->id }}</td>
                            <td>{{ $child->user->name ?? '-' }}</td>
                            <td>{{ $child->name }}</td>
                            <td>
                                <span class="badge {{ $child->gender == 'male' ? 'bg-primary' : 'bg-pink' }}">
                                    {{ ucfirst($child->gender) }}
                                </span>
                            </td>
                            <td>{{ $child->date_of_birth->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('children.show',$child->id) }}" class="btn btn-info btn-sm">Detail</a>
                                <a href="{{ route('children.edit',$child->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('children.destroy',$child->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#childrenTable').DataTable();
        });
    </script>
@endpush
