@extends('layouts.auth')

@section('title', 'Login')

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

                {{-- STATUS --}}
                @if (session('status'))
                    <div class="alert alert-success text-center">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- TITLE --}}
                <h3 class="text-white fw-bold text-center mb-2">Login</h3>

                <p class="text-white-50 text-center small my-2">
                    Silakan masuk menggunakan email dan password Anda.
                </p>

                {{-- FORM --}}
                <form method="POST" action="{{ route('login') }}">
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

                    {{-- REMEMBER & FORGOT --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input input-primary"
                                   type="checkbox"
                                   name="remember"
                                   id="remember">
                            <label class="form-check-label text-white"
                                   for="remember">
                                Remember me
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                               class="text-white text-decoration-none ">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    {{-- BUTTON --}}
                    <div class="d-grid mt-3">
                        <button type="submit" class="btn btn-light fw-bold">
                            Login
                        </button>
                    </div>
                </form>

                {{-- REGISTER LINK --}}
                <div class="text-center mt-3">
                    <span class="text-white">Belum punya akun?</span>
                    <a href="{{ route('register') }}"
                       class="fw-semibold text-white ms-1">
                        Register
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection

