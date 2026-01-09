@extends('layouts.app')

@section('title', 'Kelola Fakultas')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">Data Fakultas</h4>

        <button class="btn btn-primary fw-bold"
                data-bs-toggle="modal"
                data-bs-target="#modalTambahFakultas">
            <i class="bi bi-plus-lg me-1"></i>
            Tambah Fakultas
        </button>
    </div>

    {{-- TABLE --}}
    <div class="card shadow-sm py-3 px-4">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table id="datatable-fakultas"
                       class="table table-hover align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th width="60" class="text-center">No</th>
                            <th>Nama Fakultas</th>
                            <th width="180" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($fakultas as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="fw-semibold">{{ $item->nama }}</td>
                            <td class="text-center">

                                {{-- EDIT --}}
                                <button class="btn btn-sm btn-warning rounded-pill me-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEdit{{ $item->id }}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>

                                {{-- HAPUS --}}
                                <button class="btn btn-sm btn-danger rounded-pill"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalHapus{{ $item->id }}">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>

                        {{-- MODAL EDIT --}}
                        <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form action="{{ route('admin.fakultas.update', $item->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Fakultas</h5>
                                            <button type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            <label class="form-label">Nama Fakultas</label>
                                            <input type="text"
                                                   name="nama"
                                                   class="form-control"
                                                   value="{{ $item->nama }}"
                                                   required>
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
                                    <form action="{{ route('admin.fakultas.destroy', $item->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <div class="modal-header">
                                            <h5 class="modal-title text-danger">Hapus Fakultas</h5>
                                            <button type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            Yakin ingin menghapus fakultas
                                            <strong>{{ $item->nama }}</strong> ?
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
</div>

{{-- MODAL TAMBAH --}}
<div class="modal fade" id="modalTambahFakultas" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.fakultas.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Fakultas</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <label class="form-label">Nama Fakultas</label>
                    <input type="text"
                           name="nama"
                           class="form-control"
                           placeholder="Masukkan nama fakultas"
                           required>
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
$('#datatable-fakultas').DataTable({
    responsive: {
        details: {
            type: 'column',
            target: 'tr'
        }
    },
    autoWidth: false,
    pageLength: 5,
    lengthMenu: [5, 10, 25, 50, 100],
    dom:
    '<"row g-2 mb-2"' +
    '<"col-12 col-md-6"l>' +
    '<"col-12 col-md-6"f>' +
    '>rt' +
    '<"row g-2 mt-2"' +
    '<"col-12 col-md-6"i>' +
    '<"col-12 col-md-6"p>' +
    '>',
    language: {
        search: "Cari:",
        lengthMenu: "Tampilkan _MENU_ data",
        info: "_START_ - _END_ dari _TOTAL_ fakultas",
        zeroRecords: "Data tidak ditemukan",
        paginate: {
            previous: "‹",
            next: "›"
        }
    },
    columnDefs: [
        { responsivePriority: 1, targets: 1 }, // Nama Fakultas
        { responsivePriority: 2, targets: 2 }, // Aksi
        { orderable: false, targets: [0, 2] },
        { className: "text-center", targets: [0, 2] }
    ]
});
</script>
@endpush
