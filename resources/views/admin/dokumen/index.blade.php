@extends('layouts.admin')

@section('title', 'Data Dokumen')
@section('page-title', 'Data Dokumen')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Data Dokumen</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-file-alt"></i> Data Dokumen Santri
                </h3>
                <div class="card-tools">
                    <a href="{{ route('admin.dokumen.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session('error') }}
                </div>
                @endif <!-- Data Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="dokumenTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Foto KTP</th>
                                <th>Foto Ijazah</th>
                                <th>Surat Sehat</th>
                                <th>Foto KK</th>
                                <th>Pas Foto</th>
                                <th>Status Verifikasi</th>
                                <th width="200px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dokumen as $index => $item)
                            <tr>
                                <td>{{ $dokumen->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $item->user->name }}</strong><br>
                                    <small class="text-muted">{{ $item->user->email }}</small><br>
                                    <div class="mt-1">
                                        <div class="progress" style="height: 15px;">
                                            <div class="progress-bar bg-primary" role="progressbar" data-width="{{ $item->getCompletionPercentage() }}">
                                                {{ $item->getCompletionPercentage() }}%
                                            </div>
                                        </div>
                                        <small class="text-muted">{{ array_sum([
                                            !empty($item->foto_ktp) ? 1 : 0,
                                            !empty($item->foto_ijazah) ? 1 : 0,
                                            !empty($item->surat_sehat) ? 1 : 0,
                                            !empty($item->foto_kk) ? 1 : 0,
                                            !empty($item->pas_foto) ? 1 : 0
                                        ]) }}/5 dokumen</small>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if($item->foto_ktp)
                                    <span class="badge badge-success">
                                        <i class="fas fa-check"></i> Ada
                                    </span>
                                    @else
                                    <span class="badge badge-danger">
                                        <i class="fas fa-times"></i> Tidak Ada
                                    </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($item->foto_ijazah)
                                    <span class="badge badge-success">
                                        <i class="fas fa-check"></i> Ada
                                    </span>
                                    @else
                                    <span class="badge badge-danger">
                                        <i class="fas fa-times"></i> Tidak Ada
                                    </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($item->surat_sehat)
                                    <span class="badge badge-success">
                                        <i class="fas fa-check"></i> Ada
                                    </span>
                                    @else
                                    <span class="badge badge-danger">
                                        <i class="fas fa-times"></i> Tidak Ada
                                    </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($item->foto_kk)
                                    <span class="badge badge-success">
                                        <i class="fas fa-check"></i> Ada
                                    </span>
                                    @else
                                    <span class="badge badge-danger">
                                        <i class="fas fa-times"></i> Tidak Ada
                                    </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($item->pas_foto)
                                    <span class="badge badge-success">
                                        <i class="fas fa-check"></i> Ada
                                    </span>
                                    @else
                                    <span class="badge badge-danger">
                                        <i class="fas fa-times"></i> Tidak Ada
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->status_verifikasi == 'approved')
                                    <span class="badge badge-success">
                                        <i class="fas fa-check-circle"></i> Disetujui
                                    </span>
                                    @elseif($item->status_verifikasi == 'rejected')
                                    <span class="badge badge-danger">
                                        <i class="fas fa-times-circle"></i> Ditolak
                                    </span>
                                    @else
                                    <span class="badge badge-warning">
                                        <i class="fas fa-clock"></i> Pending
                                    </span>
                                    @endif

                                    @if($item->catatan_verifikasi)
                                    <br><small class="text-muted">{{ Str::limit($item->catatan_verifikasi, 30) }}</small>
                                    @endif

                                    <br><small class="text-muted">{{ $item->updated_at->format('d/m/Y H:i') }}</small>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.dokumen.show', $item->id) }}" class="btn btn-info btn-sm" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.dokumen.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm btn-delete"
                                            data-id="{{ $item->id }}"
                                            data-name="{{ $item->user->name }}"
                                            data-email="{{ $item->user->email }}"
                                            data-status="{{ $item->status_verifikasi }}"
                                            title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data dokumen.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div> <!-- Pagination -->
                <div class="row mt-3">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" role="status" aria-live="polite">
                            Menampilkan {{ $dokumen->firstItem() ?? 0 }} sampai {{ $dokumen->lastItem() ?? 0 }}
                            dari {{ $dokumen->total() }} total data
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers float-right">
                            {{ $dokumen->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteDokumenModal" tabindex="-1" role="dialog" aria-labelledby="deleteDokumenModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="deleteDokumenModalLabel">
                    <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus Data Dokumen
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="fas fa-file-times fa-3x text-danger mb-3"></i>
                    <h5 class="text-danger">Apakah Anda yakin ingin menghapus data dokumen ini?</h5>
                </div>

                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Peringatan:</strong> Tindakan ini tidak dapat dibatalkan!
                </div>

                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Detail Data Dokumen yang akan dihapus:</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="30%"><strong>Nama User:</strong></td>
                                <td id="delete-dokumen-name">-</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td id="delete-dokumen-email">-</td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    <span id="delete-dokumen-status" class="badge">-</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    Semua file dokumen yang terkait juga akan terhapus dari server
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <form id="deleteDokumenForm" method="POST" class="d-inline">
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
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Set progress bar width from data attribute
        $('.progress-bar[data-width]').each(function() {
            var width = $(this).data('width');
            $(this).css('width', width + '%');
        }); // Initialize DataTable without search and pagination
        var table = $('#dokumenTable').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "paging": false,
            "info": false,
            "searching": false,
            "ordering": false // Disable all sorting
        });

        // Delete dokumen confirmation with AdminLTE modal
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();

            var id = $(this).data('id');
            var name = $(this).data('name');
            var email = $(this).data('email');
            var status = $(this).data('status');

            console.log('Delete button clicked for dokumen:', id, name); // Debug log

            // Set form action URL
            $('#deleteDokumenForm').attr('action', '/admin/dokumen/' + id);

            // Fill modal with data
            $('#delete-dokumen-name').text(name);
            $('#delete-dokumen-email').text(email);

            // Set status badge with appropriate color
            var statusBadge = $('#delete-dokumen-status');
            statusBadge.removeClass('badge-success badge-warning badge-danger');

            if (status === 'approved') {
                statusBadge.addClass('badge-success').text('Disetujui');
            } else if (status === 'rejected') {
                statusBadge.addClass('badge-danger').text('Ditolak');
            } else {
                statusBadge.addClass('badge-warning').text('Pending');
            }

            // Show modal
            $('#deleteDokumenModal').modal('show');
        });
    });
</script>
@endpush