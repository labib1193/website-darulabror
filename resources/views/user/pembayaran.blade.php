@extends('layouts.user')

@section('title', 'Pembayaran - Dashboard Santri')
@section('page-title', 'Pembayaran')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('user.identitas') }}">Identitas Diri</a></li>
<li class="breadcrumb-item active">Pembayaran</li>
@endsection

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
                            <span class="info-box-icon bg-warning"><i class="fas fa-clock"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Status Pembayaran</span>
                                <span class="info-box-number">Belum Lunas</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

                <form enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="bukti_pembayaran">Bukti Transfer <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*">
                                <label class="custom-file-label" for="bukti_pembayaran">Pilih file...</label>
                            </div>
                        </div>
                        <small class="form-text text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                    </div>

                    <div class="form-group">
                        <label for="nominal">Nominal Transfer</label>
                        <input type="number" class="form-control" id="nominal" name="nominal" placeholder="500000">
                    </div>

                    <div class="form-group">
                        <label for="tanggal_transfer">Tanggal Transfer</label>
                        <input type="date" class="form-control" id="tanggal_transfer" name="tanggal_transfer">
                    </div>

                    <div class="form-group">
                        <label for="bank_pengirim">Bank Pengirim</label>
                        <input type="text" class="form-control" id="bank_pengirim" name="bank_pengirim" placeholder="Contoh: BCA">
                    </div>

                    <div class="form-group">
                        <label for="nama_pengirim">Nama Pengirim</label>
                        <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" placeholder="Nama yang tertera di rekening">
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload"></i> Upload Bukti Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Riwayat Pembayaran -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Riwayat Pembayaran</h3>
            </div>
            <div class="card-body">
                <div class="timeline">
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
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada data pembayaran</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
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
    });
</script>
@endpush