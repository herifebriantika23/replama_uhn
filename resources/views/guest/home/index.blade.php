@extends('layouts.guest')

@section('title', 'Beranda')

@section('content')
<!-- Mashead header-->
<header class="masthead">
    <div class="container px-5">
        <div class="row gx-5 align-items-center">

            <div class="col-lg-6">
                <div class="mb-5 mb-lg-0 text-center text-lg-start">
                    <h1 class="display-4 lh-1 mb-3">Solusi Mudah Kumpul Laporan Magang</h1>
                    <p class="lead fw-normal text-muted mb-4">
                        Sistem ini dirancang untuk mendukung pengumpulan laporan magang, pemantauan progres mahasiswa, serta proses evaluasi dan verifikasi laporan oleh admin secara sistematis.
                    </p>

                    <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4 py-2">
                        Mulai Sekarang
                    </a>
                </div>
            </div>

            <div class="col-lg-6 text-center text-lg-end mb-5">
                <img class="img-fluid" src="{{ asset('images/img_1_beranda.png') }}" alt="img_1_beranda"/>
            </div>

        </div>
    </div>
</header>

<!-- Call to action section-->
<section class="cta">
    <div class="cta-content">
        <div class="container px-5 text-center">
            <h2 class="text-white display-4 lh-1 mb-4">
                Siap Mulai? <br> Mulai telusuri laporan dan kelola data magang Anda dengan mudah.
            </h2>

            <a class="btn btn-outline-light py-3 px-4 rounded-pill" href="{{ route('login') }}">
                Telusuri Repository Sekarang
            </a>
        </div>
    </div>
</section>

<!-- Logo UHN badge section -->
<section class="bg-gradient-primary-to-secondary py-5">
    <div class="container px-5 text-center">
        <img src="{{ asset('Images/logo_uhn.png') }}" class="img-fluid mb-3" style="max-width:180px"/>

        <h2 class="text-white font-alt mb-2">Repository Laporan Magang UHN IGBS</h2>
        <p class="text-white-50 mb-0">Repository Magang Terpusat, Mudah, Efektif</p>
    </div>
</section>

@endsection






