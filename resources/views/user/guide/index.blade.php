@extends('layouts.web')

@section('title', 'Panduan')

@section('content')
<!-- App features section-->
<section class="features">
    <div class="container px-5">
        <div class="row gx-5 align-items-center">

            <div class="col-lg-8 order-lg-1 mb-5 mb-lg-0">
                <div class="container-fluid px-5">

                    <div class="row gx-5">
                        <div class="col-md-6 mb-5 text-center">

                            <i class="bi-upload icon-feature text-gradient d-block mb-3"></i>
                            <h3 class="font-alt">Upload Laporan</h3>
                            <p class="text-muted mb-0">Mahasiswa dapat mengunggah laporan magang secara online tanpa ribet.</p>
                        </div>

                        <div class="col-md-6 mb-5 text-center">
                            <i class="bi-clipboard-data icon-feature text-gradient d-block mb-3"></i>
                            <h3 class="font-alt">Lihat Progress</h3>
                            <p class="text-muted mb-0">Lihat perkembangan laporan dan status review secara real-time.</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-5 mb-md-0 text-center">
                            <i class="bi-archive icon-feature text-gradient d-block mb-3"></i>
                            <h3 class="font-alt">Arsip Aman</h3>
                            <p class="text-muted mb-0">Semua laporan tersimpan rapi dan dapat diakses kembali kapan saja.</p>
                        </div>

                        <div class="col-md-6 text-center">
                            <i class="bi-check2-square icon-feature text-gradient d-block mb-3"></i>
                            <h3 class="font-alt">Penilaian Digital</h3>
                            <p class="text-muted mb-0">Admin dapat mengecek, memberi catatan, dan memverifikasi laporan secara langsung melalui sistem.</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-4 order-lg-0">
                <img class="img-fluid" src="{{ asset('images/img_2_beranda.png') }}" alt="img_2_beranda"/>
            </div>

        </div>
    </div>
</section>
@endsection
