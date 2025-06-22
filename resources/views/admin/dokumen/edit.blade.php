@extends('layouts.admin')

@section('title', 'Edit Dokumen - ')
@section('page-title', 'Edit Dokumen')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.dokumen.index') }}">Data Dokumen</a></li>
<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Edit Dokumen - {{ $dokumen->user->name }}</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.dokumen.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <form action="{{ route('admin.dokumen.update', $dokumen->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <!-- User Info (Read Only) -->
                    <div class="alert alert-info">
                        <strong>User:</strong> {{ $dokumen->user->name }} ({{ $dokumen->user->email }})
                    </div>

                    <!-- Status Verifikasi dan Catatan -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status_verifikasi">Status Verifikasi <span class="text-danger">*</span></label>
                                <select class="form-control @error('status_verifikasi') is-invalid @enderror"
                                    id="status_verifikasi" name="status_verifikasi" required>
                                    <option value="">Pilih Status</option>
                                    <option value="pending" {{ old('status_verifikasi', $dokumen->status_verifikasi) == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>
                                    <option value="approved" {{ old('status_verifikasi', $dokumen->status_verifikasi) == 'approved' ? 'selected' : '' }}>
                                        Disetujui
                                    </option>
                                    <option value="rejected" {{ old('status_verifikasi', $dokumen->status_verifikasi) == 'rejected' ? 'selected' : '' }}>
                                        Ditolak
                                    </option>
                                </select>
                                @error('status_verifikasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="catatan_verifikasi">Catatan Verifikasi</label>
                                <textarea class="form-control @error('catatan_verifikasi') is-invalid @enderror"
                                    id="catatan_verifikasi" name="catatan_verifikasi" rows="3"
                                    placeholder="Catatan untuk verifikasi dokumen...">{{ old('catatan_verifikasi', $dokumen->catatan_verifikasi) }}</textarea>
                                @error('catatan_verifikasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Upload Dokumen -->
                    <h5><i class="fas fa-upload"></i> Upload Dokumen Baru (Opsional)</h5>
                    <p class="text-muted">Upload file baru jika diperlukan. File lama akan diganti.</p>

                    <div class="row">
                        <!-- Foto KTP -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto_ktp">Foto KTP</label>
                                @if($dokumen->foto_ktp)
                                <div class="mb-2">
                                    <small class="text-success">
                                        <i class="fas fa-check"></i> File saat ini: {{ $dokumen->foto_ktp_original }}
                                        ({{ $dokumen->getFormattedFileSize('foto_ktp') }})
                                    </small>
                                </div>
                                @endif
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('foto_ktp') is-invalid @enderror"
                                            id="foto_ktp" name="foto_ktp" accept=".jpg,.jpeg,.png,.pdf">
                                        <label class="custom-file-label" for="foto_ktp">Pilih file baru...</label>
                                    </div>
                                </div>
                                <small class="text-muted">Format: JPG, JPEG, PNG, PDF. Maksimal 2MB.</small>
                                @error('foto_ktp')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Foto Kartu Keluarga -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto_kk">Foto Kartu Keluarga</label>
                                @if($dokumen->foto_kk)
                                <div class="mb-2">
                                    <small class="text-success">
                                        <i class="fas fa-check"></i> File saat ini: {{ $dokumen->foto_kk_original }}
                                        ({{ $dokumen->getFormattedFileSize('foto_kk') }})
                                    </small>
                                </div>
                                @endif
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('foto_kk') is-invalid @enderror"
                                            id="foto_kk" name="foto_kk" accept=".jpg,.jpeg,.png,.pdf">
                                        <label class="custom-file-label" for="foto_kk">Pilih file baru...</label>
                                    </div>
                                </div>
                                <small class="text-muted">Format: JPG, JPEG, PNG, PDF. Maksimal 2MB.</small>
                                @error('foto_kk')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Foto Ijazah -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto_ijazah">Foto Ijazah</label>
                                @if($dokumen->foto_ijazah)
                                <div class="mb-2">
                                    <small class="text-success">
                                        <i class="fas fa-check"></i> File saat ini: {{ $dokumen->foto_ijazah_original }}
                                        ({{ $dokumen->getFormattedFileSize('foto_ijazah') }})
                                    </small>
                                </div>
                                @endif
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('foto_ijazah') is-invalid @enderror"
                                            id="foto_ijazah" name="foto_ijazah" accept=".jpg,.jpeg,.png,.pdf">
                                        <label class="custom-file-label" for="foto_ijazah">Pilih file baru...</label>
                                    </div>
                                </div>
                                <small class="text-muted">Format: JPG, JPEG, PNG, PDF. Maksimal 2MB.</small>
                                @error('foto_ijazah')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Pas Foto -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pas_foto">Pas Foto</label>
                                @if($dokumen->pas_foto)
                                <div class="mb-2">
                                    <small class="text-success">
                                        <i class="fas fa-check"></i> File saat ini: {{ $dokumen->pas_foto_original }}
                                        ({{ $dokumen->getFormattedFileSize('pas_foto') }})
                                    </small>
                                </div>
                                @endif
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('pas_foto') is-invalid @enderror"
                                            id="pas_foto" name="pas_foto" accept=".jpg,.jpeg,.png">
                                        <label class="custom-file-label" for="pas_foto">Pilih file baru...</label>
                                    </div>
                                </div>
                                <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB.</small>
                                @error('pas_foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Surat Sehat -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="surat_sehat">Surat Keterangan Sehat</label>
                                @if($dokumen->surat_sehat)
                                <div class="mb-2">
                                    <small class="text-success">
                                        <i class="fas fa-check"></i> File saat ini: {{ $dokumen->surat_sehat_original }}
                                        ({{ $dokumen->getFormattedFileSize('surat_sehat') }})
                                    </small>
                                </div>
                                @endif
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('surat_sehat') is-invalid @enderror"
                                            id="surat_sehat" name="surat_sehat" accept=".jpg,.jpeg,.png,.pdf">
                                        <label class="custom-file-label" for="surat_sehat">Pilih file baru...</label>
                                    </div>
                                </div>
                                <small class="text-muted">Format: JPG, JPEG, PNG, PDF. Maksimal 2MB.</small>
                                @error('surat_sehat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Dokumen
                    </button>
                    <a href="{{ route('admin.dokumen.show', $dokumen->id) }}" class="btn btn-secondary">
                        <i class="fas fa-eye"></i> Lihat Detail
                    </a>
                    <a href="{{ route('admin.dokumen.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        // Custom file input labels
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });
</script>
@endpush