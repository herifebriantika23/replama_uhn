@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- PAGE TITLE --}}
    <div class="mb-4">
        <h3 class="fw-semibold">Profil Admin</h3>
        <p class="text-muted mb-0">Informasi akun administrator sistem</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            {{-- FOTO PROFIL --}}
            <div class="text-center mb-4">
                <img src="{{ $user->photo_url }}"
                     class="rounded-circle border"
                     style="width:120px;height:120px;object-fit:cover;"
                     alt="Foto Profil Admin">

                <h5 class="mt-3 mb-0">{{ $user->name }}</h5>
                <small class="text-muted text-uppercase">
                    {{ $user->role }}
                </small>
            </div>

            {{-- DATA AKUN --}}
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
                    <label class="form-label text-muted">Sebagai</label>
                    <div class="form-control bg-light">
                        Administrator
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted">Tanggal Bergabung</label>
                    <div class="form-control bg-light">
                        {{ $user->created_at->format('d M Y') }}
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
@endsection
