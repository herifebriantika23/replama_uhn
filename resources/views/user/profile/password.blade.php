@extends('layouts.web')

@section('title', 'Kelola Akun')

@section('content')
<div class="container py-4">

    <div class="mb-4">
        <h3 class="fw-semibold">Ubah Password</h3>
        <p class="text-muted mb-0">
            Pastikan password baru kuat dan mudah diingat
        </p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                {{-- Password Lama --}}
                <div class="mb-3">
                    <label class="form-label">Password Saat Ini</label>
                    <input type="password"
                           name="current_password"
                           class="form-control @error('current_password') is-invalid @enderror"
                           required>
                    @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password Baru --}}
                <div class="mb-3">
                    <label class="form-label">Password Baru</label>
                    <input type="password"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Konfirmasi --}}
                <div class="mb-4">
                    <label class="form-label">Konfirmasi Password Baru</label>
                    <input type="password"
                           name="password_confirmation"
                           class="form-control"
                           required>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('profile.edit') }}"
                       class="btn btn-secondary">
                        Kembali
                    </a>

                    <div class="d-flex gap-2">
                        <button type="button"
                                class="btn btn-outline-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteAccountModal">
                            Hapus Akun
                        </button>

                        <button type="submit"
                                class="btn btn-primary">
                            Simpan Password
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- MODAL HAPUS AKUN --}}
<div class="modal fade"
     id="deleteAccountModal"
     tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title text-danger">
                        Konfirmasi Hapus Akun
                    </h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p class="text-muted">
                        Tindakan ini <strong>tidak dapat dibatalkan</strong>.
                        Semua data akan dihapus permanen.
                    </p>

                    <label class="form-label">Masukkan Password</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           required>
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
@endsection
