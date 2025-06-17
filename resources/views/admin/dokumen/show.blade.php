@extends('layouts.admin')

@section('title', 'Detail Dokumen')
@section('page-title', 'Detail Dokumen')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.dokumen.index') }}">Data Dokumen</a></li>
<li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div class="row">
    <!-- User Information -->
    <div class="col-12 mb-3">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user"></i> Informasi User
                </h3>
                <div class="card-tools">
                    <a href="{{ route('admin.dokumen.edit', $dokumen->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('admin.dokumen.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>Nama:</strong> {{ $dokumen->user->name }}<br>
                        <strong>Email:</strong> {{ $dokumen->user->email }}<br>
                        <strong>Status Verifikasi:</strong>
                        @if($dokumen->status_verifikasi == 'approved')
                        <span class="badge badge-success">
                            <i class="fas fa-check-circle"></i> Disetujui
                        </span>
                        @elseif($dokumen->status_verifikasi == 'rejected')
                        <span class="badge badge-danger">
                            <i class="fas fa-times-circle"></i> Ditolak
                        </span>
                        @else
                        <span class="badge badge-warning">
                            <i class="fas fa-clock"></i> Pending
                        </span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <strong>Progress Upload:</strong> {{ $dokumen->getCompletionPercentage() }}%<br>
                        <div class="progress mt-2">
                            <div class="progress-bar bg-primary" role="progressbar" data-width="{{ $dokumen->getCompletionPercentage() }}"></div>
                        </div>
                        <small class="text-muted">{{ array_sum([
                            !empty($dokumen->foto_ktp) ? 1 : 0,
                            !empty($dokumen->foto_ijazah) ? 1 : 0,
                            !empty($dokumen->surat_sehat) ? 1 : 0,
                            !empty($dokumen->foto_kk) ? 1 : 0,
                            !empty($dokumen->pas_foto) ? 1 : 0
                        ]) }} dari 5 dokumen lengkap</small>
                    </div>
                </div>
                @if($dokumen->catatan_verifikasi)
                <hr>
                <strong>Catatan Verifikasi:</strong><br>
                <div class="alert alert-info">
                    {{ $dokumen->catatan_verifikasi }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Documents -->
    <div class="col-12">
        <div class="row">
            <!-- Foto KTP -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-gradient-primary">
                        <h3 class="card-title">
                            <i class="fas fa-id-card"></i> Foto KTP
                        </h3>
                    </div>
                    <div class="card-body text-center">
                        @if($dokumen->foto_ktp)
                        <img src="{{ Storage::url($dokumen->foto_ktp) }}" alt="Foto KTP" class="img-fluid mb-3" style="max-height: 200px;">
                        <br>
                        <p class="text-sm">
                            <strong>File:</strong> {{ $dokumen->foto_ktp_original }}<br>
                            <strong>Ukuran:</strong> {{ $dokumen->getFormattedFileSize('foto_ktp') }}<br>
                            <strong>Upload:</strong> {{ $dokumen->foto_ktp_uploaded_at->format('d/m/Y H:i') }}
                        </p> <a href="{{ Storage::url($dokumen->foto_ktp) }}" target="_blank" class="btn btn-success btn-sm">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                        <a href="{{ route('admin.dokumen.download', [$dokumen->id, 'foto_ktp']) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-download"></i> Download
                        </a>
                        @else
                        <div class="text-muted">
                            <i class="fas fa-times-circle fa-3x mb-3"></i>
                            <p>Belum ada file yang diupload</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Foto Kartu Keluarga -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-gradient-info">
                        <h3 class="card-title">
                            <i class="fas fa-users"></i> Foto Kartu Keluarga
                        </h3>
                    </div>
                    <div class="card-body text-center">
                        @if($dokumen->foto_kk)
                        <img src="{{ Storage::url($dokumen->foto_kk) }}" alt="Foto KK" class="img-fluid mb-3" style="max-height: 200px;">
                        <br>
                        <p class="text-sm">
                            <strong>File:</strong> {{ $dokumen->foto_kk_original }}<br>
                            <strong>Ukuran:</strong> {{ $dokumen->getFormattedFileSize('foto_kk') }}<br>
                            <strong>Upload:</strong> {{ $dokumen->foto_kk_uploaded_at->format('d/m/Y H:i') }}
                        </p> <a href="{{ Storage::url($dokumen->foto_kk) }}" target="_blank" class="btn btn-success btn-sm">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                        <a href="{{ route('admin.dokumen.download', [$dokumen->id, 'foto_kk']) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-download"></i> Download
                        </a>
                        @else
                        <div class="text-muted">
                            <i class="fas fa-times-circle fa-3x mb-3"></i>
                            <p>Belum ada file yang diupload</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <!-- Foto Ijazah -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-gradient-success">
                        <h3 class="card-title">
                            <i class="fas fa-graduation-cap"></i> Foto Ijazah
                        </h3>
                    </div>
                    <div class="card-body text-center">
                        @if($dokumen->foto_ijazah)
                        <img src="{{ Storage::url($dokumen->foto_ijazah) }}" alt="Foto Ijazah" class="img-fluid mb-3" style="max-height: 200px;">
                        <br>
                        <p class="text-sm">
                            <strong>File:</strong> {{ $dokumen->foto_ijazah_original }}<br>
                            <strong>Ukuran:</strong> {{ $dokumen->getFormattedFileSize('foto_ijazah') }}<br>
                            <strong>Upload:</strong> {{ $dokumen->foto_ijazah_uploaded_at->format('d/m/Y H:i') }}
                        </p> <a href="{{ Storage::url($dokumen->foto_ijazah) }}" target="_blank" class="btn btn-success btn-sm">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                        <a href="{{ route('admin.dokumen.download', [$dokumen->id, 'foto_ijazah']) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-download"></i> Download
                        </a>
                        @else
                        <div class="text-muted">
                            <i class="fas fa-times-circle fa-3x mb-3"></i>
                            <p>Belum ada file yang diupload</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Pas Foto -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-gradient-warning">
                        <h3 class="card-title">
                            <i class="fas fa-portrait"></i> Pas Foto
                        </h3>
                    </div>
                    <div class="card-body text-center">
                        @if($dokumen->pas_foto)
                        <img src="{{ Storage::url($dokumen->pas_foto) }}" alt="Pas Foto" class="img-fluid mb-3" style="max-height: 200px;">
                        <br>
                        <p class="text-sm">
                            <strong>File:</strong> {{ $dokumen->pas_foto_original }}<br>
                            <strong>Ukuran:</strong> {{ $dokumen->getFormattedFileSize('pas_foto') }}<br>
                            <strong>Upload:</strong> {{ $dokumen->pas_foto_uploaded_at->format('d/m/Y H:i') }}
                        </p> <a href="{{ Storage::url($dokumen->pas_foto) }}" target="_blank" class="btn btn-success btn-sm">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                        <a href="{{ route('admin.dokumen.download', [$dokumen->id, 'pas_foto']) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-download"></i> Download
                        </a>
                        @else
                        <div class="text-muted">
                            <i class="fas fa-times-circle fa-3x mb-3"></i>
                            <p>Belum ada file yang diupload</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <!-- Surat Sehat -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-gradient-danger">
                        <h3 class="card-title">
                            <i class="fas fa-file-medical"></i> Surat Keterangan Sehat
                        </h3>
                    </div>
                    <div class="card-body text-center">
                        @if($dokumen->surat_sehat)
                        @php
                        $extension = pathinfo($dokumen->surat_sehat, PATHINFO_EXTENSION);
                        @endphp
                        @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png']))
                        <img src="{{ Storage::url($dokumen->surat_sehat) }}" alt="Surat Sehat" class="img-fluid mb-3" style="max-height: 200px;">
                        @else
                        <div class="text-center mb-3">
                            <i class="fas fa-file-pdf fa-3x text-danger"></i>
                            <p class="mt-2">File PDF</p>
                        </div>
                        @endif
                        <br>
                        <p class="text-sm">
                            <strong>File:</strong> {{ $dokumen->surat_sehat_original }}<br>
                            <strong>Ukuran:</strong> {{ $dokumen->getFormattedFileSize('surat_sehat') }}<br>
                            <strong>Upload:</strong> {{ $dokumen->surat_sehat_uploaded_at->format('d/m/Y H:i') }}
                        </p> <a href="{{ Storage::url($dokumen->surat_sehat) }}" target="_blank" class="btn btn-success btn-sm">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                        <a href="{{ route('admin.dokumen.download', [$dokumen->id, 'surat_sehat']) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-download"></i> Download
                        </a>
                        @else
                        <div class="text-muted">
                            <i class="fas fa-times-circle fa-3x mb-3"></i>
                            <p>Belum ada file yang diupload</p>
                        </div>
                        @endif
                    </div>
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
    });
</script>
@endpush