@extends('layouts.app')

@section('content')
<div class="container">

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
                        ? asset('storage/profile/' . $user->photo)
                        : asset('assets/images/user/avatar-2.jpg');
                @endphp

                {{-- FORM FOTO (AUTO SUBMIT) --}}
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
                         onclick="photoInput.click()">

                        <img src="{{ $photoUrl }}"
                             class="rounded-circle border"
                             style="width:120px;height:120px;object-fit:cover;"
                             onerror="this.src='{{ asset('assets/images/user/avatar-2.jpg') }}'">

                        <div class="position-absolute top-0 start-0 w-100 h-100 rounded-circle
                                    d-flex align-items-center justify-content-center text-white"
                             style="background:rgba(0,0,0,.45);opacity:0;transition:.3s"
                             onmouseover="this.style.opacity=1"
                             onmouseout="this.style.opacity=0">
                            <i class="ti ti-edit fs-4"></i>
                        </div>
                    </div>
                </form>

                <h6 class="mt-3 mb-0">{{ $user->name }}</h6>
                <small class="text-muted">{{ ucfirst($user->role) }}</small>
            </div>

            {{-- FORM UTAMA (PROFIL + PASSWORD) --}}
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                {{-- INFORMASI PROFIL --}}
                <h5 class="fw-bold mb-3">Informasi Profil</h5>

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name', $user->name) }}"
                           required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Email</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email', $user->email) }}"
                           required>
                </div>

                {{-- UBAH PASSWORD --}}
                <h5 class="fw-bold mb-3">Ubah Password</h5>

                <div class="mb-3">
                    <label class="form-label">Password Saat Ini</label>
                    <input type="password"
                           name="current_password"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Password Baru</label>
                    <input type="password"
                           name="password"
                           class="form-control">
                </div>

                <div class="mb-4">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password"
                           name="password_confirmation"
                           class="form-control">
                </div>

                {{-- ACTION BUTTON --}}
                <div class="d-flex justify-content-between align-items-center">

                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>

                    <button type="button"
                            class="btn btn-danger"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteAccountModal">
                        Hapus Akun
                    </button>

                </div>
            </form>

        </div>
    </div>
</div>

{{-- MODAL HAPUS AKUN --}}
<div class="modal fade"
     id="deleteAccountModal"
     tabindex="-1"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title text-danger">Konfirmasi Hapus Akun</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p class="text-muted">
                        Tindakan ini tidak dapat dibatalkan.
                    </p>

                    <div class="mb-3">
                        <label class="form-label">Masukkan Password</label>
                        <input type="password"
                               name="password"
                               class="form-control"
                               required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit"
                            class="btn btn-danger">
                        Ya, Hapus Akun
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- AUTO SUBMIT FOTO --}}
<script>
document.getElementById('photoInput').addEventListener('change', function () {
    if (this.files.length > 0) {
        document.getElementById('photoForm').submit();
    }
});
</script>
@endsection
