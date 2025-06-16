@extends('layouts.user')

@section('title', 'Pembayaran - Dashboard Santri')
@section('page-title', 'Pembayaran')

@section('content')
<div class="row">
    <!-- Info Biaya -->
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Informasi Biaya Pendaftaran</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-money-bill-wave"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Biaya Pendaftaran</span>
                                <span class="info-box-number">Rp 500.000</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-box">
                            <span class="info-box-icon bg-{{ $statusPembayaran == 'Lunas' ? 'success' : ($statusPembayaran == 'Menunggu Verifikasi' ? 'warning' : ($statusPembayaran == 'Ditolak - Perlu Upload Ulang' ? 'danger' : 'warning')) }}">
                                <i class="fas fa-{{ $statusPembayaran == 'Lunas' ? 'check' : 'clock' }}"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Status Pembayaran</span>
                                <span class="info-box-number">{{ $statusPembayaran }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="col-12">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="icon fas fa-check"></i> {{ session('success') }}
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="col-12">
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="icon fas fa-ban"></i> {{ session('error') }}
        </div>
    </div>
    @endif

    @if($errors->any())
    <div class="col-12">
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h6><i class="icon fas fa-ban"></i> Terdapat kesalahan:</h6>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <!-- Form Upload Bukti Pembayaran -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Upload Bukti Pembayaran</h3>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h5><i class="icon fas fa-info"></i> Informasi Rekening!</h5>
                    <strong>Bank BRI</strong><br>
                    No. Rekening: <strong>1234-5678-9012</strong><br>
                    Atas Nama: <strong>Yayasan Darul Abror</strong>
                </div>
                <form action="{{ route('user.pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="bukti_pembayaran">Bukti Transfer <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*" required>
                                <label class="custom-file-label" for="bukti_pembayaran">Pilih file...</label>
                            </div>
                        </div>
                        <small class="form-text text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                    </div>

                    <div class="form-group">
                        <label for="nominal">Nominal Transfer <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="nominal" name="nominal" placeholder="500000" value="{{ old('nominal') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_transfer">Tanggal Transfer <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="tanggal_transfer" name="tanggal_transfer" value="{{ old('tanggal_transfer') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="bank_pengirim">Bank Pengirim <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="bank_pengirim" name="bank_pengirim" placeholder="Contoh: BCA" value="{{ old('bank_pengirim') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="nama_pengirim">Nama Pengirim <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" placeholder="Nama yang tertera di rekening" value="{{ old('nama_pengirim') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload"></i> Upload Bukti Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div> <!-- Riwayat Pembayaran -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Riwayat Pembayaran</h3>
            </div>
            <div class="card-body">
                <div class="timeline">
                    @if($pembayaran->count() > 0)
                    @foreach($pembayaran as $payment)
                    <div class="time-label">
                        <span class="bg-{{ $payment->status_verifikasi == 'approved' ? 'green' : ($payment->status_verifikasi == 'rejected' ? 'red' : 'yellow') }}">
                            {{ $payment->created_at->format('d M Y') }}
                        </span>
                    </div>
                    <div>
                        <i class="fas fa-{{ $payment->status_verifikasi == 'approved' ? 'check bg-green' : ($payment->status_verifikasi == 'rejected' ? 'times bg-red' : 'clock bg-yellow') }}"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i> {{ $payment->created_at->format('H:i') }}</span>
                            <h3 class="timeline-header">{{ $payment->status_text }}</h3>
                            <div class="timeline-body">
                                <strong>Nominal:</strong> {{ $payment->formatted_nominal }}<br>
                                <strong>Bank:</strong> {{ $payment->bank_pengirim }}<br>
                                <strong>Pengirim:</strong> {{ $payment->nama_pengirim }}<br>
                                <strong>Tanggal Transfer:</strong> {{ $payment->tanggal_transfer->format('d/m/Y') }}
                                @if($payment->keterangan)
                                <br><strong>Keterangan:</strong> {{ $payment->keterangan }}
                                @endif
                            </div>
                            <div class="timeline-footer">
                                <a href="{{ route('user.pembayaran.download', $payment->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-download"></i> Download Bukti
                                </a>
                                @if(in_array($payment->status_verifikasi, ['pending', 'rejected']))
                                <button type="button" class="btn btn-danger btn-sm delete-payment-btn" data-id="{{ $payment->id }}">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="time-label">
                        <span class="bg-red">Belum Ada Pembayaran</span>
                    </div>
                    <div>
                        <i class="fas fa-clock bg-gray"></i>
                        <div class="timeline-item">
                            <h3 class="timeline-header">Menunggu Pembayaran</h3>
                            <div class="timeline-body">
                                Silakan lakukan pembayaran sesuai dengan nominal yang tertera dan upload bukti pembayaran.
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Verification -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Status Verifikasi Pembayaran</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tanggal Upload</th>
                                <th>Nominal</th>
                                <th>Bank Pengirim</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($pembayaran->count() > 0)
                            @foreach($pembayaran as $payment)
                            <tr>
                                <td>{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $payment->formatted_nominal }}</td>
                                <td>{{ $payment->bank_pengirim }}</td>
                                <td>
                                    <span class="badge {{ $payment->status_badge_class }}">
                                        {{ $payment->status_text }}
                                    </span>
                                </td>
                                <td>{{ $payment->keterangan ?? '-' }}</td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada data pembayaran</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data pembayaran ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Update label saat file dipilih
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

        // Handle delete payment button clicks
        $(document).on('click', '.delete-payment-btn', function() {
            const id = $(this).data('id');
            deletePayment(id);
        });

        // File size validation
        $('.custom-file-input').on('change', function() {
            const file = this.files[0];
            if (file) {
                const maxSize = 2048 * 1024; // 2MB

                if (file.size > maxSize) {
                    alert('Ukuran file terlalu besar! Maksimal 2MB');
                    $(this).val('');
                    $(this).next('.custom-file-label').removeClass("selected").html('Pilih file...');
                }
            }
        });
    });

    function deletePayment(id) {
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = '{{ route("user.pembayaran.delete", ":id") }}'.replace(':id', id);
        $('#deleteModal').modal('show');
    }
</script>
@endpush