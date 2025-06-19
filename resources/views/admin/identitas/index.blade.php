@extends('layouts.admin')

@section('title', 'Data Identitas')
@section('page-title', 'Data Identitas')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Data Identitas</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users"></i> Data Identitas User
                </h3>
            </div>
            <div class="card-body">
                <!-- Filter Form -->
                <form method="GET" action="{{ route('admin.identitas.index') }}" class="mb-3">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" name="search" class="form-control" placeholder="Cari nama, email, NIK..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-2">
                            <select name="status" class="form-control">
                                <option value="">Semua Status</option>
                                @foreach($statusOptions as $key => $value)
                                <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="jenis_kelamin" class="form-control">
                                <option value="">Semua Jenis Kelamin</option>
                                @foreach($jenisKelaminOptions as $key => $value)
                                <option value="{{ $key }}" {{ request('jenis_kelamin') == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i> Filter
                            </button>
                            <a href="{{ route('admin.identitas.index') }}" class="btn btn-secondary">
                                <i class="fas fa-refresh"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>

                <!-- Data Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="identitasTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>NIK</th>
                                <th>Jenis Kelamin</th>
                                <th>No. HP</th>
                                <th>Status</th>
                                <th width="200px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($identitas as $index => $item)
                            <tr>
                                <td>{{ $identitas->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $item->user->name }}</strong>
                                </td>
                                <td>{{ $item->user->email }}</td>
                                <td>{{ $item->nik ?? '-' }}</td>
                                <td>
                                    @if($item->jenis_kelamin == 'Laki-laki')
                                    <span class="badge badge-primary">{{ $item->jenis_kelamin }}</span>
                                    @elseif($item->jenis_kelamin == 'Perempuan')
                                    <span class="badge badge-pink">{{ $item->jenis_kelamin }}</span>
                                    @else
                                    <span class="badge badge-secondary">-</span>
                                    @endif
                                </td>
                                <td>{{ $item->no_hp ?? '-' }}</td>
                                <td>
                                    @if($item->status_verifikasi)
                                    @if($item->status_verifikasi == 'terverifikasi')
                                    <span class="badge badge-success">Terverifikasi</span>
                                    @elseif($item->status_verifikasi == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                    @elseif($item->status_verifikasi == 'ditolak')
                                    <span class="badge badge-danger">Ditolak</span>
                                    @else
                                    <span class="badge badge-secondary">Belum Diverifikasi</span>
                                    @endif
                                    @else
                                    <span class="badge badge-secondary">Belum Diverifikasi</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.identitas.show', $item->id) }}" class="btn btn-info btn-sm" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.identitas.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm btn-delete"
                                            data-id="{{ $item->id }}"
                                            data-name="{{ $item->user->name }}"
                                            data-email="{{ $item->user->email }}"
                                            data-nik="{{ $item->nik ?? '-' }}"
                                            title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data identitas.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div> <!-- Pagination -->
                <div class="row mt-3">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" role="status" aria-live="polite">
                            Menampilkan {{ $identitas->firstItem() ?? 0 }} sampai {{ $identitas->lastItem() ?? 0 }}
                            dari {{ $identitas->total() }} total data
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers float-right">
                            {{ $identitas->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteIdentitasModal" tabindex="-1" role="dialog" aria-labelledby="deleteIdentitasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="deleteIdentitasModalLabel">
                    <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus Data Identitas
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="fas fa-user-times fa-3x text-danger mb-3"></i>
                    <h5 class="text-danger">Apakah Anda yakin ingin menghapus data identitas ini?</h5>
                </div>

                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Peringatan:</strong> Tindakan ini tidak dapat dibatalkan!
                </div>

                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Detail Data Identitas yang akan dihapus:</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="30%"><strong>Nama:</strong></td>
                                <td id="delete-identitas-name">-</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td id="delete-identitas-email">-</td>
                            </tr>
                            <tr>
                                <td><strong>NIK:</strong></td>
                                <td id="delete-identitas-nik">-</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    Semua data terkait identitas ini juga akan terhapus
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <form id="deleteIdentitasForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Ya, Hapus Data
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('css')
<style>
    /* AdminLTE Pagination Styling */
    .dataTables_info {
        padding-top: 8px;
        font-size: 0.875rem;
        color: #6c757d;
        font-weight: 400;
    }

    .dataTables_paginate {
        padding-top: 0;
    }

    .dataTables_paginate .pagination {
        margin: 0;
        justify-content: flex-end;
    }

    .pagination .page-link {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        border-color: #dee2e6;
        color: #495057;
        transition: all 0.15s ease-in-out;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
        font-weight: 600;
    }

    .pagination .page-link:hover {
        background-color: #e9ecef;
        border-color: #adb5bd;
        color: #0056b3;
        text-decoration: none;
    }

    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        background-color: #fff;
        border-color: #dee2e6;
        cursor: not-allowed;
    }

    .pagination .page-item:first-child .page-link {
        border-top-left-radius: 0.375rem;
        border-bottom-left-radius: 0.375rem;
    }

    .pagination .page-item:last-child .page-link {
        border-top-right-radius: 0.375rem;
        border-bottom-right-radius: 0.375rem;
    }

    /* Responsive pagination */
    @media (max-width: 768px) {

        .dataTables_info,
        .dataTables_paginate {
            text-align: center !important;
            float: none !important;
            margin-top: 15px;
        }

        .row .col-md-5,
        .row .col-md-7 {
            margin-bottom: 10px;
        }
    }

    @media (max-width: 576px) {
        .pagination .page-link {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }
    }

    /* Custom pink badge for female gender */
    .badge-pink {
        color: #fff;
        background-color: #e91e63;
        border: 1px solid #e91e63;
    }

    .badge-pink:hover {
        background-color: #c2185b;
        border-color: #c2185b;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() { // Initialize DataTable without search and pagination
        var table = $('#identitasTable').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "paging": false,
            "info": false,
            "searching": false,
            "ordering": false // Disable all sorting
        });

        // Delete identitas confirmation with AdminLTE modal
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();

            var id = $(this).data('id');
            var name = $(this).data('name');
            var email = $(this).data('email');
            var nik = $(this).data('nik');

            console.log('Delete button clicked for identitas:', id, name); // Debug log

            // Set form action URL
            $('#deleteIdentitasForm').attr('action', '/admin/identitas/' + id);

            // Fill modal with data
            $('#delete-identitas-name').text(name);
            $('#delete-identitas-email').text(email);
            $('#delete-identitas-nik').text(nik);

            // Show modal
            $('#deleteIdentitasModal').modal('show');
        });
    });
</script>
@endpush