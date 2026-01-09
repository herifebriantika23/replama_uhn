@extends('layouts.app')

@section('title', 'Kelola Prodi')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">Data Program Studi</h4>

        <button class="btn btn-primary fw-bold"
                data-bs-toggle="modal"
                data-bs-target="#modalTambahProdi">
            <i class="bi bi-plus-lg me-1"></i>
            Tambah Prodi
        </button>
    </div>

    {{-- TABLE --}}
    <div class="card shadow-sm py-3 px-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="datatable-prodi"
                       class="table table-hover align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th width="60" class="text-center">No</th>
                            <th>Nama Prodi</th>
                            <th>Fakultas</th>
                            <th width="180" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($prodi as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="fw-semibold">{{ $item->nama }}</td>
                            <td>{{ $item->fakultas->nama ?? '-' }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning rounded-pill me-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditProdi{{ $item->id }}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>

                                <button class="btn btn-sm btn-danger rounded-pill"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalHapusProdi{{ $item->id }}">
                                    <i class="bi bi-trash"></i> Hapus
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

{{-- ================= MODAL EDIT ================= --}}
@foreach($prodi as $item)
<div class="modal fade" id="modalEditProdi{{ $item->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('admin.prodi.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit Program Studi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Prodi</label>
                        <input type="text"
                               name="nama"
                               class="form-control"
                               value="{{ $item->nama }}"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fakultas</label>
                        <select name="fakultas_id" class="form-select" required>
                            @foreach($fakultas as $fk)
                                <option value="{{ $fk->id }}"
                                    {{ $item->fakultas_id == $fk->id ? 'selected' : '' }}>
                                    {{ $fk->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-warning">
                        Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endforeach

{{-- ================= MODAL HAPUS ================= --}}
@foreach($prodi as $item)
<div class="modal fade" id="modalHapusProdi{{ $item->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('admin.prodi.destroy', $item->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title text-danger">Hapus Program Studi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    Yakin ingin menghapus prodi
                    <strong>{{ $item->nama }}</strong>?
                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        Ya, Hapus
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endforeach

{{-- ================= MODAL TAMBAH ================= --}}
<div class="modal fade" id="modalTambahProdi" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('admin.prodi.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Program Studi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Prodi</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fakultas</label>
                        <select name="fakultas_id" class="form-select" required>
                            <option value="">-- Pilih Fakultas --</option>
                            @foreach($fakultas as $fk)
                                <option value="{{ $fk->id }}">{{ $fk->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

{{-- ================= DATATABLES ================= --}}
@push('scripts')
<script>
$(document).ready(function () {
    $('#datatable-prodi').DataTable({
        responsive: true,
        autoWidth: false,

        dom: '<"row mb-3"<"col-md-6"l><"col-md-6"f>>rt<"row mt-3"<"col-md-6"i><"col-md-6"p>>',

        pageLength: 5,
        lengthMenu: [5, 10, 25, 50, 100],

        language: {
            search: "Cari Prodi:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ program studi",
            infoEmpty: "Tidak ada data",
            zeroRecords: "Program studi tidak ditemukan",
            paginate: {
                previous: "‹",
                next: "›"
            }
        },

        columnDefs: [
            { orderable: false, targets: [0, 3] },
            { className: "text-center", targets: [0, 3] }
        ]
    });
});
</script>
@endpush




