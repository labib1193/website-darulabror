@extends('layouts.admin')

@section('title', 'Data Pembayaran')
@section('page-title', 'Data Pembayaran')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Data Pembayaran</li>
@endsection

@section('content')
<!-- Statistics Cards -->
<div class="row mb-3">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $stats['total'] }}</h3>
                <p>Total Pembayaran</p>
            </div>
            <div class="icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $stats['pending'] }}</h3>
                <p>Menunggu Verifikasi</p>
            </div>
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $stats['approved'] }}</h3>
                <p>Disetujui</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $stats['rejected'] }}</h3>
                <p>Ditolak</p>
            </div>
            <div class="icon">
                <i class="fas fa-times-circle"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pembayaran Santri</h3>
                <!-- <div class="card-tools">
                    <a href="{{ route('admin.pembayaran.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Data
                    </a>
                </div> -->
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
                @endif <!-- Filter and Search -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <form method="GET" action="{{ route('admin.pembayaran.index') }}" class="form-inline">
                            <div class="form-group mr-2">
                                <select name="status" class="form-control form-control-sm">
                                    <option value="">Semua Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>
                            <div class="form-group mr-2">
                                <input type="date" name="start_date" class="form-control form-control-sm" value="{{ request('start_date') }}" placeholder="Tanggal Mulai">
                            </div>
                            <div class="form-group mr-2">
                                <input type="date" name="end_date" class="form-control form-control-sm" value="{{ request('end_date') }}" placeholder="Tanggal Selesai">
                            </div>
                            <div class="form-group mr-2">
                                <input type="text" name="search" class="form-control form-control-sm" value="{{ request('search') }}" placeholder="Cari nama atau email...">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm mr-2">
                                <i class="fas fa-search"></i> Filter
                            </button>
                            <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-undo"></i> Reset
                            </a>
                        </form>
                    </div>
                </div>

                <!-- Data Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="pembayaranTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Kode Pembayaran</th>
                                <th>Data Santri</th>
                                <th>Jenis Pembayaran</th>
                                <th>Nominal</th>
                                <th>Bank & Pengirim</th>
                                <th>Tanggal Transfer</th>
                                <th>Status Verifikasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pembayaran as $index => $item)
                            <tr>
                                <td>{{ $pembayaran->firstItem() + $index }}</td>
                                <td>
                                    <strong class="text-primary">{{ $item->kode_pembayaran }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $item->jenis_pembayaran_label }}</small>
                                </td>
                                <td>
                                    <strong>{{ $item->user->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $item->user->email }}</small>
                                </td>
                                <td>
                                    <span class="badge badge-secondary">{{ $item->jenis_pembayaran_label }}</span>
                                </td>
                                <td>
                                    <strong class="text-success">Rp.{{ number_format($item->nominal, 0, ',', '.') }}</strong>
                                    @if($item->nominal != $item->jumlah_tagihan)
                                    <br>
                                    <small class="text-warning">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Berbeda dari tagihan
                                    </small>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $item->bank_pengirim }}</strong>
                                    <br>
                                    <small class="text-muted">{{ $item->nama_pengirim }}</small>
                                </td>
                                <td>{{ $item->tanggal_transfer->format('d/m/Y') }}</td>
                                <td>
                                    @if($item->status_verifikasi == 'approved')
                                    <span class="badge badge-success">
                                        <i class="fas fa-check-circle"></i> Disetujui
                                    </span>
                                    @if($item->verifiedBy)
                                    <br><small class="text-muted">oleh {{ $item->verifiedBy->name }}</small>
                                    <br><small class="text-muted">{{ $item->verified_at->format('d/m/Y H:i') }}</small>
                                    @endif
                                    @elseif($item->status_verifikasi == 'rejected')
                                    <span class="badge badge-danger">
                                        <i class="fas fa-times-circle"></i> Ditolak
                                    </span>
                                    @if($item->verifiedBy)
                                    <br><small class="text-muted">oleh {{ $item->verifiedBy->name }}</small>
                                    <br><small class="text-muted">{{ $item->verified_at->format('d/m/Y H:i') }}</small>
                                    @endif
                                    @else
                                    <span class="badge badge-warning">
                                        <i class="fas fa-clock"></i> Pending
                                    </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.pembayaran.show', $item->id) }}" class="btn btn-primary btn-sm" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <!-- <a href="{{ route('admin.pembayaran.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a> -->
                                        <button type="button" class="btn btn-danger btn-sm btn-delete"
                                            data-id="{{ $item->id }}"
                                            data-kode="{{ $item->kode_pembayaran }}"
                                            data-nama="{{ $item->user->name }}"
                                            data-email="{{ $item->user->email }}"
                                            data-nominal="{{ number_format($item->nominal, 0, ',', '.') }}"
                                            data-status="{{ $item->status_verifikasi }}"
                                            title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data pembayaran.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div> <!-- Pagination -->
                <div class="row mt-3">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" role="status" aria-live="polite">
                            Menampilkan {{ $pembayaran->firstItem() ?? 0 }} sampai {{ $pembayaran->lastItem() ?? 0 }}
                            dari {{ $pembayaran->total() }} total data
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers float-right">
                            {{ $pembayaran->appends(request()->query())->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deletePembayaranModal" tabindex="-1" role="dialog" aria-labelledby="deletePembayaranModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white" id="deletePembayaranModalLabel">
                    <i class="fas fa-exclamation-triangle"></i> Konfirmasi Hapus Data Pembayaran
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <i class="fas fa-money-bill-wave fa-3x text-danger mb-3"></i>
                    <h5 class="text-danger">Apakah Anda yakin ingin menghapus data pembayaran ini?</h5>
                </div>

                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Peringatan:</strong> Tindakan ini tidak dapat dibatalkan!
                </div>

                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title mb-0">Detail Data Pembayaran yang akan dihapus:</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td width="35%"><strong>Kode Pembayaran:</strong></td>
                                <td id="delete-pembayaran-kode">-</td>
                            </tr>
                            <tr>
                                <td><strong>Nama Santri:</strong></td>
                                <td id="delete-pembayaran-nama">-</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td id="delete-pembayaran-email">-</td>
                            </tr>
                            <tr>
                                <td><strong>Nominal:</strong></td>
                                <td><strong class="text-success">Rp. <span id="delete-pembayaran-nominal">-</span></strong></td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    <span id="delete-pembayaran-status" class="badge">-</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    Semua data terkait pembayaran ini juga akan terhapus
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <form id="deletePembayaranForm" method="POST" class="d-inline">
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
@endpush

@push('scripts')
<script>
    $(document).ready(function() { // Initialize DataTable without search and pagination
        var table = $('#pembayaranTable').DataTable({
            "responsive": true,
            "autoWidth": false,
            "ordering": false, // Disable all sorting
            "paging": false, // Disable DataTable pagination since we use Laravel pagination
            "info": false,
            "searching": false, // Disable DataTable search since we have custom filter
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            }
        });

        // Delete pembayaran confirmation with AdminLTE modal
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();

            var id = $(this).data('id');
            var kode = $(this).data('kode');
            var nama = $(this).data('nama');
            var email = $(this).data('email');
            var nominal = $(this).data('nominal');
            var status = $(this).data('status');

            console.log('Delete button clicked for pembayaran:', id, kode); // Debug log

            // Set form action URL
            $('#deletePembayaranForm').attr('action', '/admin/pembayaran/' + id);

            // Fill modal with data
            $('#delete-pembayaran-kode').text(kode);
            $('#delete-pembayaran-nama').text(nama);
            $('#delete-pembayaran-email').text(email);
            $('#delete-pembayaran-nominal').text(nominal);

            // Set status badge with appropriate color
            var statusBadge = $('#delete-pembayaran-status');
            statusBadge.removeClass('badge-success badge-warning badge-danger');

            if (status === 'approved') {
                statusBadge.addClass('badge-success').text('Disetujui');
            } else if (status === 'rejected') {
                statusBadge.addClass('badge-danger').text('Ditolak');
            } else {
                statusBadge.addClass('badge-warning').text('Pending');
            }

            // Show modal
            $('#deletePembayaranModal').modal('show');
        });
    });
</script>
@endpush