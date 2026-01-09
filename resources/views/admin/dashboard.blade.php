@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- BANNER --}}
<div class="card welcome-banner border-0 shadow-sm mb-4">
    <div class="card-body py-4">
        <div class="row align-items-center">
            
            {{-- TEKS --}}
            <div class="col-md-6 mb-3 mb-md-0">
                <h3 class="fw-bold mb-2 text-white">Selamat Datang, {{ Auth::user()->name }}</h3>
                <p class="mb-3 text-white">
                    Kelola laporan magang mahasiswa, pantau status, dan perbarui dokumen kapan saja.
                </p>

                <a href="{{ route('admin.laporan.index') }}" class="btn btn-light fw-semibold">
                    Cek Laporan 
                </a>
            </div>

            {{-- GAMBAR --}}
            <div class="col-md-6 text-center">
                <img src="{{ asset('images/bg-banner.png') }}"
                    alt="Dashboard Banner"
                    class="img-fluid"
                    style="max-height: 260px;">
            </div>

        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h6>Total Fakultas</h6>
                <h3>{{ $totalFakultas }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h6>Total Prodi</h6>
                <h3>{{ $totalProdi }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h6>Total Laporan</h6>
                <h3>{{ $totalLaporan }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header fw-semibold">Status Laporan</div>
    <div class="card-body">
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between">
                Menunggu <span class="badge bg-warning">{{ $laporanMenunggu }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                Disetujui <span class="badge bg-success">{{ $laporanDisetujui }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between">
                Revisi <span class="badge bg-danger">{{ $laporanRevisi }}</span>
            </li>
        </ul>
    </div>
</div>
@endsection

