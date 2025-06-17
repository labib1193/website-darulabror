@extends('layouts.admin')

@section('title', 'Data Orangtua')
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
                <h3 class="card-title">Data Orangtua Santri</h3>
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
                @endif <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="orangtuaTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Nama Lengkap</th>
                                <th>Status</th>
                                <th>Jenis Kelamin</th>
                                <th>No. HP</th>
                                <th>Pekerjaan</th>
                                <th>Penghasilan</th>
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
                                    <span class="badge badge-primary">{{ $item->status }}</span>
                                </td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->no_hp_1 }}</td>
                                <td>{{ $item->pekerjaan ?? '-' }}</td>
                                <td>{{ $item->penghasilan ?? '-' }}</td>
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
                                        <a href="{{ route('admin.orangtua.show', $item->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.orangtua.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.orangtua.destroy', $item->id) }}" method="POST" class="d-inline">
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
                                <td colspan="10" class="text-center">Tidak ada data orangtua.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $orangtua->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('#orangtuaTable').DataTable({
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