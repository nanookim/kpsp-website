@extends('layouts.app')

@section('content')
{{--    <div class="row">--}}
{{--        <!-- Zero Configuration  Starts-->--}}
{{--        <div class="col-sm-12">--}}
{{--            <div class="card shadow-sm border-0">--}}
{{--                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">--}}
{{--                    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">--}}
{{--                        <i class="bi bi-person-plus"></i> Tambah User--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <div class="table-responsive">--}}
{{--                        <table class="display" id="basic-1">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th style="width: 60px;">No</th>--}}
{{--                                <th>Nama</th>--}}
{{--                                <th>Email</th>--}}
{{--                                <th width="180px">Aksi</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($users as $user)--}}
{{--                                <tr>--}}
{{--                                    <td>{{ $loop->iteration }}</td>--}}
{{--                                    <td>{{ $user->name }}</td>--}}
{{--                                    <td>{{ $user->email }}</td>--}}
{{--                                    <td>--}}
{{--                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">--}}
{{--                                            <i class="bi bi-eye"></i> <!-- icon detail -->--}}
{{--                                        </a>--}}
{{--                                        <a href="{{ route('users.edit', $user->id) }}"--}}
{{--                                           class="btn btn-primary btn-sm text-white"--}}
{{--                                           data-id="{{ $user->id }}"--}}
{{--                                           data-name="{{ $user->name }}"--}}
{{--                                           data-email="{{ $user->email }}"--}}
{{--                                           title="Edit"--}}
{{--                                           data-bs-toggle="modal"--}}
{{--                                           data-bs-target="#editUserModal">--}}
{{--                                            <i class="bi bi-pencil-square"></i> <!-- icon edit -->--}}
{{--                                        </a>--}}
{{--                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"--}}
{{--                                              class="d-inline delete-form">--}}
{{--                                            @csrf--}}
{{--                                            @method('DELETE')--}}
{{--                                            <button type="submit" class="btn btn-danger btn-sm"--}}
{{--                                                    onclick="return confirm('Hapus user ini?')">--}}
{{--                                                <i class="bi bi-trash"></i> <!-- icon hapus -->--}}
{{--                                            </button>--}}
{{--                                        </form>--}}
{{--                                    </td>--}}

{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Daftar User</h2>
                <a href="{{ route('users.create') }}" class="btn btn-primary">+ Tambah User</a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow">
                <div class="card-body">
                    <table class="table table-striped table-bordered" id="usersTable">
                        <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th width="180px">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ route('users.show',$user->id) }}" class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{ route('users.edit',$user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('users.destroy',$user->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus user ini?')">
                                            Hapus
                                        </button>
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#usersTable').DataTable();
        });
    </script>
@endpush
