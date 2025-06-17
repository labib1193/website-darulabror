@extends('layouts.admin')

@section('title', 'Edit Pembayaran')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Pembayaran</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.pembayaran.index') }}">Data Pembayaran</a></li>
                    <li class="breadcrumb-item active">Edit</li>
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
                        <h3 class="card-title">Form Edit Pembayaran</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <form action="{{ route('admin.pembayaran.update', $pembayaran->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kode_pembayaran">Kode Pembayaran <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('kode_pembayaran') is-invalid @enderror"
                                            id="kode_pembayaran" name="kode_pembayaran" value="{{ old('kode_pembayaran', $pembayaran->kode_pembayaran) }}" required>
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
                                            <option value="Pendaftaran" {{ old('jenis_pembayaran', $pembayaran->jenis_pembayaran) == 'Pendaftaran' ? 'selected' : '' }}>Pendaftaran</option>
                                            <option value="SPP" {{ old('jenis_pembayaran', $pembayaran->jenis_pembayaran) == 'SPP' ? 'selected' : '' }}>SPP</option>
                                            <option value="Seragam" {{ old('jenis_pembayaran', $pembayaran->jenis_pembayaran) == 'Seragam' ? 'selected' : '' }}>Seragam</option>
                                            <option value="Buku" {{ old('jenis_pembayaran', $pembayaran->jenis_pembayaran) == 'Buku' ? 'selected' : '' }}>Buku</option>
                                            <option value="Kegiatan" {{ old('jenis_pembayaran', $pembayaran->jenis_pembayaran) == 'Kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                                            <option value="Lainnya" {{ old('jenis_pembayaran', $pembayaran->jenis_pembayaran) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
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
                                                id="nominal" name="nominal" value="{{ old('nominal', $pembayaran->nominal) }}" min="0" required>
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
                                            <option value="Cash" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'Cash' ? 'selected' : '' }}>Cash</option>
                                            <option value="Transfer Bank" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'Transfer Bank' ? 'selected' : '' }}>Transfer Bank</option>
                                            <option value="E-Wallet" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
                                            <option value="QRIS" {{ old('metode_pembayaran', $pembayaran->metode_pembayaran) == 'QRIS' ? 'selected' : '' }}>QRIS</option>
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
                                            id="tanggal_pembayaran" name="tanggal_pembayaran"
                                            value="{{ old('tanggal_pembayaran', $pembayaran->tanggal_pembayaran ? \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->format('Y-m-d\TH:i') : '') }}">
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
                                            <option value="pending" {{ old('status_pembayaran', $pembayaran->status_pembayaran) == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="proses" {{ old('status_pembayaran', $pembayaran->status_pembayaran) == 'proses' ? 'selected' : '' }}>Proses</option>
                                            <option value="lunas" {{ old('status_pembayaran', $pembayaran->status_pembayaran) == 'lunas' ? 'selected' : '' }}>Lunas</option>
                                            <option value="gagal" {{ old('status_pembayaran', $pembayaran->status_pembayaran) == 'gagal' ? 'selected' : '' }}>Gagal</option>
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
                                        @if($pembayaran->bukti_pembayaran)
                                        <div class="mt-2">
                                            <small class="text-info">Bukti saat ini:
                                                <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" target="_blank">
                                                    {{ basename($pembayaran->bukti_pembayaran) }}
                                                </a>
                                            </small>
                                        </div>
                                        @endif
                                        @error('bukti_pembayaran')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="catatan">Catatan</label>
                                        <textarea class="form-control @error('catatan') is-invalid @enderror"
                                            id="catatan" name="catatan" rows="3">{{ old('catatan', $pembayaran->catatan) }}</textarea>
                                        @error('catatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <!-- Preview bukti pembayaran lama jika ada -->
                                    @if($pembayaran->bukti_pembayaran && in_array(pathinfo($pembayaran->bukti_pembayaran, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                    <div class="form-group">
                                        <label>Preview Bukti Saat Ini</label>
                                        <div class="text-center">
                                            <img src="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" alt="Preview" class="img-thumbnail" style="max-height: 200px;">
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Pembayaran
                            </button>
                            <a href="{{ route('admin.pembayaran.show', $pembayaran->id) }}" class="btn btn-info">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </a>
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
    // Preview gambar sebelum upload
    document.getElementById('bukti_pembayaran').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Remove existing preview
                const existingPreview = document.getElementById('image-preview');
                if (existingPreview) {
                    existingPreview.remove();
                }

                // Create new preview
                const preview = document.createElement('div');
                preview.id = 'image-preview';
                preview.className = 'mt-2 text-center';
                preview.innerHTML = `
                    <label>Preview Bukti Baru</label><br>
                    <img src="${e.target.result}" alt="Preview" class="img-thumbnail" style="max-height: 200px;">
                `;
                document.getElementById('bukti_pembayaran').parentNode.appendChild(preview);
            }
            reader.readAsDataURL(file);
        }
    });

    // Format number input
    document.getElementById('nominal').addEventListener('input', function(e) {
        // Remove non-numeric characters
        let value = e.target.value.replace(/[^0-9]/g, '');
        e.target.value = value;
    });
</script>
@endpush
@endsection