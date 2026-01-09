@extends('layouts.app')

@section('title', 'Periode Magang')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Periode Magang</h4>

        <button class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#modalTambahPeriode">
            <i class="bi bi-plus-lg"></i> Tambah Periode
        </button>
    </div>

    <div class="card shadow-sm py-3 px-4">
        <div class="card-body p-0">

            <table id="datatable-periode" class="table table-hover align-middle mb-0">
                <thead class="table-primary">
                    <tr>
                        <th width="50" class="text-center">No</th>
                        <th>Nama Periode</th>
                        <th class="text-center">Mulai</th>
                        <th class="text-center">Selesai</th>
                        <th class="text-center">Status</th>
                        <th width="160" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($periodeMagang as $i => $item)
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>

                        <td class="fw-semibold">
                            {{ $item->nama }}
                        </td>

                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($item->mulai)->format('d M Y') }}
                        </td>

                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($item->selesai)->format('d M Y') }}
                        </td>

                        <td class="text-center">
                            <span class="badge {{ $item->aktif ? 'bg-success' : 'bg-secondary' }}">
                                {{ $item->aktif ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>

                        <td class="text-center">
                            <button class="btn btn-warning btn-sm me-1"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEdit{{ $item->id }}">
                                Edit
                            </button>

                            <button class="btn btn-danger btn-sm"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalHapus{{ $item->id }}">
                                Hapus
                            </button>
                        </td>
                    </tr>

                    {{-- MODAL EDIT --}}
                    <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                <form action="{{ route('admin.periode.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Periode Magang</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label class="form-label">Nama Periode</label>
                                            <input type="text"
                                                   name="nama"
                                                   class="form-control"
                                                   value="{{ $item->nama }}"
                                                   required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Mulai</label>
                                            <input type="date"
                                                   name="mulai"
                                                   class="form-control"
                                                   value="{{ $item->mulai }}"
                                                   required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Tanggal Selesai</label>
                                            <input type="date"
                                                   name="selesai"
                                                   class="form-control"
                                                   value="{{ $item->selesai }}"
                                                   required>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   name="aktif"
                                                   value="1"
                                                   {{ $item->aktif ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                Jadikan Aktif
                                            </label>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button"
                                                class="btn btn-secondary"
                                                data-bs-dismiss="modal">
                                            Batal
                                        </button>
                                        <button type="submit"
                                                class="btn btn-warning">
                                            Simpan
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>

                    {{-- MODAL HAPUS --}}
                    <div class="modal fade" id="modalHapus{{ $item->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                <form action="{{ route('admin.periode.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <div class="modal-header">
                                        <h5 class="modal-title text-danger">Hapus Periode</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body text-center">
                                        Yakin ingin menghapus periode
                                        <strong>{{ $item->nama }}</strong>?
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button"
                                                class="btn btn-secondary"
                                                data-bs-dismiss="modal">
                                            Batal
                                        </button>
                                        <button type="submit"
                                                class="btn btn-danger">
                                            Ya, Hapus
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambahPeriode" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('admin.periode.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Periode Magang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Nama Periode</label>
                        <input type="text"
                               name="nama"
                               class="form-control"
                               placeholder="Contoh: Magang Genap 2026"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="mulai" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" name="selesai" class="form-control" required>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input"
                               type="checkbox"
                               name="aktif"
                               value="1">
                        <label class="form-check-label">
                            Jadikan Aktif
                        </label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit"
                            class="btn btn-primary">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('#datatable-periode').DataTable({
        responsive: true,
        autoWidth: false,

        // Layout: dropdown kiri, search kanan
        dom: '<"row mb-3"<"col-md-6"l><"col-md-6"f>>rt<"row mt-3"<"col-md-6"i><"col-md-6"p>>',

        pageLength: 5,
        lengthMenu: [5, 10, 25, 50, 100],

        language: {
            search: "Cari Periode:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ periode",
            infoEmpty: "Tidak ada data periode",
            zeroRecords: "Periode tidak ditemukan",
            paginate: {
                previous: "‹",
                next: "›"
            }
        },

        columnDefs: [
            { orderable: false, targets: [0, 5] }, // No & Aksi
            { className: "text-center", targets: [0, 2, 3, 4, 5] }
        ]
    });
});
</script>
@endpush



