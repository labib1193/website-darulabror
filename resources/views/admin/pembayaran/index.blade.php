@extends('layouts.admin')

@section('title', 'Data Pembayaran')
@section('page-title', 'Data Pembayaran')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Data Pembayaran</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Pembayaran Santri</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.pembayaran.create') }}" class="btn btn-primary btn-sm">
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

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="pembayaranTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Nominal</th>
                                <th>Bank Pengirim</th>
                                <th>Nama Pengirim</th>
                                <th>Tanggal Transfer</th>
                                <th>Status Verifikasi</th>
                                <th>Bukti Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pembayaran as $index => $item)
                            <tr>
                                <td>{{ $pembayaran->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $item->user->name }}</strong><br>
                                    <small class="text-muted">{{ $item->user->email }}</small>
                                </td>
                                <td>
                                    <strong class="text-success">
                                        Rp {{ number_format($item->nominal, 0, ',', '.') }}
                                    </strong>
                                </td>
                                <td>{{ $item->bank_pengirim }}</td>
                                <td>{{ $item->nama_pengirim }}</td>
                                <td>{{ $item->tanggal_transfer->format('d/m/Y') }}</td>
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
                                </td>
                                <td class="text-center">
                                    @if($item->bukti_pembayaran)
                                    <a href="{{ asset('storage/' . $item->bukti_pembayaran) }}"
                                        target="_blank" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Lihat
                                    </a>
                                    @else
                                    <span class="badge badge-secondary">Tidak ada</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.pembayaran.show', $item->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.pembayaran.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.pembayaran.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
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
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $pembayaran->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('#pembayaranTable').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "paging": false,
            "info": false,
            "searching": true,
            "ordering": true,
            "scrollX": true,
            "language": {
                "search": "Cari:",
                "zeroRecords": "Tidak ada data yang ditemukan",
                "emptyTable": "Tidak ada data tersedia"
            }
        });
    });
</script>
@endpush