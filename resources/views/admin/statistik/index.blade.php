@extends('layouts.app')

@section('title', 'Statistik Laporan')

@section('content')
<div class="container">
    <h4 class="mb-4">Laporan Statistik</h4>

    {{-- CARD SUMMARY --}}
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card text-center border-primary">
                <div class="card-body">
                    <h6>Total Laporan</h6>
                    <h3>{{ $total }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center border-success">
                <div class="card-body">
                    <h6>Disetujui</h6>
                    <h3 class="text-success">{{ $disetujui }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center border-warning">
                <div class="card-body">
                    <h6>Menunggu</h6>
                    <h3 class="text-warning">{{ $menunggu }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center border-danger">
                <div class="card-body">
                    <h6>Revisi</h6>
                    <h3 class="text-danger">{{ $revisi }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- CHARTS --}}
    <div class="row g-4">

         {{-- LINE CHART --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Trend Laporan per Bulan</div>
                <div class="card-body">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>

        {{-- BAR CHART --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Perbandingan Status (Bar)</div>
                <div class="card-body">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>

        {{-- PIE CHART --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Perbandingan Status (Pie)</div>
                <div class="card-body">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>

        {{-- DOUGHNUT CHART --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Perbandingan Status (Doughnut)</div>
                <div class="card-body">
                    <canvas id="doughnutChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script>
    // DATA dari backend
    const dataStatus = {
        labels: ['Disetujui', 'Menunggu', 'Revisi'],
        values: [{{ $disetujui }}, {{ $menunggu }}, {{ $revisi }}]
    };

    // PIE
    new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
            labels: dataStatus.labels,
            datasets: [{
                data: dataStatus.values,
                backgroundColor: ['#28a745','#ffc107','#dc3545']
            }]
        }
    });

    // BAR
    new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: dataStatus.labels,
            datasets: [{
                data: dataStatus.values,
                backgroundColor: ['#28a745','#ffc107','#dc3545']
            }]
        }
    });

    // DOUGHNUT
    new Chart(document.getElementById('doughnutChart'), {
        type: 'doughnut',
        data: {
            labels: dataStatus.labels,
            datasets: [{
                data: dataStatus.values,
                backgroundColor: ['#28a745','#ffc107','#dc3545']
            }]
        }
    });

    // LINE (contoh, nanti bisa isi dari database)
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul'],
            datasets: [{
                label: 'Jumlah Laporan',
                data: [5, 7, 4, 9, 10, 6, 8],
                borderColor: '#007bff',
                tension: 0.4
            }]
        }
    });
</script>
@endpush
