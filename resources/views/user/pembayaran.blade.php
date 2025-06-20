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
                        <li><strong>Pendaftaran:</strong> Rp 500.000 - Biaya pendaftaran santri baru</li>
                        <li><strong>SPP Bulanan:</strong> Rp 300.000 - Biaya SPP setiap bulan</li>
                        <li><strong>Seragam:</strong> Rp 750.000 - Seragam pondok lengkap</li>
                        <li><strong>Kitab-kitab Pelajaran:</strong> Rp 250.000 - Kitab-kitab pelajaran</li>
                        <li><strong>Kegiatan:</strong> Rp 100.000 - Biaya kegiatan pondok</li>
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
                                    @endif @if(in_array($item->status_verifikasi, ['pending', 'rejected']))
                                    <button type="button" class="btn btn-sm btn-danger delete-payment-btn"
                                        data-id="{{ $item->id }}"
                                        data-jenis="{{ $item->jenis_pembayaran }}"
                                        data-nominal="{{ number_format($item->nominal, 0, ',', '.') }}"
                                        data-tanggal="{{ $item->tanggal_transfer ? $item->tanggal_transfer->format('d/m/Y') : '-' }}"
                                        data-status="{{ $item->status_verifikasi }}"
                                        data-kode="{{ $item->kode_pembayaran }}"
                                        title="Hapus">
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
                            <option value="kitab" data-jumlah="250000" data-deskripsi="Kitab-kitab Pelajaran">Kitab-kitab Pelajaran - Rp 250.000</option>
                            <option value="kegiatan" data-jumlah="100000" data-deskripsi="Biaya kegiatan sekolah">Kegiatan Pondok - Rp 100.000</option>
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
                    <i class="fas fa-receipt fa-3x text-danger mb-3"></i>
                    <h5 class="text-danger">Apakah Anda yakin ingin menghapus data pembayaran ini?</h5>
                </div>

                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Peringatan:</strong> Tindakan ini tidak dapat dibatalkan!
                </div>

                <div class="card">
                    <div class="card-header bg-light">
                        <h6 class="card-title mb-0"><i class="fas fa-info-circle"></i> Detail Data yang akan dihapus:</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-borderless mb-0">
                            <tr>
                                <td width="35%"><strong>Kode Pembayaran:</strong></td>
                                <td id="delete-payment-kode" class="text-danger font-weight-bold">-</td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Pembayaran:</strong></td>
                                <td id="delete-payment-jenis">-</td>
                            </tr>
                            <tr>
                                <td><strong>Nominal:</strong></td>
                                <td id="delete-payment-nominal" class="font-weight-bold">-</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Transfer:</strong></td>
                                <td id="delete-payment-tanggal">-</td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    <span id="delete-payment-status" class="badge">-</span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <strong>Data ini akan dihapus permanen!</strong> Pastikan Anda sudah yakin sebelum melanjutkan.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button type="button" id="confirmDeletePembayaranBtn" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Ya, Hapus Data
                </button>
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
        }); // Handle delete payment button clicks - Show modal instead of direct delete
        $(document).on('click', '.delete-payment-btn', function(e) {
            e.preventDefault();

            let paymentId = $(this).data('id');
            let jenis = $(this).data('jenis');
            let nominal = $(this).data('nominal');
            let tanggal = $(this).data('tanggal');
            let status = $(this).data('status');
            let kode = $(this).data('kode');

            // Populate modal with data
            $('#delete-payment-kode').text(kode);
            $('#delete-payment-jenis').text(jenis);
            $('#delete-payment-nominal').text('Rp ' + nominal);
            $('#delete-payment-tanggal').text(tanggal);

            // Set status badge
            let statusClass = status === 'approved' ? 'badge-success' : (status === 'rejected' ? 'badge-danger' : 'badge-warning');
            let statusText = status === 'approved' ? 'Disetujui' : (status === 'rejected' ? 'Ditolak' : 'Pending');
            $('#delete-payment-status').text(statusText).removeClass('badge-success badge-danger badge-warning').addClass(statusClass);

            // Store payment ID for deletion
            $('#confirmDeletePembayaranBtn').data('id', paymentId);

            // Show modal
            $('#deletePembayaranModal').modal('show');
        });

        // Handle confirm delete button in modal
        $('#confirmDeletePembayaranBtn').click(function() {
            let paymentId = $(this).data('id');
            let button = $(this);

            // Show loading state
            button.html('<i class="fas fa-spinner fa-spin"></i> Menghapus...').prop('disabled', true);

            $.ajax({
                url: '{{ route("user.pembayaran.delete", ":id") }}'.replace(':id', paymentId),
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        // Hide modal first
                        $('#deletePembayaranModal').modal('hide');

                        // Show success message and reload page
                        alert('Data pembayaran berhasil dihapus!');
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan: ' + (response.message || 'Unknown error'));
                    }
                },
                error: function(xhr) {
                    let errorMessage = 'Terjadi kesalahan saat menghapus data.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    alert(errorMessage);
                },
                complete: function() {
                    // Reset button state
                    button.html('<i class="fas fa-trash"></i> Ya, Hapus Data').prop('disabled', false);
                }
            });
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

    // Helper function untuk format number
    function number_format(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }
</script>
@endpush