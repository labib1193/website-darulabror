@extends('layouts.admin')

@section('title', 'Detail Dokumen - ')
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
                @if($dokumen->user)
                <div class="row">
                    <div class="col-md-6">
                        <strong>Nama:</strong> {{ $dokumen->user->name ?? 'Tidak tersedia' }}<br>
                        <strong>Email:</strong> {{ $dokumen->user->email ?? 'Tidak tersedia' }}<br>
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
                        <strong>Progress Upload:</strong> {{ $dokumen->getCompletionPercentage() ?? 0 }}%<br>
                        <div class="progress mt-2">
                            <div class="progress-bar bg-primary" role="progressbar" data-width="{{ $dokumen->getCompletionPercentage() ?? 0 }}"></div>
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
                @else
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Peringatan:</strong> Data user untuk dokumen ini tidak ditemukan.
                </div>
                @endif

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
                        @php
                        $fotoKtpUrl = $dokumen->getFileUrl('foto_ktp');
                        @endphp
                        @if($fotoKtpUrl)
                        <img src="{{ $fotoKtpUrl }}" alt="Foto KTP" class="img-fluid mb-3" style="max-height: 200px;" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                        <div class="text-warning" style="display: none;">
                            <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                            <p>Gambar tidak dapat dimuat</p>
                        </div>
                        <br>
                        <p class="text-sm">
                            <strong>File:</strong> {{ $dokumen->foto_ktp_original ?? 'Tidak tersedia' }}<br>
                            <strong>Ukuran:</strong> {{ $dokumen->getFormattedFileSize('foto_ktp') }}<br>
                            <strong>Upload:</strong> {{ $dokumen->foto_ktp_uploaded_at ? $dokumen->foto_ktp_uploaded_at->format('d/m/Y H:i') : 'Tidak tersedia' }}
                        </p>
                        @if($fotoKtpUrl)
                        <a href="{{ $fotoKtpUrl }}" target="_blank" class="btn btn-success btn-sm">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                        <a href="{{ route('admin.dokumen.download', [$dokumen->id, 'foto_ktp']) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-download"></i> Download
                        </a>
                        @endif
                        @else
                        <div class="text-warning">
                            <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                            <p>File tersedia tetapi tidak dapat dimuat</p>
                        </div>
                        @endif
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
                        @php
                        $fotoKkUrl = $dokumen->getFileUrl('foto_kk');
                        @endphp
                        @if($fotoKkUrl)
                        <img src="{{ $fotoKkUrl }}" alt="Foto KK" class="img-fluid mb-3" style="max-height: 200px;" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                        <div class="text-warning" style="display: none;">
                            <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                            <p>Gambar tidak dapat dimuat</p>
                        </div>
                        <br>
                        <p class="text-sm">
                            <strong>File:</strong> {{ $dokumen->foto_kk_original ?? 'Tidak tersedia' }}<br>
                            <strong>Ukuran:</strong> {{ $dokumen->getFormattedFileSize('foto_kk') }}<br>
                            <strong>Upload:</strong> {{ $dokumen->foto_kk_uploaded_at ? $dokumen->foto_kk_uploaded_at->format('d/m/Y H:i') : 'Tidak tersedia' }}
                        </p>
                        <a href="{{ $fotoKkUrl }}" target="_blank" class="btn btn-success btn-sm">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                        <a href="{{ route('admin.dokumen.download', [$dokumen->id, 'foto_kk']) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-download"></i> Download
                        </a>
                        @else
                        <div class="text-warning">
                            <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                            <p>File tersedia tetapi tidak dapat dimuat</p>
                        </div>
                        @endif
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
                        @php
                        $fotoIjazahUrl = $dokumen->getFileUrl('foto_ijazah');
                        @endphp
                        @if($fotoIjazahUrl)
                        <img src="{{ $fotoIjazahUrl }}" alt="Foto Ijazah" class="img-fluid mb-3" style="max-height: 200px;" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                        <div class="text-warning" style="display: none;">
                            <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                            <p>Gambar tidak dapat dimuat</p>
                        </div>
                        <br>
                        <p class="text-sm">
                            <strong>File:</strong> {{ $dokumen->foto_ijazah_original ?? 'Tidak tersedia' }}<br>
                            <strong>Ukuran:</strong> {{ $dokumen->getFormattedFileSize('foto_ijazah') }}<br>
                            <strong>Upload:</strong> {{ $dokumen->foto_ijazah_uploaded_at ? $dokumen->foto_ijazah_uploaded_at->format('d/m/Y H:i') : 'Tidak tersedia' }}
                        </p>
                        <a href="{{ $fotoIjazahUrl }}" target="_blank" class="btn btn-success btn-sm">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                        <a href="{{ route('admin.dokumen.download', [$dokumen->id, 'foto_ijazah']) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-download"></i> Download
                        </a>
                        @else
                        <div class="text-warning">
                            <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                            <p>File tersedia tetapi tidak dapat dimuat</p>
                        </div>
                        @endif
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
                        @php
                        $pasFotoUrl = $dokumen->getFileUrl('pas_foto');
                        @endphp
                        @if($pasFotoUrl)
                        <img src="{{ $pasFotoUrl }}" alt="Pas Foto" class="img-fluid mb-3" style="max-height: 200px;" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                        <div class="text-warning" style="display: none;">
                            <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                            <p>Gambar tidak dapat dimuat</p>
                        </div>
                        <br>
                        <p class="text-sm">
                            <strong>File:</strong> {{ $dokumen->pas_foto_original ?? 'Tidak tersedia' }}<br>
                            <strong>Ukuran:</strong> {{ $dokumen->getFormattedFileSize('pas_foto') }}<br>
                            <strong>Upload:</strong> {{ $dokumen->pas_foto_uploaded_at ? $dokumen->pas_foto_uploaded_at->format('d/m/Y H:i') : 'Tidak tersedia' }}
                        </p>
                        <a href="{{ $pasFotoUrl }}" target="_blank" class="btn btn-success btn-sm">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                        <a href="{{ route('admin.dokumen.download', [$dokumen->id, 'pas_foto']) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-download"></i> Download
                        </a>
                        @else
                        <div class="text-warning">
                            <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                            <p>File tersedia tetapi tidak dapat dimuat</p>
                        </div>
                        @endif
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
                        $suratSehatUrl = $dokumen->getFileUrl('surat_sehat');
                        $extension = $dokumen->surat_sehat ? pathinfo($dokumen->surat_sehat, PATHINFO_EXTENSION) : '';
                        @endphp
                        @if($suratSehatUrl)
                        @if(in_array(strtolower($extension), ['jpg', 'jpeg', 'png']))
                        <img src="{{ $suratSehatUrl }}" alt="Surat Sehat" class="img-fluid mb-3" style="max-height: 200px;" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                        <div class="text-warning" style="display: none;">
                            <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                            <p>Gambar tidak dapat dimuat</p>
                        </div>
                        @else
                        <div class="text-center mb-3">
                            <i class="fas fa-file-pdf fa-3x text-danger"></i>
                            <p class="mt-2">File PDF</p>
                        </div>
                        @endif
                        <br>
                        <p class="text-sm">
                            <strong>File:</strong> {{ $dokumen->surat_sehat_original ?? 'Tidak tersedia' }}<br>
                            <strong>Ukuran:</strong> {{ $dokumen->getFormattedFileSize('surat_sehat') }}<br>
                            <strong>Upload:</strong> {{ $dokumen->surat_sehat_uploaded_at ? $dokumen->surat_sehat_uploaded_at->format('d/m/Y H:i') : 'Tidak tersedia' }}
                        </p>
                        <a href="{{ $suratSehatUrl }}" target="_blank" class="btn btn-success btn-sm">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                        <a href="{{ route('admin.dokumen.download', [$dokumen->id, 'surat_sehat']) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-download"></i> Download
                        </a>
                        @else
                        <div class="text-warning">
                            <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                            <p>File tersedia tetapi tidak dapat dimuat</p>
                        </div>
                        @endif
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