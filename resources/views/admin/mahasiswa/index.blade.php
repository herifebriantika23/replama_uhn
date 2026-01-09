@extends('layouts.app')

@section('title', 'Kelola Mahasiswa')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">Kelola Mahasiswa</h4>
    </div>

    <div class="card shadow-sm py-3 px-4">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table id="datatable-mahasiswa"
                       class="table table-hover align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Program Studi</th>
                            <th>Fakultas</th>
                            <th width="180" class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="fw-semibold">{{ $user->name }}</td>
                            <td>{{ $user->nim ?? '-' }}</td>
                            <td>{{ $user->prodi->nama ?? '-' }}</td>
                            <td>{{ $user->prodi->fakultas->nama ?? '-' }}</td>
                            <td class="text-center">

                                {{-- EDIT --}}
                                <button class="btn btn-sm btn-warning rounded-pill me-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEditMahasiswa{{ $user->id }}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </button>

                                {{-- HAPUS --}}
                                <button class="btn btn-sm btn-danger rounded-pill"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalHapusMahasiswa{{ $user->id }}">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>

                        {{-- ================= MODAL EDIT ================= --}}
                        <div class="modal fade"
                             id="modalEditMahasiswa{{ $user->id }}"
                             tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <form action="{{ route('admin.mahasiswa.update', $user->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Mahasiswa</h5>
                                            <button type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Nama</label>
                                                <input type="text"
                                                       name="name"
                                                       class="form-control"
                                                       value="{{ $user->name }}"
                                                       required>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">NIM</label>
                                                <input type="text"
                                                       name="nim"
                                                       class="form-control"
                                                       value="{{ $user->nim }}">
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

                        {{-- ================= MODAL HAPUS ================= --}}
                        <div class="modal fade"
                             id="modalHapusMahasiswa{{ $user->id }}"
                             tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <form action="{{ route('admin.mahasiswa.destroy', $user->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <div class="modal-header">
                                            <h5 class="modal-title text-danger">
                                                Hapus Mahasiswa
                                            </h5>
                                            <button type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            Yakin ingin menghapus mahasiswa
                                            <strong>{{ $user->name }}</strong>
                                            beserta seluruh laporannya?
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

@push('scripts')
<script>
$(document).ready(function () {
    $('#datatable-mahasiswa').DataTable({
        responsive: true,
        autoWidth: false,
        dom: '<"row mb-3"<"col-md-6"l><"col-md-6"f>>rt<"row mt-3"<"col-md-6"i><"col-md-6"p>>',
        pageLength: 5,
        lengthMenu: [5, 10, 25, 50, 100],
        language: {
            search: "Cari Mahasiswa:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ - _END_ dari _TOTAL_ mahasiswa",
            infoEmpty: "Tidak ada data mahasiswa",
            zeroRecords: "Data mahasiswa tidak ditemukan",
            paginate: {
                previous: "‹",
                next: "›"
            }
        },
        columnDefs: [
            { orderable: false, targets: [4] },
            { className: "text-center", targets: [4] }
        ]
    });
});
</script>
@endpush
@endsection




