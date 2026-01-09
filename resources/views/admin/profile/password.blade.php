@extends('layouts.app')

@section('title', 'Kelola Akun')

@section('content')
<div class="container">

    <div class="mb-4">
        <h3 class="fw-semibold">Keamanan Akun</h3>
        <p class="text-muted mb-0">Ubah password dan kelola akun</p>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            {{-- UBAH PASSWORD --}}
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <h5 class="fw-bold mb-3">Ubah Password</h5>

                <div class="mb-3">
                    <label class="form-label">Password Saat Ini</label>
                    <input type="password"
                           name="current_password"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password Baru</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password"
                           name="password_confirmation"
                           class="form-control"
                           required>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    {{-- SIMPAN PASSWORD --}}
                    <button type="submit" class="btn btn-primary">
                        Simpan Password
                    </button>

                    {{-- HAPUS AKUN --}}
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
<div class="modal fade" id="deleteAccountModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title text-danger">Konfirmasi Hapus Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
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
