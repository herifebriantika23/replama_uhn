@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="auth-wrapper v3">
    <div class="auth-form">

        {{-- HEADER --}}
        <div class="auth-header d-flex justify-content-center align-items-center text-center mb-4">
            <img src="{{ asset('images/bg_auth.png') }}"
                alt="Logo"
                class="img-fluid"
                style="max-height: 80px;">
        </div>

        {{-- CARD --}}
        <div class="card bg-white bg-opacity-10 border-0 shadow-lg">
            <div class="card-body">

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- TITLE --}}
                    <h3 class="text-white fw-bold text-center mb-2">Register</h3>

                    <p class="text-white-50 text-center small my-3">
                        Silakan isi data berikut untuk membuat akun baru.
                    </p>

                    {{-- NAMA LENGKAP --}}
                    <div class="mb-3">
                        <label class="form-label text-white">
                            Nama Lengkap
                        </label>
                        <input type="text"
                            name="name"
                            class="form-control bg-transparent text-white
                                    @error('name') is-invalid @enderror"
                            value="{{ old('name') }}"
                            required>
                    </div>

                    {{-- EMAIL --}}
                    <div class="mb-3">
                        <label class="form-label text-white">
                            Email
                        </label>
                        <input type="email"
                            name="email"
                            class="form-control bg-transparent text-white
                                    @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            required>
                    </div>

                    {{-- PASSWORD --}}
                    <div class="mb-3">
                        <label class="form-label text-white">
                            Password
                        </label>
                        <input type="password"
                            name="password"
                            class="form-control bg-transparent text-white
                                    @error('password') is-invalid @enderror"
                            required>
                    </div>

                    {{-- KONFIRMASI PASSWORD --}}
                    <div class="mb-3">
                        <label class="form-label text-white">
                            Konfirmasi Password
                        </label>
                        <input type="password"
                            name="password_confirmation"
                            class="form-control bg-transparent text-white"
                            required>
                    </div>

                    {{-- BUTTON --}}
                    <div class="d-grid mt-3">
                        <button type="submit" class="btn btn-light fw-bold">
                            Register
                        </button>
                    </div>
                </form>

                {{-- LOGIN LINK --}}
                <div class="text-center mt-3">
                    <span class="text-white">Sudah punya akun?</span>
                    <a href="{{ route('login') }}"
                       class="fw-semibold text-white ms-1">
                        Login
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection





