@extends('layouts.web')

@section('title', 'Kelola Laporan')

@section('content')
<div class="container py-5 mt-2">

    <div class="card shadow-sm rounded-4 p-4">

        {{-- HEADER --}}
        <div class="row mb-4 align-items-center">
            <div class="col-md-8">
                <h5 class="fw-bold mb-0">Daftar Laporan Magang</h5>
                <small class="text-muted">
                    Gunakan kolom pencarian di tabel untuk mencari laporan
                </small>
            </div>

            <div class="col-md-4 text-md-end text-center">
                <button class="btn btn-primary rounded-pill px-4 py-2 shadow-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#modalUploadLaporan">
                    <i class="ti ti-plus me-1"></i> Upload Laporan
                </button>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="table-responsive">
            <table id="datatable-laporan" class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="40">No</th>
                        <th class="text-center">Judul</th>
                        <th class="text-center">Mahasiswa</th>
                        <th class="text-center">Status</th>
                        <th width="300" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($laporan as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>

                        <td class="fw-semibold">{{ $item->judul }}</td>

                        <td class="small text-muted">
                            <strong>{{ $item->user->name ?? '-' }}</strong><br>
                                NIM: {{ $item->user->nim ?? '-' }}<br>

                            <span class="small text-muted">
                                {{ $item->prodi->nama ?? '-' }},
                                {{ $item->prodi->fakultas->nama ?? '-' }}
                            </span><br>

                            <span class="small text-muted">
                                Periode: {{ $item->periodeMagang->nama ?? '-' }}
                            </span><br>

                            <span class="small text-muted">
                                Dosen: {{ $item->dosen_pembimbing ?? '-' }}
                            </span>
                        </td>

                        <td>
                            @if($item->status === 'disetujui')
                                <span class="badge bg-success">Disetujui</span>
                            @elseif($item->status === 'revisi')
                                <span class="badge bg-danger">Revisi</span>
                            @else
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @endif
                        </td>

                        <td class="text-center">
                            {{-- DETAIL --}}
                            <button class="btn btn-info btn-sm rounded-pill text-white"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalDetail{{ $item->id }}">
                                <i class="ti ti-eye me-1"></i> Detail
                            </button>

                            {{-- REVISI --}}
                            @if($item->status === 'revisi')
                            <button class="btn btn-warning btn-sm rounded-pill"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalRevisi{{ $item->id }}">
                                <i class="ti ti-edit me-1"></i> Revisi
                            </button>
                            @endif

                            {{-- HAPUS --}}
                            @if($item->status !== 'disetujui')
                            <button class="btn btn-danger btn-sm rounded-pill"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalHapus{{ $item->id }}">
                                <i class="ti ti-trash me-1"></i> Hapus
                            </button>
                            @endif
                        </td>
                    </tr>

                    {{-- ================= MODAL DETAIL ================= --}}
                    <div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1">
                        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content rounded-4 shadow">

                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold">
                                        <i class="ti ti-file-text me-1"></i> Detail Laporan
                                    </h5>
                                    <button class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body px-4">
                                    <p><strong>Judul:</strong> {{ $item->judul }}</p>
                                    <p><strong>Mahasiswa:</strong>
                                        {{ $item->user->name ?? '-' }}
                                        ({{ $item->user->nim ?? '-' }})
                                    </p>
                                    <p><strong>Status:</strong>
                                        <span class="badge bg-info">{{ ucfirst($item->status) }}</span>
                                    </p>
                                    <p><strong>Catatan Admin:</strong><br>
                                        {{ $item->catatan ?? '-' }}
                                    </p>

                                    <hr>

                                    <div class="ratio ratio-16x9 border rounded">
                                        <iframe src="{{ asset('storage/'.$item->file_pdf) }}"></iframe>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <a href="{{ asset('storage/'.$item->file_pdf) }}"
                                       target="_blank"
                                       class="btn btn-primary rounded-pill">
                                        <i class="ti ti-eye me-1"></i> Buka Tab Baru
                                    </a>
                                    <button class="btn btn-danger rounded-pill"
                                            data-bs-dismiss="modal">Tutup</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- ================= MODAL REVISI ================= --}}
                    @if($item->status === 'revisi')
                    <div class="modal fade" id="modalRevisi{{ $item->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content rounded-4 shadow">

                                <form method="POST"
                                      action="{{ route('user.laporan.revisi', $item->id) }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="modal-header">
                                        <h5 class="modal-title fw-bold">
                                            <i class="ti ti-upload me-1"></i> Upload Revisi
                                        </h5>
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body px-4">
                                        <p><strong>Judul:</strong> {{ $item->judul }}</p>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">File Revisi (PDF)</label>
                                            <input type="file"
                                                   name="file_pdf"
                                                   class="form-control"
                                                   accept="application/pdf"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button"
                                                class="btn btn-danger rounded-pill"
                                                data-bs-dismiss="modal">Batal</button>
                                        <button class="btn btn-warning rounded-pill">
                                            <i class="ti ti-send me-1"></i> Kirim
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- ================= MODAL HAPUS ================= --}}
                    @if($item->status !== 'disetujui')
                    <div class="modal fade" id="modalHapus{{ $item->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-4 shadow">

                                <form method="POST"
                                      action="{{ route('user.laporan.destroy', $item->id) }}">
                                    @csrf
                                    @method('DELETE')

                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">
                                            <i class="ti ti-alert-triangle me-1"></i> Konfirmasi Hapus
                                        </h5>
                                    </div>

                                    <div class="modal-body text-center">
                                        Yakin ingin menghapus laporan:
                                        <h6 class="fw-bold text-danger mt-2">
                                            {{ $item->judul }}
                                        </h6>
                                    </div>

                                    <div class="modal-footer justify-content-center">
                                        <button type="button"
                                                class="btn btn-primary rounded-pill"
                                                data-bs-dismiss="modal">Batal</button>
                                        <button class="btn btn-danger rounded-pill">
                                            <i class="ti ti-trash me-1"></i> Hapus
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    @endif

                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

{{-- ================= MODAL UPLOAD LAPORAN ================= --}}
<div class="modal fade" id="modalUploadLaporan" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-4 shadow">

            <form method="POST"
                  action="{{ route('user.laporan.store') }}"
                  enctype="multipart/form-data">
                @csrf

                {{-- HEADER --}}
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">
                        <i class="ti ti-upload me-1"></i> Upload Laporan Magang
                    </h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                {{-- BODY --}}
                <div class="modal-body px-4" style="max-height:65vh; overflow-y:auto;">

                    {{-- Nama --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Nama Mahasiswa</label>
                        <input type="text"
                               class="form-control rounded-pill bg-light"
                               value="{{ Auth::user()->name }}"
                               readonly>
                    </div>

                    {{-- NIM --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">NIM</label>
                        <input type="text"
                               class="form-control rounded-pill bg-light"
                               value="{{ Auth::user()->nim }}"
                               readonly>
                    </div>

                    {{-- Fakultas --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Fakultas</label>
                        <select name="fakultas_id"
                                class="form-select rounded-pill"
                                required>
                            <option value="">-- Pilih Fakultas --</option>
                            @foreach($fakultas as $fk)
                                <option value="{{ $fk->id }}">
                                    {{ $fk->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Prodi --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Program Studi</label>
                        <select name="prodi_id"
                                class="form-select rounded-pill"
                                required>
                            <option value="">-- Pilih Program Studi --</option>
                            @foreach($prodis as $prodi)
                                <option value="{{ $prodi->id }}">
                                    {{ $prodi->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Periode --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Periode Magang</label>
                        <select name="periode_magang_id"
                                class="form-select rounded-pill"
                                required>
                            <option value="">-- Pilih Periode --</option>
                            @foreach($periodes as $periode)
                                <option value="{{ $periode->id }}">
                                    {{ $periode->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Dosen --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Dosen Pembimbing</label>
                        <input type="text"
                               name="dosen_pembimbing"
                               class="form-control rounded-pill"
                               required>
                    </div>

                    {{-- Judul --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Judul Laporan</label>
                        <input type="text"
                               name="judul"
                               class="form-control rounded-pill"
                               required>
                    </div>

                    {{-- File --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Upload File PDF</label>
                        <input type="file"
                               name="file_pdf"
                               class="form-control rounded-pill"
                               accept="application/pdf"
                               required>
                        <small class="text-muted">PDF maksimal 5MB</small>
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-danger rounded-pill px-4"
                            data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit"
                            class="btn btn-primary rounded-pill px-4">
                        <i class="ti ti-upload me-1"></i> Upload
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
    $('#datatable-laporan').DataTable({
        responsive: true,
        autoWidth: false,
        pageLength: 5,
        lengthMenu: [5, 10, 25, 50],
        language: {
            search: "Cari laporan:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ laporan",
            infoEmpty: "Tidak ada laporan",
            zeroRecords: "Laporan tidak ditemukan",
            paginate: { previous: "‹", next: "›" }
        },
        columnDefs: [
            { orderable: false, targets: [4] },
            { className: "text-center", targets: [0,4] }
        ]
    });
});
</script>
@endpush
