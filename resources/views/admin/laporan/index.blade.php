@extends('layouts.app')

@section('title', 'Kelola Laporan')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">Daftar Laporan Magang</h4>
    </div>

    <div class="card shadow-sm py-3 px-4">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table id="datatable-laporan" class="table table-hover align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Mahasiswa</th>
                            <th>Judul</th>
                            <th>Dosen Pembimbing</th>
                            <th>Periode</th>
                            <th class="text-center">Tgl Upload</th>
                            <th class="text-center">Status</th>
                            <th width="180" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($laporan as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>

                            {{-- MAHASISWA + PRODI + FAKULTAS --}}
                            <td>
                                <strong>{{ $item->user->name }}</strong><br>
                                <small class="text-muted">
                                {{ $item->user->nim }} <br>
                                {{ $item->prodi->nama }} – 
                                <span class="fst-italic">
                                    {{ $item->prodi->fakultas->nama }}
                                </span>
                            </small>
                            </td>

                            <td class="fw-semibold">{{ $item->judul }}</td>
                            <td>{{ $item->dosen_pembimbing }}</td>
                            <td>{{ $item->periodeMagang->nama }}</td>

                            <td class="text-center">
                                {{ $item->created_at->format('d M Y') }}
                            </td>

                            <td class="text-center">
                                <span class="badge 
                                {{ $item->status=='disetujui'
                                    ? 'bg-success'
                                    : ($item->status=='revisi'
                                        ? 'bg-danger'
                                        : 'bg-warning text-dark') }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>

                            <td class="text-center">
                                <button class="btn btn-sm btn-info text-white rounded-pill"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalDetail{{ $item->id }}">
                                        <i class="ti ti-eye"></i>
                                    Detail
                                </button>

                                <button class="btn btn-sm btn-warning rounded-pill d-inline-flex align-items-center gap-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalVerifikasi{{ $item->id }}">
                                    <i class="ti ti-clipboard-check"></i>
                                    Verifikasi
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

{{-- ================= MODAL DETAIL & VERIFIKASI ================= --}}
@foreach($laporan as $item)

{{-- MODAL DETAIL --}}
<div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">Detail Laporan Magang</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <table class="table table-borderless">
                    <tr><th>Nama</th><td>{{ $item->user->name }}</td></tr>
                    <tr><th>NIM</th><td>{{ $item->user->nim }}</td></tr>
                    <tr><th>Program Studi</th><td>{{ $item->prodi->nama }}</td></tr>
                    <tr><th>Fakultas</th><td>{{ $item->prodi->fakultas->nama }}</td></tr>
                    <tr><th>Dosen Pembimbing</th><td>{{ $item->dosen_pembimbing }}</td></tr>
                    <tr><th>Periode</th><td>{{ $item->periodeMagang->nama }}</td></tr>
                    <tr><th>Judul</th><td>{{ $item->judul }}</td></tr>
                    <tr><th>Status</th><td>{{ ucfirst($item->status) }}</td></tr>
                </table>

                <a href="{{ asset('storage/'.$item->file_pdf) }}"
                   target="_blank"
                   class="btn btn-outline-danger btn-sm rounded-pill">
                    Lihat File PDF
                </a>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>

{{-- MODAL VERIFIKASI --}}
<div class="modal fade" id="modalVerifikasi{{ $item->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <form action="{{ route('admin.laporan.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Verifikasi Laporan</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p>
                        <strong>{{ $item->judul }}</strong><br>
                        oleh {{ $item->user->name }}
                    </p>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="menunggu" {{ $item->status=='menunggu'?'selected':'' }}>Menunggu</option>
                            <option value="disetujui" {{ $item->status=='disetujui'?'selected':'' }}>Disetujui</option>
                            <option value="revisi" {{ $item->status=='revisi'?'selected':'' }}>Revisi</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">
                            Catatan <small class="text-muted">(opsional)</small>
                        </label>
                        <textarea name="catatan" class="form-control" rows="4">
{{ $item->catatan }}</textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-warning">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endforeach

@push('scripts')
<script>
$(document).ready(function () {
    $('#datatable-laporan').DataTable({
        responsive: true,
        autoWidth: false,
        dom: '<"row mb-3"<"col-md-6"l><"col-md-6"f>>rt<"row mt-3"<"col-md-6"i><"col-md-6"p>>',
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50, 100],
        language: {
            search: "Cari Laporan:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ laporan",
            infoEmpty: "Tidak ada data laporan",
            zeroRecords: "Laporan tidak ditemukan",
            paginate: { previous: "‹", next: "›" }
        },
        columnDefs: [
            { orderable: false, targets: [0, 7] },
            { className: "text-center", targets: [0, 5, 6, 7] }
        ]
    });
});
</script>
@endpush

@endsection

