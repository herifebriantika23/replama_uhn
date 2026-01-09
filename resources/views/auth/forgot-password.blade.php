@extends('layouts.auth')

@section('title', 'Lupa Password')

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
                    Lupa Password
                </h3>

                {{-- DESC --}}
                <p class="text-white-50 text-center small mb-4">
                    Masukkan email Anda, kami akan mengirimkan link
                    untuk reset password.
                </p>

                {{-- STATUS --}}
                @if (session('status'))
                    <div class="alert alert-success text-center">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- FORM --}}
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    {{-- EMAIL --}}
                    <div class="mb-3">
                        <label class="form-label text-white">
                            Email
                        </label>
                        <input type="email"
                               name="email"
                               value="{{ old('email') }}"
                               class="form-control bg-transparent text-white
                                      @error('email') is-invalid @enderror"
                               required autofocus>

                        @error('email')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- BUTTON --}}
                    <div class="d-grid mt-4">
                        <button type="submit"
                                class="btn btn-light fw-semibold">
                            Kirim Link Reset Password
                        </button>
                    </div>
                </form>

                {{-- BACK TO LOGIN --}}
                <div class="text-center mt-4">
                    <a href="{{ route('login') }}"
                       class="text-white text-decoration-none">
                        Kembali ke Login
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection

