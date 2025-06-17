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
                <h3 class="card-title">Data Dokumen Santri</h3>
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
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dokumenTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>User</th>
                                <th>Foto KTP</th>
                                <th>Foto Ijazah</th>
                                <th>Surat Sehat</th>
                                <th>Foto KK</th>
                                <th>Pas Foto</th>
                                <th>Status Verifikasi</th>
                                <th>Aksi</th>
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
                                        <a href="{{ route('admin.dokumen.show', $item->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.dokumen.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.dokumen.destroy', $item->id) }}" method="POST" class="d-inline">
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
                                <td colspan="9" class="text-center">Tidak ada data dokumen.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $dokumen->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        // Set progress bar width from data attribute
        $('.progress-bar[data-width]').each(function() {
            var width = $(this).data('width');
            $(this).css('width', width + '%');
        });

        $('#dokumenTable').DataTable({
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