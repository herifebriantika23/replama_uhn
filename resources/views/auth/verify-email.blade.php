@extends('layouts.auth')

@section('title', 'Verifikasi Email')

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
                    Verifikasi Email
                </h3>

                {{-- DESC --}}
                <p class="text-white-50 text-center small mb-4">
                    Terima kasih telah mendaftar. Silakan verifikasi alamat email Anda
                    dengan mengklik tautan yang kami kirimkan.
                    Jika belum menerima email, kami bisa mengirimkannya ulang.
                </p>

                {{-- STATUS --}}
                @if (session('status') === 'verification-link-sent')
                    <div class="alert alert-success text-center">
                        Link verifikasi baru telah dikirim ke email Anda.
                    </div>
                @endif

                {{-- ACTIONS --}}
                <div class="d-flex justify-content-between align-items-center gap-2 mt-4">

                    {{-- RESEND --}}
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit"
                                class="btn btn-primary fw-semibold">
                            Kirim Ulang Email Verifikasi
                        </button>
                    </form>

                    {{-- LOGOUT --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="btn btn-outline-light fw-semibold">
                            Logout
                        </button>
                    </form>

                </div>

                {{-- BACK TO LOGIN (OPSIONAL) --}}
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
