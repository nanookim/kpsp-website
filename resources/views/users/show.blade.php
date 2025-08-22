@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    {{-- Header User --}}
                    <div class="card-header text-center text-white py-5"
                         style="background: linear-gradient(135deg, #06b6d4, #3b82f6);">
                        <div class="mb-3">
                            <i class="bi bi-person-circle" style="font-size: 4rem;"></i>
                        </div>
                        <h3 class="mb-0">{{ $user->name }}</h3>
                        <small class="text-white-50">{{ $user->email }}</small>
                    </div>

                    {{-- Body Detail --}}
                    <div class="card-body p-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="fw-semibold"><i class="bi bi-hash me-2"></i>ID</span>
                                <span>{{ $user->id }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="fw-semibold"><i class="bi bi-person me-2"></i>Nama</span>
                                <span>{{ $user->name }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="fw-semibold"><i class="bi bi-envelope me-2"></i>Email</span>
                                <span>{{ $user->email }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="fw-semibold"><i class="bi bi-calendar3 me-2"></i>Dibuat</span>
                                <span>{{ $user->created_at->format('d M Y H:i') }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span class="fw-semibold"><i class="bi bi-clock-history me-2"></i>Diperbarui</span>
                                <span>{{ $user->updated_at->format('d M Y H:i') }}</span>
                            </li>
                        </ul>
                    </div>

                    {{-- Footer --}}
                    <div class="card-footer bg-light text-end">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
@endsection
