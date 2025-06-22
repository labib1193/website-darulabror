@extends('layouts.admin')

@section('title', 'Data Orangtua - ')
@section('page-title', 'Data Orangtua')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Data Orangtua</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users"></i> Data Orangtua Santri
                </h3>
                <div class="card-tools">
                    <a href="{{ route('admin.orangtua.create') }}" class="btn btn-primary btn-sm">
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
                @endif

                <!-- Data Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="orangtuaTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Jenis Kelamin</th>
                                <th>No. HP</th>
                                <th>Pekerjaan</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orangtua as $index => $item)
                            <tr>
                                <td>{{ $orangtua->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $item->user->name }}</strong><br>
                                    <small class="text-muted">{{ $item->user->email }}</small>
                                </td>
                                <td>{{ $item->nama_lengkap }}</td>
                                <td>
                                    <span class="badge badge-success">{{ $item->status }}</span>
                                </td>
                                <td>
                                    @if($item->jenis_kelamin == 'Laki-laki')
                                    <span class="badge badge-primary">{{ $item->jenis_kelamin }}</span>
                                    @elseif($item->jenis_kelamin == 'Perempuan')
                                    <span class="badge badge-pink">{{ $item->jenis_kelamin }}</span>
                                    @else
                                    <span class="badge badge-secondary">-</span>
                                    @endif
                                </td>
                                <td>{{ $item->no_hp_1 ?? '-' }}</td>
                                <td>{{ $item->pekerjaan ?? '-' }}</td>
                                <td>
                                    @if($item->alamat_lengkap)
                                    {{ Str::limit($item->alamat_lengkap, 50) }}
                                    @else
                                    {{ $item->provinsi ?? '-' }}
                                    @if($item->kabupaten), {{ $item->kabupaten }}@endif
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.orangtua.show', $item->id) }}" class="btn btn-info btn-sm" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.orangtua.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a> <button type="button" class="btn btn-danger btn-sm btn-delete"
                                            data-id="{{ $item->id }}"
                                            data-name="{{ $item->user->name }}"
                                            data-email="{{ $item->user->email }}"
                                            data-status="{{ $item->status }}"
                                            title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-center">Tidak ada data orangtua.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div> <!-- Pagination -->
                <div class="row mt-3">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" role="status" aria-live="polite">
                            Menampilkan {{ $orangtua->firstItem() ?? 0 }} sampai {{ $orangtua->lastItem() ?? 0 }}
                            dari {{ $orangtua->total() }} total data
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers float-right">
                            {{ $orangtua->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteOrangtuaModal" tabindex="-1" role="dialog" aria-labelledby="deleteOrangtuaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="deleteOrangtuaModalLabel">
                    <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus Data Orangtua
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="fas fa-users fa-3x text-danger mb-3"></i>
                    <h5 class="text-danger">Apakah Anda yakin ingin menghapus data orangtua ini?</h5>
                </div>

                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Peringatan:</strong> Tindakan ini tidak dapat dibatalkan!
                </div>

                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Detail Data Orangtua yang akan dihapus:</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="30%"><strong>Nama User:</strong></td>
                                <td id="delete-orangtua-name">-</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td id="delete-orangtua-email">-</td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td id="delete-orangtua-status">-</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    Semua data terkait orangtua ini juga akan terhapus
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <form id="deleteOrangtuaForm" method="POST" class="d-inline">
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
<!-- Admin DataTables Styling -->
<link rel="stylesheet" href="{{ asset('assets/css/admin/datatables.css') }}">
<!-- Admin Custom Components -->
<link rel="stylesheet" href="{{ asset('assets/css/admin/components.css') }}">
@endpush

@push('scripts')
<script>
    $(document).ready(function() { // Initialize DataTable without search and pagination
        var table = $('#orangtuaTable').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "paging": false,
            "info": false,
            "searching": false,
            "ordering": false // Disable all sorting
        }); // Delete orangtua confirmation with AdminLTE modal
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();

            var id = $(this).data('id');
            var name = $(this).data('name');
            var email = $(this).data('email');
            var status = $(this).data('status');

            console.log('Delete button clicked for orangtua:', id, name); // Debug log

            // Set form action URL
            $('#deleteOrangtuaForm').attr('action', '/admin/orangtua/' + id);

            // Fill modal with data
            $('#delete-orangtua-name').text(name);
            $('#delete-orangtua-email').text(email);
            $('#delete-orangtua-status').text(status);

            // Show modal
            $('#deleteOrangtuaModal').modal('show');
        });
    });
</script>
@endpush