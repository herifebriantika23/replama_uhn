@extends('layouts.web')

@section('title', 'Beranda')

@section('content')

{{-- ========== JUMBOTRON + SEARCH + HASIL ========== --}}
<div class="text-white"
     style="
        background:
            linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)),
            url('{{ asset('images/corousel_1.png') }}') center/cover no-repeat;
        min-height: 520px;
        padding: 60px 0;
     ">

    <div class="container text-center">

        <h1 class="display-3 fw-bold">Repository Laporan Magang</h1>

        <p class="lead mb-4">
            Solusi Mudah & Terpusat Kumpul Laporan Magang
        </p>

        {{-- ===== SEARCH FORM ===== --}}
        <form method="GET" action="{{ route('user.beranda') }}"
              class="row justify-content-center gx-2 gy-2 mb-4">

            <div class="col-12 col-md-6">
                <input type="text" name="search"
                       class="form-control form-control-lg rounded-pill ps-4"
                       value="{{ request('search') }}"
                       placeholder="Cari Nama atau NIM...">
            </div>

            <div class="col-6 col-md-auto">
                <button class="btn btn-light btn-lg rounded-pill px-4 w-100">
                    <i class="bi-search"></i> Cari
                </button>
            </div>

        </form>

        {{-- ===== HASIL PENCARIAN (DI JUMBOTRON) ===== --}}
        @if(request()->filled('search'))

            <div class="bg-white text-dark rounded-4 p-4 shadow text-start">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-semibold mb-0">
                        Hasil pencarian:
                        <span class="text-primary">"{{ request('search') }}"</span>
                    </h6>

                    <a href="{{ route('user.beranda') }}"
                       class="btn btn-sm btn-outline-secondary rounded-pill">
                        <i class="bi-x-lg"></i> Bersihkan
                    </a>
                </div>

                @if($laporans->count())

                    <div class="list-group" style="border-radius:12px; overflow:hidden;">
                        @foreach($laporans as $lap)
                            <div class="list-group-item py-3">
                                <div class="row align-items-center gy-3">

                                    <div class="col-12 col-md-9 text-break">
                                        <h6 class="fw-bold mb-1">{{ $lap->judul }}</h6>
                                        <small class="text-muted">
                                            {{ $lap->nama }} ({{ $lap->nim }}) — {{ $lap->prodi }}
                                        </small><br>
                                        <span class="badge bg-primary mt-1">
                                            {{ ucfirst($lap->status) }}
                                        </span>
                                    </div>

                                    <div class="col-12 col-md-3 text-md-end">
                                        <a href="{{ route('user.laporan.pdf', $lap->id) }}"
                                           target="_blank"
                                           class="btn btn-danger rounded-pill px-3 w-100 w-md-auto">
                                            <i class="bi-file-earmark-pdf"></i> PDF
                                        </a>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-3">
                        {{ $laporans->appends(request()->all())->links() }}
                    </div>

                @else
                    <div class="alert alert-warning rounded-pill text-center fw-semibold mb-0">
                        <i class="bi-exclamation-circle"></i>
                        Tidak ditemukan laporan
                    </div>
                @endif

            </div>
        @endif

    </div>
</div>

{{-- ========== LAPORAN TERBARU (MUNCUL SAAT TIDAK SEARCH) ========== --}}
@if(!request()->filled('search'))
<section class="container mb-5 mt-4">
    <h4 class="fw-bold mb-3">Laporan Terbaru Ditambahkan</h4>

    @if($laporanTerbaru->count())
        <div class="list-group" style="border-radius:12px; overflow:hidden;">
            @foreach($laporanTerbaru as $lap)
                <div class="list-group-item d-flex flex-column flex-md-row
                            justify-content-between align-items-start
                            align-items-md-center py-3">

                    <div>
                        <strong>{{ $lap->judul }}</strong><br>
                        <small class="text-muted">
                            Oleh: {{ $lap->user->name ?? '-' }} —
                            {{ $lap->created_at->diffForHumans() }}
                        </small>
                    </div>

                    <div>
                        <a href="{{ asset('storage/' . $lap->file_pdf) }}" target="_blank"
                           class="btn btn-danger rounded-pill px-3 mt-2 mt-md-0">
                            <i class="bi-file-earmark-pdf"></i> PDF
                        </a>
                    </div>

                </div>
            @endforeach
        </div>
    @endif
</section>
@endif

@endsection
