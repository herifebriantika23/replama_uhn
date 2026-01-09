@extends('layouts.app')

@section('title', 'Profil Anda')

@section('content')
<div class="container py-4">

    {{-- HEADER --}}
    <div class="mb-4">
        <h3 class="fw-semibold">Profil Admin</h3>
        <p class="text-muted mb-0">Informasi akun administrator sistem</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            {{-- FOTO --}}
            <div class="text-center mb-4">
                <img src="{{ $user->photo_url }}"
                     class="rounded-circle border"
                     style="width:120px;height:120px;object-fit:cover"
                     alt="Foto Profil Admin">

                <h5 class="mt-3 mb-0">{{ $user->name }}</h5>
                <span class="badge bg-primary mt-1">ADMIN</span>
            </div>

            <hr>

            {{-- DATA --}}
            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label text-muted">Nama</label>
                    <div class="form-control bg-light">
                        {{ $user->name }}
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted">Email</label>
                    <div class="form-control bg-light">
                        {{ $user->email }}
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted">Sebagai</label>
                    <div class="form-control bg-light">
                        {{ ucfirst($user->role) }}
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted">Terdaftar Sejak</label>
                    <div class="form-control bg-light">
                        {{ $user->created_at->format('d M Y') }}
                    </div>
                </div>

            </div>
            
            <div class="mt-4 text-end">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                    <i class="ti ti-edit-circle me-1"></i> Edit Profil
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
