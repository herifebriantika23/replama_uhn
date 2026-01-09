@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="container">

    <div class="mb-4">
        <h3 class="fw-semibold">Pengaturan Profil</h3>
        <p class="text-muted mb-0">Kelola informasi akun Anda</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            {{-- FOTO PROFIL --}}
            <div class="text-center mb-4">
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

                        <img src="{{ $user->photo_url }}"
                             class="rounded-circle border"
                             style="width:120px;height:120px;object-fit:cover;">

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

            {{-- FORM PROFIL --}}
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

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

                <button type="submit" class="btn btn-primary">
                    Simpan Perubahan
                </button>
            </form>

        </div>
    </div>
</div>

<script>
document.getElementById('photoInput').addEventListener('change', function () {
    document.getElementById('photoForm').submit();
});
</script>
@endsection

