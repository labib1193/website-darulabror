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
                <h3 class="card-title">Data Identitas Santri</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.identitas.create') }}" class="btn btn-primary btn-sm">
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

                <!-- Filter Form -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <form method="GET" action="{{ route('admin.identitas.index') }}" class="form-inline">
                            <div class="form-group mr-2">
                                <input type="text" name="search" class="form-control" placeholder="Cari nama, email, NIK..."
                                    value="{{ request('search') }}">
                            </div>
                            <div class="form-group mr-2">
                                <select name="status" class="form-control">
                                    <option value="">Semua Status</option>
                                    @foreach($statusOptions ?? [] as $value => $label)
                                    <option value="{{ $value }}" {{ request('status') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mr-2">
                                <select name="jenis_kelamin" class="form-control">
                                    <option value="">Semua Jenis Kelamin</option>
                                    @foreach($jenisKelaminOptions ?? [] as $value => $label)
                                    <option value="{{ $value }}" {{ request('jenis_kelamin') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="fas fa-search"></i> Filter
                            </button>
                            <a href="{{ route('admin.identitas.index') }}" class="btn btn-secondary">
                                <i class="fas fa-undo"></i> Reset
                            </a>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="identitasTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Nama Lengkap</th>
                                <th>NIK</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>No. HP</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody> @forelse($identitas as $index => $item)
                            <tr>
                                <td>{{ $identitas->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $item->user->name ?? '-' }}</strong><br>
                                    <small class="text-muted">{{ $item->user->email ?? '-' }}</small>
                                </td>
                                <td>{{ $item->user->name ?? '-' }}</td>
                                <td>{{ $item->nik ?? '-' }}</td>
                                <td>{{ $item->tempat_lahir ?? '-' }}</td>
                                <td>{{ $item->tanggal_lahir ? $item->tanggal_lahir->format('d/m/Y') : '-' }}</td>
                                <td>
                                    @if($item->jenis_kelamin)
                                    <span class="badge badge-{{ $item->jenis_kelamin == 'Laki-laki' ? 'primary' : 'pink' }}">
                                        {{ $item->jenis_kelamin }}
                                    </span>
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $item->no_hp ?? '-' }}</td>
                                <td>
                                    @if($item->status_verifikasi)
                                    @if($item->status_verifikasi == 'terverifikasi')
                                    <span class="badge badge-success">Terverifikasi</span>
                                    @elseif($item->status_verifikasi == 'pending')
                                    <span class="badge badge-warning">Pending</span>
                                    @else
                                    <span class="badge badge-danger">Ditolak</span>
                                    @endif
                                    @else
                                    <span class="badge badge-secondary">Belum Diverifikasi</span>
                                    @endif
                                </td>                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.identitas.show', $item->id) }}" class="btn btn-info btn-sm" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        <!-- Quick Status Update Dropdown -->
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" title="Update Status">
                                                <i class="fas fa-clipboard-check"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <h6 class="dropdown-header">Update Status</h6>
                                                <form action="{{ route('admin.identitas.updateStatus', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status_verifikasi" value="pending">
                                                    <button type="submit" class="dropdown-item text-warning">
                                                        <i class="fas fa-clock"></i> Set Pending
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.identitas.updateStatus', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status_verifikasi" value="terverifikasi">
                                                    <button type="submit" class="dropdown-item text-success">
                                                        <i class="fas fa-check-circle"></i> Verifikasi
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.identitas.updateStatus', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status_verifikasi" value="ditolak">
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="fas fa-times-circle"></i> Tolak
                                                    </button>
                                                </form>
                                                <div class="dropdown-divider"></div>
                                                <a href="{{ route('admin.identitas.show', $item->id) }}" class="dropdown-item">
                                                    <i class="fas fa-edit"></i> Detail & Catatan
                                                </a>
                                            </div>
                                        </div>

                                        <a href="{{ route('admin.identitas.edit', $item->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.identitas.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr> @empty
                            <tr>
                                <td colspan="10" class="text-center">Tidak ada data identitas.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div> <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $identitas->appends(request()->query())->links() }}
                </div>
            </div>        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#identitasTable').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "paging": false,
            "info": false,
            "searching": true,
            "ordering": true,
            "language": {
                "search": "Cari:",
                "zeroRecords": "Tidak ada data yang ditemukan",
                "emptyTable": "Tidak ada data tersedia"
            }
        });
    });

    // Additional scripts for quick actions
    $(document).on('submit', 'form[data-confirm]', function(e) {
        if (!confirm($(this).data('confirm'))) {
            e.preventDefault();
        }
    });
</script>
@endpush