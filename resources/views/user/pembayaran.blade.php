@extends('layouts.user')

@section('title', 'Pembayaran - Dashboard Santri')
@section('page-title', 'Pembayaran')

@section('content')
<!-- Tombol Upload Pembayaran Baru -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Menu Pembayaran</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#uploadModal">
                        <i class="fas fa-plus"></i> Tambah Pembayaran Baru
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h5><i class="fas fa-info-circle"></i> Informasi Pembayaran</h5>
                    <p>Silakan pilih jenis pembayaran yang akan Anda lakukan dan upload bukti transfer. Admin akan memverifikasi pembayaran Anda dalam 1x24 jam.</p>
                    <hr>
                    <strong>Jenis Pembayaran Yang Tersedia:</strong>
                    <ul class="mb-0">
                        <li><strong>Pendaftaran:</strong> Rp 500.000 - Biaya pendaftaran siswa baru</li>
                        <li><strong>SPP Bulanan:</strong> Rp 300.000 - Biaya SPP setiap bulan</li>
                        <li><strong>Seragam:</strong> Rp 750.000 - Seragam sekolah lengkap</li>
                        <li><strong>Buku & Alat Tulis:</strong> Rp 250.000 - Buku dan alat tulis</li>
                        <li><strong>Kegiatan:</strong> Rp 100.000 - Biaya kegiatan sekolah</li>
                        <li><strong>Lainnya:</strong> Sesuai kebutuhan - Pembayaran khusus lainnya</li>
                    </ul>
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

<!-- Riwayat Pembayaran -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Riwayat Pembayaran</h3>
            </div>
            <div class="card-body">
                @if($pembayaran->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Jenis Pembayaran</th>
                                <th>Jumlah Tagihan</th>
                                <th>Nominal Transfer</th>
                                <th>Tanggal Transfer</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pembayaran as $item)
                            <tr>
                                <td>
                                    <small class="badge badge-info">{{ $item->kode_pembayaran }}</small>
                                </td>
                                <td>
                                    <strong>{{ $item->jenis_pembayaran }}</strong>
                                    @if($item->deskripsi)
                                    <br><small class="text-muted">{{ $item->deskripsi }}</small>
                                    @endif
                                </td>
                                <td>Rp {{ number_format($item->jumlah_tagihan ?? 0, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                <td>{{ $item->tanggal_transfer ? $item->tanggal_transfer->format('d/m/Y') : '-' }}</td>
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
                                <td>
                                    @if($item->bukti_pembayaran)
                                    <a href="{{ route('user.pembayaran.download', $item->id) }}" class="btn btn-sm btn-info" title="Download Bukti">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    @endif
                                    @if(in_array($item->status_verifikasi, ['pending', 'rejected']))
                                    <button type="button" class="btn btn-sm btn-danger delete-payment-btn" data-id="{{ $item->id }}" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @endif
                                    @if($item->status_verifikasi == 'rejected' && $item->keterangan)
                                    <button type="button" class="btn btn-sm btn-warning" data-toggle="tooltip" title="{{ $item->keterangan }}">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> @else
                <div class="text-center py-4">
                    <i class="fas fa-receipt fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum Ada Riwayat Pembayaran</h5>
                    <p class="text-muted">Silakan upload bukti pembayaran untuk memulai.</p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal">
                        <i class="fas fa-plus"></i> Upload Pembayaran Pertama
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Upload Bukti Pembayaran -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Bukti Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form action="{{ route('user.pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!-- Pilihan Jenis Pembayaran -->
                    <div class="form-group">
                        <label for="select_jenis_pembayaran">Pilih Jenis Pembayaran <span class="text-danger">*</span></label> <select class="form-control" id="select_jenis_pembayaran" name="jenis_pembayaran" required>
                            <option value="">-- Pilih Jenis Pembayaran --</option>
                            <option value="pendaftaran" data-jumlah="500000" data-deskripsi="Biaya pendaftaran siswa baru">Pendaftaran - Rp 500.000</option>
                            <option value="spp_bulanan" data-jumlah="300000" data-deskripsi="Biaya SPP bulanan">SPP Bulanan - Rp 300.000</option>
                            <option value="seragam" data-jumlah="750000" data-deskripsi="Seragam sekolah lengkap">Seragam - Rp 750.000</option>
                            <option value="ujian" data-jumlah="250000" data-deskripsi="Buku dan alat tulis">Buku & Alat Tulis - Rp 250.000</option>
                            <option value="kegiatan" data-jumlah="100000" data-deskripsi="Biaya kegiatan sekolah">Kegiatan Sekolah - Rp 100.000</option>
                            <option value="lainnya" data-jumlah="0" data-deskripsi="Pembayaran lainnya">Lainnya (Isi Manual)</option>
                        </select>
                    </div>

                    <!-- Form untuk Lainnya -->
                    <div id="customPaymentSection" style="display: none;">
                        <div class="form-group">
                            <label for="deskripsi_custom">Deskripsi Pembayaran <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="deskripsi_custom" name="deskripsi_custom" placeholder="Masukkan deskripsi pembayaran">
                        </div>
                        <div class="form-group">
                            <label for="jumlah_custom">Jumlah Tagihan <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="jumlah_custom" name="jumlah_custom" placeholder="Masukkan jumlah tagihan" min="1000">
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <h6><i class="fas fa-info-circle"></i> Informasi Rekening Transfer</h6>
                        <strong>Bank BRI</strong><br>
                        No. Rekening: <strong>1234-5678-9012-3456</strong><br>
                        Atas Nama: <strong>Yayasan Darul Abror</strong>
                    </div>

                    <div class="alert alert-warning" id="paymentInfoDetail" style="display: none;">
                        <h6 id="paymentTypeTitle">Informasi Pembayaran</h6>
                        <p id="paymentTypeDescription">Silakan pilih jenis pembayaran terlebih dahulu</p>
                        <strong>Jumlah Tagihan: <span id="paymentAmountDetail">Rp 0</span></strong>
                    </div>

                    <div class="form-group">
                        <label for="bukti_pembayaran">Bukti Transfer <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*" required>
                            <label class="custom-file-label" for="bukti_pembayaran">Pilih file...</label>
                        </div>
                        <small class="form-text text-muted">Format: JPG, PNG. Maksimal 2MB</small>
                    </div>

                    <div class="form-group">
                        <label for="nominal">Nominal Transfer <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="nominal" name="nominal" placeholder="Masukkan nominal yang ditransfer" required min="1000">
                        <small class="form-text text-muted">Masukkan nominal sesuai yang Anda transfer</small>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_transfer">Tanggal Transfer <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="tanggal_transfer" name="tanggal_transfer" required>
                    </div>

                    <div class="form-group">
                        <label for="bank_pengirim">Bank Pengirim <span class="text-danger">*</span></label>
                        <select class="form-control" id="bank_pengirim" name="bank_pengirim" required>
                            <option value="">-- Pilih Bank --</option>
                            <option value="BCA">BCA</option>
                            <option value="BRI">BRI</option>
                            <option value="BNI">BNI</option>
                            <option value="Mandiri">Mandiri</option>
                            <option value="CIMB Niaga">CIMB Niaga</option>
                            <option value="Danamon">Danamon</option>
                            <option value="BTN">BTN</option>
                            <option value="Bank Syariah Indonesia">Bank Syariah Indonesia</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama_pengirim">Nama Pengirim <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" placeholder="Nama yang tertera di rekening" value="{{ old('nama_pengirim') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan (Opsional)</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Tambahkan keterangan jika diperlukan"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-upload"></i> Upload Bukti Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>
</div><!-- Riwayat Pembayaran -->
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

        // Handle jenis pembayaran selection
        $('#select_jenis_pembayaran').on('change', function() {
            const selectedOption = $(this).find('option:selected');
            const jenis = selectedOption.val();
            const jumlah = selectedOption.data('jumlah');
            const deskripsi = selectedOption.data('deskripsi');
            if (jenis) {
                if (jenis === 'lainnya') {
                    // Show custom payment section
                    $('#customPaymentSection').show();
                    $('#paymentInfoDetail').hide();
                    // Clear nominal and make it manual
                    $('#nominal').val('').attr('placeholder', 'Masukkan nominal sesuai yang ditransfer');
                    $('#deskripsi_custom').prop('required', true);
                    $('#jumlah_custom').prop('required', true);
                } else {
                    // Hide custom payment section
                    $('#customPaymentSection').hide();
                    $('#deskripsi_custom').prop('required', false);
                    $('#jumlah_custom').prop('required', false);

                    // Show payment info
                    $('#paymentInfoDetail').show();
                    $('#paymentTypeTitle').text('Informasi Pembayaran - ' + jenis);
                    $('#paymentTypeDescription').text(deskripsi);
                    $('#paymentAmountDetail').text('Rp ' + number_format(jumlah));

                    // Pre-fill nominal dengan jumlah tagihan
                    $('#nominal').val(jumlah).attr('placeholder', 'Nominal yang ditransfer (Rp ' + number_format(jumlah) + ')');
                }
            } else {
                $('#customPaymentSection').hide();
                $('#paymentInfoDetail').hide();
                $('#nominal').val('').attr('placeholder', 'Masukkan nominal yang ditransfer');
                $('#deskripsi_custom').prop('required', false);
                $('#jumlah_custom').prop('required', false);
            }
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

        // Set default date to today
        const today = new Date().toISOString().split('T')[0];
        $('#tanggal_transfer').attr('max', today).val(today);

        // Form validation before submit
        $('form').on('submit', function(e) {
            const jenis = $('#select_jenis_pembayaran').val();

            if (!jenis) {
                e.preventDefault();
                alert('Silakan pilih jenis pembayaran terlebih dahulu!');
                return false;
            }

            if (jenis === 'Lainnya') {
                const deskripsiCustom = $('#deskripsi_custom').val();
                const jumlahCustom = $('#jumlah_custom').val();

                if (!deskripsiCustom) {
                    e.preventDefault();
                    alert('Silakan isi deskripsi pembayaran!');
                    $('#deskripsi_custom').focus();
                    return false;
                }

                if (!jumlahCustom || jumlahCustom < 1000) {
                    e.preventDefault();
                    alert('Silakan isi jumlah tagihan minimal Rp 1.000!');
                    $('#jumlah_custom').focus();
                    return false;
                }
            }

            const nominal = $('#nominal').val();
            if (!nominal || nominal < 1000) {
                e.preventDefault();
                alert('Silakan isi nominal transfer minimal Rp 1.000!');
                $('#nominal').focus();
                return false;
            }

            // Show loading state
            $(this).find('button[type="submit"]').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Mengunggah...');
        });
    });

    function deletePayment(id) {
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = '{{ route("user.pembayaran.delete", ":id") }}'.replace(':id', id);
        $('#deleteModal').modal('show');
    }

    // Helper function untuk format number
    function number_format(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }
</script>
@endpush