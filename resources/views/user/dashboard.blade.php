@extends('layouts.user')

@section('title', 'Dashboard Santri')
@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>5</h3>
                <p>Total Dokumen</p>
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
                <h3>1</h3>
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
                <h3>3</h3>
                <p>Notifikasi</p>
            </div>
            <div class="icon">
                <i class="fas fa-bell"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>85%</h3>
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
@endsection