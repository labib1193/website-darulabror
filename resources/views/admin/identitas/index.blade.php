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
                                    @else
                                    <span class="badge badge-danger">Ditolak</span>
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
                                        <form action="{{ route('admin.identitas.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
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
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $identitas->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
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
            "searching": false,
            "ordering": true
        });
    });
</script>
@endpush