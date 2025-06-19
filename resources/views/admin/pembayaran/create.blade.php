@extends('layouts.admin')

@section('title', 'Tambah Pembayaran')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tambah Pembayaran</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.pembayaran.index') }}">Data Pembayaran</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Form Tambah Pembayaran</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <form action="{{ route('admin.pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kode_pembayaran">Kode Pembayaran <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('kode_pembayaran') is-invalid @enderror"
                                            id="kode_pembayaran" name="kode_pembayaran" value="{{ old('kode_pembayaran', 'PAY' . date('Ymd') . rand(1000,9999)) }}" required>
                                        <small class="form-text text-muted">Kode pembayaran akan otomatis tergenerate</small>
                                        @error('kode_pembayaran')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="jenis_pembayaran">Jenis Pembayaran <span class="text-danger">*</span></label>
                                        <select class="form-control @error('jenis_pembayaran') is-invalid @enderror"
                                            id="jenis_pembayaran" name="jenis_pembayaran" required>
                                            <option value="">Pilih Jenis Pembayaran</option>
                                            <option value="pendaftaran" {{ old('jenis_pembayaran') == 'pendaftaran' ? 'selected' : '' }}>Pendaftaran</option>
                                            <option value="spp_bulanan" {{ old('jenis_pembayaran') == 'spp_bulanan' ? 'selected' : '' }}>SPP Bulanan</option>
                                            <option value="seragam" {{ old('jenis_pembayaran') == 'seragam' ? 'selected' : '' }}>Seragam</option>
                                            <option value="ujian" {{ old('jenis_pembayaran') == 'ujian' ? 'selected' : '' }}>Ujian/Buku</option>
                                            <option value="kegiatan" {{ old('jenis_pembayaran') == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                            <option value="lainnya" {{ old('jenis_pembayaran') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                        @error('jenis_pembayaran')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="nominal">Nominal <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="number" class="form-control @error('nominal') is-invalid @enderror"
                                                id="nominal" name="nominal" value="{{ old('nominal') }}" min="0" required>
                                        </div>
                                        @error('nominal')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="metode_pembayaran">Metode Pembayaran <span class="text-danger">*</span></label>
                                        <select class="form-control @error('metode_pembayaran') is-invalid @enderror"
                                            id="metode_pembayaran" name="metode_pembayaran" required>
                                            <option value="">Pilih Metode Pembayaran</option>
                                            <option value="Cash" {{ old('metode_pembayaran') == 'Cash' ? 'selected' : '' }}>Cash</option>
                                            <option value="Transfer Bank" {{ old('metode_pembayaran') == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                                            <option value="E-Wallet" {{ old('metode_pembayaran') == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                                            <option value="QRIS" {{ old('metode_pembayaran') == 'QRIS' ? 'selected' : '' }}>QRIS</option>
                                        </select>
                                        @error('metode_pembayaran')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal_pembayaran">Tanggal Pembayaran</label>
                                        <input type="datetime-local" class="form-control @error('tanggal_pembayaran') is-invalid @enderror"
                                            id="tanggal_pembayaran" name="tanggal_pembayaran" value="{{ old('tanggal_pembayaran', now()->format('Y-m-d\TH:i')) }}">
                                        @error('tanggal_pembayaran')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="status_pembayaran">Status Pembayaran <span class="text-danger">*</span></label>
                                        <select class="form-control @error('status_pembayaran') is-invalid @enderror"
                                            id="status_pembayaran" name="status_pembayaran" required>
                                            <option value="pending" {{ old('status_pembayaran') == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="proses" {{ old('status_pembayaran') == 'proses' ? 'selected' : '' }}>Proses</option>
                                            <option value="lunas" {{ old('status_pembayaran') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                            <option value="gagal" {{ old('status_pembayaran') == 'gagal' ? 'selected' : '' }}>Gagal</option>
                                        </select>
                                        @error('status_pembayaran')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="bukti_pembayaran">Bukti Pembayaran</label>
                                        <input type="file" class="form-control-file @error('bukti_pembayaran') is-invalid @enderror"
                                            id="bukti_pembayaran" name="bukti_pembayaran" accept=".pdf,.jpg,.jpeg,.png">
                                        <small class="form-text text-muted">
                                            Format yang didukung: PDF, JPG, JPEG, PNG. Maksimal 5MB.
                                        </small>
                                        @error('bukti_pembayaran')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="catatan">Catatan</label>
                                        <textarea class="form-control @error('catatan') is-invalid @enderror"
                                            id="catatan" name="catatan" rows="3" placeholder="Tambahkan catatan jika diperlukan">{{ old('catatan') }}</textarea>
                                        @error('catatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- Preview area for uploaded image -->
                                    <div id="image-preview" style="display: none;" class="form-group">
                                        <label>Preview Bukti Pembayaran</label>
                                        <div class="text-center">
                                            <img id="preview-img" src="" alt="Preview" class="img-thumbnail" style="max-height: 200px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Pembayaran
                            </button>
                            <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    // Auto generate kode pembayaran
    function generateKodePembayaran() {
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const random = Math.floor(Math.random() * 9000) + 1000;
        return `PAY${year}${month}${day}${random}`;
    }

    // Set kode pembayaran on page load
    document.addEventListener('DOMContentLoaded', function() {
        if (!document.getElementById('kode_pembayaran').value) {
            document.getElementById('kode_pembayaran').value = generateKodePembayaran();
        }
    });

    // Preview gambar sebelum upload
    document.getElementById('bukti_pembayaran').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-img').src = e.target.result;
                document.getElementById('image-preview').style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            document.getElementById('image-preview').style.display = 'none';
        }
    });

    // Format number input
    document.getElementById('nominal').addEventListener('input', function(e) {
        // Remove non-numeric characters
        let value = e.target.value.replace(/[^0-9]/g, '');
        e.target.value = value;
    });

    // Set default tanggal pembayaran untuk metode cash
    document.getElementById('metode_pembayaran').addEventListener('change', function(e) {
        if (e.target.value === 'Cash') {
            const now = new Date();
            const formatted = now.toISOString().slice(0, 16);
            document.getElementById('tanggal_pembayaran').value = formatted;
            document.getElementById('status_pembayaran').value = 'lunas';
        }
    });
</script>
@endpush
@endsection