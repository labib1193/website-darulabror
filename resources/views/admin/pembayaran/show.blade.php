@extends('layouts.admin')

@section('title', 'Detail Pembayaran - ')
@section('page-title', 'Detail Pembayaran')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.pembayaran.index') }}">Data Pembayaran</a></li>
<li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Pembayaran - #{{ $pembayaran->id }}</h3>
                <div class="card-tools">
                    @if($pembayaran->status_verifikasi == 'pending')
                    <form action="{{ route('admin.pembayaran.approve', $pembayaran->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Apakah Anda yakin ingin menyetujui pembayaran ini?')">
                            <i class="fas fa-check"></i> Setujui
                        </button>
                    </form> <button type="button" class="btn btn-warning btn-sm reject-btn" data-payment-id="{{ $pembayaran->id }}">
                        <i class="fas fa-times"></i> Tolak
                    </button>
                    @endif
                    <a href="{{ route('admin.pembayaran.edit', $pembayaran->id) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
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

                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 30%">ID Pembayaran</th>
                                <td>{{ $pembayaran->id }}</td>
                            </tr>
                            <tr>
                                <th>Kode Pembayaran</th>
                                <td>
                                    <strong class="text-primary">{{ $pembayaran->kode_pembayaran ?? 'Belum Generate' }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <th>Jenis Pembayaran</th>
                                <td>
                                    <span class="badge badge-info">{{ $pembayaran->jenis_pembayaran ?? 'Tidak ditentukan' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Jumlah Tagihan</th>
                                <td>
                                    <strong class="text-info">
                                        Rp {{ number_format($pembayaran->jumlah_tagihan ?? 0, 0, ',', '.') }}
                                    </strong>
                                </td>
                            </tr>
                            @if($pembayaran->deskripsi)
                            <tr>
                                <th>Deskripsi</th>
                                <td>{{ $pembayaran->deskripsi }}</td>
                            </tr>
                            @endif
                            <tr>
                                <th>Nama Pendaftar</th>
                                <td>
                                    <strong>{{ $pembayaran->user->name }}</strong><br>
                                    <small class="text-muted">{{ $pembayaran->user->email }}</small>
                                    <!-- @if($pembayaran->user->identitas)
                                    <br><small class="badge badge-info">{{ $pembayaran->user->identitas->nama_lengkap }}</small>
                                    @endif -->
                                </td>
                            </tr>
                            <tr>
                                <th>Nominal Transfer</th>
                                <td>
                                    <strong class="text-success">
                                        Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}
                                    </strong>
                                </td>
                            </tr>
                            <tr>
                                <th>Tanggal Transfer</th>
                                <td>{{ $pembayaran->tanggal_transfer->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Bank Pengirim</th>
                                <td>{{ $pembayaran->bank_pengirim }}</td>
                            </tr>
                            <tr>
                                <th>Nama Pengirim</th>
                                <td>{{ $pembayaran->nama_pengirim }}</td>
                            </tr>
                            <tr>
                                <th>Status Verifikasi</th>
                                <td>
                                    @if($pembayaran->status_verifikasi == 'approved')
                                    <span class="badge badge-success">
                                        <i class="fas fa-check-circle"></i> Disetujui
                                    </span>
                                    @elseif($pembayaran->status_verifikasi == 'rejected')
                                    <span class="badge badge-danger">
                                        <i class="fas fa-times-circle"></i> Ditolak
                                    </span>
                                    @else
                                    <span class="badge badge-warning">
                                        <i class="fas fa-clock"></i> Pending
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            @if($pembayaran->verified_by)
                            <tr>
                                <th>Diverifikasi Oleh</th>
                                <td>
                                    {{ $pembayaran->verifiedBy->name }}<br>
                                    <small class="text-muted">{{ $pembayaran->verified_at->format('d F Y, H:i') }}</small>
                                </td>
                            </tr>
                            @endif
                            @if($pembayaran->keterangan)
                            <tr>
                                <th>Keterangan</th>
                                <td>{{ $pembayaran->keterangan }}</td>
                            </tr>
                            @endif
                            <tr>
                                <th>Tanggal Upload</th>
                                <td>{{ $pembayaran->created_at->format('d F Y, H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Terakhir Diupdate</th>
                                <td>{{ $pembayaran->updated_at->format('d F Y, H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Bukti Pembayaran -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Bukti Pembayaran</h3>
                    </div>
                    <div class="card-body text-center">
                        @if($pembayaran->bukti_pembayaran) <img src="{{ $pembayaran->getFileUrl('bukti_pembayaran') }}"
                            class="img-fluid mb-2 image-preview" alt="Bukti Pembayaran"
                            style="max-height: 300px; cursor: pointer;"
                            data-image-src="{{ $pembayaran->getFileUrl('bukti_pembayaran') }}">
                        <br>
                        <small class="text-muted">
                            {{ $pembayaran->bukti_pembayaran_original ?? 'bukti_pembayaran.jpg' }}
                            @if($pembayaran->bukti_pembayaran_uploaded_at)
                            <br>Upload: {{ $pembayaran->bukti_pembayaran_uploaded_at->format('d/m/Y H:i') }}
                            @endif
                        </small>
                        <br><br>
                        <div class="btn-group">
                            <a href="{{ $pembayaran->getFileUrl('bukti_pembayaran') }}"
                                target="_blank" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                            <a href="{{ route('admin.pembayaran.download', $pembayaran->id) }}"
                                class="btn btn-success btn-sm">
                                <i class="fas fa-download"></i> Download
                            </a>
                        </div>
                        @else
                        <div class="text-center py-4">
                            <i class="fas fa-image text-muted" style="font-size: 48px;"></i>
                            <p class="text-muted mt-2">Tidak ada bukti pembayaran</p>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bukti Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" alt="Bukti Pembayaran">
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tolak Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="keterangan">Alasan Penolakan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required
                            placeholder="Masukkan alasan penolakan pembayaran..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak Pembayaran</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        // Handle image preview clicks
        $('.image-preview').on('click', function() {
            var imageSrc = $(this).data('image-src');
            showImageModal(imageSrc);
        });

        // Handle reject button clicks
        $('.reject-btn').on('click', function() {
            var paymentId = $(this).data('payment-id');
            rejectPayment(paymentId);
        });
    });

    function showImageModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        $('#imageModal').modal('show');
    }

    function rejectPayment(paymentId) {
        document.getElementById('rejectForm').action = '{{ url("admin/pembayaran") }}/' + paymentId + '/reject';
        $('#rejectModal').modal('show');
    }
</script>
@endpush