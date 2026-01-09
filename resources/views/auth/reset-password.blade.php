@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')
<div class="auth-wrapper v3">
    <div class="auth-form">

        {{-- LOGO --}}
        <div class="auth-header d-flex justify-content-center align-items-center text-center mb-4">
            <img src="{{ asset('images/bg_auth.png') }}"
                 alt="Logo"
                 class="img-fluid"
                 style="max-height: 80px;">
        </div>

        {{-- CARD --}}
        <div class="card bg-white bg-opacity-10 border-0 shadow-lg">
            <div class="card-body p-4">

                {{-- TITLE --}}
                <h3 class="text-white fw-bold text-center mb-3">
                    Reset Password
                </h3>

                {{-- DESC --}}
                <p class="text-white-50 text-center small mb-4">
                    Silakan masukkan email dan password baru Anda.
                </p>

                {{-- FORM --}}
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    {{-- TOKEN --}}
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    {{-- EMAIL --}}
                    <div class="mb-3">
                        <label for="email" class="form-label text-white">
                            Email
                        </label>
                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ old('email', $request->email) }}"
                               class="form-control bg-transparent text-white
                                      @error('email') is-invalid @enderror"
                               required autofocus autocomplete="username">

                        @error('email')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- PASSWORD BARU --}}
                    <div class="mb-3">
                        <label for="password" class="form-label text-white">
                            Password Baru
                        </label>
                        <input id="password"
                               type="password"
                               name="password"
                               class="form-control bg-transparent text-white
                                      @error('password') is-invalid @enderror"
                               required autocomplete="new-password">

                        @error('password')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- KONFIRMASI PASSWORD --}}
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label text-white">
                            Konfirmasi Password
                        </label>
                        <input id="password_confirmation"
                               type="password"
                               name="password_confirmation"
                               class="form-control bg-transparent text-white
                                      @error('password_confirmation') is-invalid @enderror"
                               required autocomplete="new-password">

                        @error('password_confirmation')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- BUTTON --}}
                    <div class="d-grid mt-4">
                        <button type="submit"
                                class="btn btn-primary fw-semibold">
                            Reset Password
                        </button>
                    </div>
                </form>

                {{-- BACK TO LOGIN --}}
                <div class="text-center mt-4">
                    <a href="{{ route('login') }}"
                       class="text-white text-decoration-none">
                        ← Kembali ke Login
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection

