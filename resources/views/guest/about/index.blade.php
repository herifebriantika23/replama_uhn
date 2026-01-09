@extends('layouts.guest')

@section('title', 'Tentang Web')

@section('content')

<!-- Quote/testimonial aside-->
<aside class="text-center bg-gradient-primary-to-secondary mt-5" id="about">
    <div class="container px-5">
        <div class="row gx-5 justify-content-center">
            <div class="col-xl-8">
                <div class="h2 fs-1 text-white mb-2">
                    "Platform pengumpulan laporan magang yang terpusat, cepat,
                    dan terorganisir untuk mahasiswa"
                </div>
                <img src="{{ asset('images/logo_uhn.png') }}" alt="Logo UHN" style="height:7rem"/>
            </div>
        </div>
    </div>
</aside>

<!-- Basic features section-->
<section class="bg-light">
    <div class="container px-5">
        <div class="row gx-5 align-items-center justify-content-center justify-content-lg-between">

            <div class="col-12 col-md-10 col-lg-6 mb-5 mb-lg-0">
                <h2 class="display-4 lh-1 mb-4">Membantu Proses Magang Lebih Efektif</h2>
                <p class="lead fw-normal text-muted mb-5 mb-lg-0">
                    Repository Laporan Magang UHN membantu mahasiswa, pembimbing, dan
                    institusi mengelola laporan magang secara lebih terstruktur.
                </p>
            </div>

            <div class="col-12 col-md-8 col-lg-5">
                <img class="img-fluid" src="{{ asset('images/img_3_beranda.png')}}" alt="img_3_beranda"/>
            </div>

        </div>
    </div>
</section>
@endsection
