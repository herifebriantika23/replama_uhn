@extends('layouts.web')

@section('title', 'Edit Profil')

@section('content')
<div class="container py-4">

    {{-- PAGE TITLE --}}
    <div class="mb-4">
        <h3 class="fw-semibold">Profile</h3>
        <p class="text-muted mb-0">Kelola informasi akun Anda</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            {{-- FOTO PROFIL --}}
            <div class="text-center mb-4">
                @php
                    $photoUrl = $user->photo
                        ? asset('storage/' . $user->photo)
                        : asset('assets/images/user/avatar-2.jpg');
                @endphp

                <form action="{{ route('profile.photo.update') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      id="photoForm">
                    @csrf
                    @method('PUT')

                    <input type="file"
                           name="photo"
                           id="photoInput"
                           accept="image/*"
                           hidden>

                   <div class="position-relative d-inline-block"
                        style="cursor:pointer"
                        onclick="document.getElementById('photoInput').click()"
                        onmouseover="this.querySelector('.overlay-text').style.opacity='1'"
                        onmouseout="this.querySelector('.overlay-text').style.opacity='0'">

                        <img src="{{ $photoUrl }}?v={{ now()->timestamp }}"
                            class="rounded-circle border"
                            style="width:120px;height:120px;object-fit:cover;"
                            onerror="this.src='{{ asset('assets/images/user/avatar-2.jpg') }}'">

                        {{-- OVERLAY --}}
                        <div class="overlay-text position-absolute top-0 start-0 w-100 h-100 rounded-circle
                                    d-flex flex-column align-items-center justify-content-center text-white"
                            style="background:rgba(0,0,0,.45);
                                    opacity:0;
                                    transition:.3s;
                                    pointer-events:none;">

                            <i class="ti ti-edit fs-4 mb-1"></i>
                            <small class="fw-semibold">Ganti Foto</small>
                        </div>
                    </div>
                </form>

                <h6 class="mt-3 mb-0">{{ $user->name }}</h6>
                <small class="text-muted">{{ ucfirst($user->role) }}</small>
            </div>

            {{-- FORM PROFIL --}}
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <h5 class="fw-bold mb-3">Informasi Profil</h5>

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name', $user->name) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email', $user->email) }}"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">NIM</label>
                    <input type="text"
                           name="nim"
                           class="form-control"
                           value="{{ old('nim', $user->nim) }}"
                           placeholder="Masukkan NIM">
                </div>

                <div class="mb-3">
                    <label class="form-label">Fakultas</label>
                    <select id="fakultasSelect" class="form-select">
                        <option value="">-- Pilih Fakultas --</option>
                        @foreach($fakultas as $fk)
                            <option value="{{ $fk->id }}"
                                {{ optional($user->prodi)->fakultas_id == $fk->id ? 'selected' : '' }}>
                                {{ $fk->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">Program Studi</label>
                    <select name="prodi_id" id="prodiSelect" class="form-select">
                        <option value="">-- Pilih Program Studi --</option>
                        @foreach($prodis as $prodi)
                            <option value="{{ $prodi->id }}"
                                    data-fakultas="{{ $prodi->fakultas_id }}"
                                {{ old('prodi_id', $user->prodi_id) == $prodi->id ? 'selected' : '' }}>
                                {{ $prodi->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">Role</label>
                    <input type="text"
                           class="form-control"
                           value="{{ ucfirst($user->role) }}"
                           readonly>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Simpan Perubahan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const photoInput = document.getElementById('photoInput');
    const photoForm  = document.getElementById('photoForm');

    if (photoInput && photoForm) {
        photoInput.addEventListener('change', function () {
            if (this.files.length > 0) {
                photoForm.submit();
            }
        });
    }
});
</script>

@endsection

