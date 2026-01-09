@extends('layouts.web')

@section('title', 'Profil Anda')

@section('content')
<div class="container py-4">

    {{-- HEADER --}}
    <div class="mb-4">
        <h3 class="fw-bold">Profil Saya</h3>
        <p class="text-muted mb-0">Informasi akun mahasiswa</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            {{-- FOTO --}}
            <div class="text-center mb-4">
                <img src="{{ $user->photo
                        ? asset('storage/' . $user->photo)
                        : asset('assets/images/user/avatar-2.jpg') }}"
                     class="rounded-circle border"
                     style="width:120px;height:120px;object-fit:cover">

                <h5 class="mt-3 mb-0">{{ $user->name }}</h5>
                <span class="badge bg-success mt-1">Mahasiswa</span>
            </div>

            <hr>

            {{-- DATA --}}
            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label text-muted">Nama Lengkap</label>
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
                    <label class="form-label text-muted">NIM</label>
                    <div class="form-control bg-light">
                        {{ $user->nim ?? '-' }}
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted">Program Studi</label>
                    <div class="form-control bg-light">
                        {{ $user->prodi->nama ?? '-' }}
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted">Role</label>
                    <div class="form-control bg-light">
                        Mahasiswa
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted">Fakultas</label>
                    <div class="form-control bg-light">
                        {{ $user->prodi->fakultas->nama ?? '-' }}
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
