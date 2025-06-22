@extends('layouts.user')

@section('title', 'Dashboard Santri')
@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- <div class="progress mb-3">
            <div class="progress-bar 
                        @if($dataCompletion < 25) bg-danger
                        @elseif($dataCompletion < 50) bg-warning
                        @elseif($dataCompletion < 75) bg-info
                        @else bg-success
                        @endif"
                role="progressbar"
                data-progress="{{ $dataCompletion }}"
                aria-valuenow="{{ $dataCompletion }}" aria-valuemin="0" aria-valuemax="100">
                {{ $dataCompletion }}%
            </div>
        </div> -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalDokumen }}</h3>
                <p>Dokumen Terupload</p>
            </div>
            <div class="icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <a href="{{ route('user.dokumen') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $pembayaranSelesai }}</h3>
                <p>Pembayaran Selesai</p>
            </div>
            <div class="icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <a href="{{ route('user.pembayaran') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $statusVerifikasi['verified'] }}/{{ $statusVerifikasi['total'] }}</h3>
                <p>Data Terverifikasi</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <a href="{{ route('user.identitas') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $dataCompletion }}%</h3>
                <p>Data Completion</p>
            </div>
            <div class="icon">
                <i class="fas fa-chart-pie"></i>
            </div>
            <a href="{{ route('user.identitas') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Selamat Datang di Dashboard Santri</h3>
            </div>
            <div class="card-body">
                <p>Selamat datang, <strong>{{ Auth::user()->name ?? 'Santri' }}</strong>!</p>
                <p>Gunakan dashboard ini untuk mengelola data identitas, orangtua, dokumen, dan pembayaran Anda.</p>
                <div class="alert alert-info">
                    <h5><i class="icon fas fa-info"></i> Informasi Penting!</h5>
                    Pastikan untuk melengkapi semua data yang diperlukan untuk proses pendaftaran.
                </div>

                @if($dataCompletion < 100)
                    <div class="alert alert-warning">
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Status Pendaftaran</h5>
                    <p>Kelengkapan data Anda saat ini: <strong>{{ $dataCompletion }}%</strong></p>
                    <p>Status verifikasi: <strong>{{ $statusVerifikasi['status'] }}</strong> ({{ $statusVerifikasi['verified'] }} dari {{ $statusVerifikasi['total'] }} item terverifikasi)</p>
                    @if($dataCompletion < 50)
                        <p class="text-danger"><strong>Segera lengkapi data identitas dan orangtua Anda.</strong></p>
                        @elseif($dataCompletion < 75)
                            <p class="text-warning"><strong>Jangan lupa upload dokumen yang diperlukan.</strong></p>
                            @else
                            <p class="text-success"><strong>Hampir selesai! Pastikan semua pembayaran sudah lunas.</strong></p>
                            @endif
            </div>
            @else
            <div class="alert alert-success">
                <h5><i class="icon fas fa-check"></i> Selamat!</h5>
                <p>Data pendaftaran Anda sudah lengkap <strong>{{ $dataCompletion }}%</strong></p>
                <p>Status verifikasi: <strong>{{ $statusVerifikasi['status'] }}</strong></p>
                @if($statusVerifikasi['verified'] == $statusVerifikasi['total'])
                <p><strong>Semua data Anda sudah terverifikasi. Proses pendaftaran selesai!</strong></p>
                @else
                <p><strong>Menunggu verifikasi admin untuk beberapa data.</strong></p>
                @endif
            </div>
            @endif
        </div>
    </div>
</div>
</div>

<!-- Quick Actions Row -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-rocket"></i>
                    Aksi Cepat
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <a href="{{ route('user.identitas') }}" class="btn btn-primary btn-block">
                            <i class="fas fa-id-card"></i><br>
                            Data Identitas
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="{{ route('user.orangtua') }}" class="btn btn-info btn-block">
                            <i class="fas fa-user-friends"></i><br>
                            Data Orangtua
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="{{ route('user.dokumen') }}" class="btn btn-warning btn-block">
                            <i class="fas fa-file-upload"></i><br>
                            Upload Dokumen
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <a href="{{ route('user.pembayaran') }}" class="btn btn-success btn-block">
                            <i class="fas fa-money-bill-wave"></i><br>
                            Pembayaran
                        </a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <a href="{{ route('user.cetakpdf') }}" class="btn btn-danger btn-block btn-lg">
                            <i class="fas fa-print"></i>
                            <strong>Cetak Formulir Pendaftaran</strong>
                        </a>
                        <small class="text-muted d-block text-center mt-1">
                            Download PDF formulir pendaftaran untuk dibawa saat verifikasi
                        </small>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <a href="{{ route('user.pengaturanakun') }}" class="btn btn-secondary btn-block btn-lg">
                            <i class="fas fa-cog"></i>
                            <strong>Pengaturan Akun</strong>
                        </a>
                        <small class="text-muted d-block text-center mt-1">
                            Kelola profil, password, dan pengaturan akun Anda
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Progress Overview -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-tasks"></i>
                    Progress Pendaftaran
                </h3>
            </div>
            <div class="card-body">
                <!-- <div class="progress mb-3">
                    <div class="progress-bar 
                        @if($dataCompletion < 25) bg-danger
                        @elseif($dataCompletion < 50) bg-warning
                        @elseif($dataCompletion < 75) bg-info
                        @else bg-success
                        @endif"
                        role="progressbar"
                        data-progress="{{ $dataCompletion }}"
                        aria-valuenow="{{ $dataCompletion }}" aria-valuemin="0" aria-valuemax="100">
                        {{ $dataCompletion }}%
                    </div>
                </div> -->

                <div class="row">
                    <div class="col-md-3">
                        <div class="info-box bg-light">
                            <span class="info-box-icon 
                                @if(\App\Models\Identitas::where('user_id', Auth::id())->exists()) 
                                    bg-success
                                @else 
                                    bg-warning
                                @endif">
                                <i class="fas fa-id-card"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Identitas</span>
                                <span class="info-box-number">
                                    @if(\App\Models\Identitas::where('user_id', Auth::id())->exists())
                                    <i class="fas fa-check text-success"></i>
                                    @else
                                    <i class="fas fa-times text-danger"></i>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box bg-light">
                            <span class="info-box-icon 
                                @if(\App\Models\Orangtua::where('user_id', Auth::id())->exists()) 
                                    bg-success
                                @else 
                                    bg-warning
                                @endif">
                                <i class="fas fa-user-friends"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Orangtua</span>
                                <span class="info-box-number">
                                    @if(\App\Models\Orangtua::where('user_id', Auth::id())->exists())
                                    <i class="fas fa-check text-success"></i>
                                    @else
                                    <i class="fas fa-times text-danger"></i>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box bg-light">
                            <span class="info-box-icon 
                                @if($totalDokumen > 0) 
                                    bg-success
                                @else 
                                    bg-warning
                                @endif">
                                <i class="fas fa-file-upload"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Dokumen</span>
                                <span class="info-box-number">{{ $totalDokumen }}/5</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box bg-light">
                            <span class="info-box-icon 
                                @if($pembayaranSelesai > 0) 
                                    bg-success
                                @else 
                                    bg-warning
                                @endif">
                                <i class="fas fa-money-bill-wave"></i>
                            </span>
                            <div class="info-box-content">
                                <span class="info-box-text">Pembayaran</span>
                                <span class="info-box-number">
                                    @if($pembayaranSelesai > 0)
                                    <i class="fas fa-check text-success"></i>
                                    @else
                                    <i class="fas fa-times text-danger"></i>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-bar"></i>
                    Ringkasan
                </h3>
            </div>
            <div class="card-body">
                <div class="callout callout-info">
                    <h5>Status Verifikasi</h5>
                    <p>{{ $statusVerifikasi['verified'] }} dari {{ $statusVerifikasi['total'] }} item telah diverifikasi</p>
                </div>

                @php
                $pendingItems = [];
                $identitas = \App\Models\Identitas::where('user_id', Auth::id())->first();
                $dokumen = \App\Models\Dokumen::where('user_id', Auth::id())->first();
                $orangtua = \App\Models\Orangtua::where('user_id', Auth::id())->exists();
                $pembayaran = \App\Models\Pembayaran::where('user_id', Auth::id())->where('status_verifikasi', 'approved')->exists();

                if (!$identitas) $pendingItems[] = 'Data Identitas';
                if (!$orangtua) $pendingItems[] = 'Data Orangtua';
                if (!$dokumen || $totalDokumen == 0) $pendingItems[] = 'Upload Dokumen';
                if (!$pembayaran) $pendingItems[] = 'Pembayaran';
                @endphp

                @if(count($pendingItems) > 0)
                <div class="callout callout-warning">
                    <h5>Perlu Dilengkapi:</h5>
                    <ul class="mb-0">
                        @foreach($pendingItems as $item)
                        <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
                @else
                <div class="callout callout-success">
                    <h5><i class="fas fa-check"></i> Lengkap!</h5>
                    <p class="mb-0">Semua data pendaftaran sudah lengkap</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        // Set progress bar width dynamically
        $('.progress-bar[data-progress]').each(function() {
            const progress = $(this).data('progress');
            $(this).css('width', progress + '%');
        });
    });
</script>
@endpush