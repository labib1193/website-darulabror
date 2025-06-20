@extends('layouts.user')

@section('title', 'Cetak Formulir Pendaftaran')
@section('page-title', 'Cetak Formulir Pendaftaran')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-print"></i>
                    Cetak Formulir Pendaftaran
                </h3>
            </div>
            <div class="card-body">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fas fa-check"></i>
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fas fa-ban"></i>
                    {{ session('error') }}
                </div>
                @endif

                <div class="row">
                    <div class="col-md-8">
                        <h5>Formulir Pendaftaran Santri</h5>
                        <p class="text-muted">
                            Formulir ini berisi ringkasan data pendaftaran Anda yang dapat dicetak dalam format PDF.
                            Formulir ini diperlukan untuk keperluan verifikasi berkas dengan panitia pendaftaran.
                        </p>

                        @if($user->identitas)
                        <div class="alert alert-info">
                            <h5><i class="icon fas fa-info"></i> Informasi Formulir</h5>
                            <ul class="mb-0">
                                <li><strong>Nama:</strong> {{ $user->name }}</li>
                                <li><strong>Email:</strong> {{ $user->email }}</li>
                                @if($user->identitas)
                                <li><strong>NIK:</strong> {{ $user->identitas->nik ?? 'Belum diisi' }}</li>
                                <li><strong>Status Verifikasi:</strong>
                                    @if($user->identitas->status_verifikasi == 'terverifikasi')
                                    <span class="badge badge-success">Terverifikasi</span>
                                    @elseif($user->identitas->status_verifikasi == 'pending')
                                    <span class="badge badge-warning">Menunggu Verifikasi</span>
                                    @else
                                    <span class="badge badge-danger">Belum Terverifikasi</span>
                                    @endif
                                </li>
                                @endif
                                <li><strong>Tanggal Pendaftaran:</strong> {{ $user->created_at->format('d F Y') }}</li>
                            </ul>
                        </div>

                        <div class="alert alert-warning">
                            <h5><i class="icon fas fa-exclamation-triangle"></i> Penting!</h5>
                            <p class="mb-0">
                                Pastikan semua data telah lengkap sebelum mencetak formulir.
                                Tunjukkan formulir ini (bisa dicetak atau tetap berupa digital) kepada panitia pendaftaran untuk keperluan verifikasi berkas.
                            </p>
                        </div>
                        @else
                        <div class="alert alert-danger">
                            <h5><i class="icon fas fa-exclamation-triangle"></i> Data Belum Lengkap!</h5>
                            <p class="mb-0">
                                Anda harus melengkapi data identitas terlebih dahulu sebelum dapat mencetak formulir pendaftaran.
                                <a href="{{ route('user.identitas') }}" class="btn btn-sm btn-primary ml-2">
                                    <i class="fas fa-edit"></i> Lengkapi Data Identitas
                                </a>
                            </p>
                        </div>
                        @endif
                    </div>

                    <div class="col-md-4">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Aksi Cetak</h3>
                            </div>
                            <div class="card-body">
                                @if($user->identitas)
                                <div class="d-grid gap-2 d-md-block">
                                    <a href="{{ route('user.cetakpdf.preview') }}"
                                        class="btn btn-info btn-block"
                                        target="_blank">
                                        <i class="fas fa-eye"></i>
                                        Preview PDF
                                    </a>
                                    <form action="{{ url('user/cetakpdf/generate') }}" method="POST" class="mt-2">
                                        @csrf
                                        <button type="submit" class="btn btn-primary btn-block">
                                            <i class="fas fa-download"></i>
                                            Download PDF
                                        </button>
                                    </form>
                                </div>
                                @else
                                <div class="text-center">
                                    <i class="fas fa-exclamation-circle fa-3x text-muted mb-3"></i>
                                    <p class="text-muted">Data identitas diperlukan untuk mencetak formulir</p>
                                    <a href="{{ route('user.identitas') }}" class="btn btn-primary">
                                        <i class="fas fa-edit"></i> Lengkapi Data
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>

                        @if($user->identitas)
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h3 class="card-title">Status Kelengkapan</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li>
                                        <i class="fas fa-check-circle text-success"></i>
                                        Data Identitas
                                    </li>
                                    <!-- <li>
                                        @if($user->orangtua && $user->orangtua->count() > 0)
                                        <i class="fas fa-check-circle text-success"></i>
                                        @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                        @endif
                                        Data Orangtua/Wali
                                    </li> -->
                                    <li>
                                        @if($user->dokumen)
                                        <i class="fas fa-check-circle text-success"></i>
                                        @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                        @endif
                                        Dokumen Pendukung
                                    </li>
                                    <li>
                                        @if($user->pembayaran && $user->pembayaran->count() > 0)
                                        <i class="fas fa-check-circle text-success"></i>
                                        @else
                                        <i class="fas fa-times-circle text-danger"></i>
                                        @endif
                                        Pembayaran
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-question-circle"></i>
                    Panduan Penggunaan
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Cara Mencetak Formulir:</h5>
                        <ol>
                            <li>Pastikan semua data identitas sudah terisi lengkap</li>
                            <li>Klik tombol "Preview PDF" untuk melihat hasil formulir</li>
                            <li>Jika sudah sesuai, klik "Download PDF" untuk mengunduh</li>
                            <li>Simpan file PDF atau langsung cetak menggunakan printer</li>
                            <li>Bawa formulir saat datang ke tempat pendaftaran</li>
                        </ol>
                    </div>
                    <div class="col-md-6">
                        <h5>Informasi Penting:</h5>
                        <ul>
                            <li>Formulir berisi kop surat resmi Pondok Pesantren Darul Abror</li>
                            <li>Data yang ditampilkan sesuai dengan yang Anda input</li>
                            <li>Formulir dapat ditunjukkan dalam bentuk digital atau cetak</li>
                            <li>Pastikan data sudah benar sebelum mencetak</li>
                            <li>Hubungi panitia jika ada kesalahan data</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Add loading state for download button
        $('form[action="{{ url("user/cetakpdf/generate") }}"]').on('submit', function() {
            var $btn = $(this).find('button[type="submit"]');
            var originalText = $btn.html();

            $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Memproses...');

            // Re-enable button after 5 seconds (in case download completes)
            setTimeout(function() {
                $btn.prop('disabled', false).html(originalText);
            }, 5000);
        });
    });
</script>
@endpush