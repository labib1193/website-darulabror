@extends('layouts.admin')

@section('title', 'Detail User - ')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Data User</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <!-- Profile Card -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            @if($user->profile_photo)
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ $user->getProfilePhotoUrl() }}"
                                alt="{{ $user->name }}"
                                style="width: 150px; height: 150px; object-fit: cover;">
                            @else
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}"
                                alt="Default Avatar"
                                style="width: 150px; height: 150px; object-fit: cover;">
                            @endif
                        </div>

                        <h3 class="profile-username text-center">{{ $user->name }}</h3>

                        <p class="text-muted text-center">
                            @if($user->role == 'admin')
                            <span class="badge badge-success badge-lg">
                                <i class="fas fa-user-shield"></i> Administrator
                            </span>
                            @elseif($user->role == 'superadmin')
                            <span class="badge badge-danger badge-lg">
                                <i class="fas fa-crown"></i> Super Administrator
                            </span>
                            @else
                            <span class="badge badge-primary badge-lg">
                                <i class="fas fa-user"></i> User
                            </span>
                            @endif
                        </p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Email</b> <span class="float-right">{{ $user->email }}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Status Email</b>
                                <span class="float-right">
                                    @if($user->email_verified_at)
                                    <span class="badge badge-success">
                                        <i class="fas fa-check-circle"></i> Terverifikasi
                                    </span>
                                    <small class="text-muted d-block">{{ $user->email_verified_at->format('d/m/Y H:i') }}</small>
                                    @else
                                    <span class="badge badge-warning">
                                        <i class="fas fa-clock"></i> Belum Verifikasi
                                    </span>
                                    @endif
                                </span>
                            </li>
                            <li class="list-group-item">
                                <b>Bergabung</b> <span class="float-right">{{ $user->created_at->format('d/m/Y') }}</span>
                            </li>
                            <li class="list-group-item">
                                <b>Terakhir Update</b> <span class="float-right">{{ $user->updated_at->format('d/m/Y H:i') }}</span>
                            </li>
                        </ul>

                        <div class="row">
                            <div class="col-6">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-block">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-block">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- Quick Actions Card -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Aksi Cepat</h3>
                    </div>
                    <div class="card-body">
                        @if($user->role != 'superadmin' && Auth::user()->id != $user->id)
                        <!-- Reset Password -->
                        <form action="{{ route('admin.users.resetPassword', $user->id) }}" method="POST" class="mb-2">
                            @csrf
                            <button type="submit" class="btn btn-info btn-block"
                                onclick="return confirm('Apakah Anda yakin ingin mereset password user ini?')">
                                <i class="fas fa-key"></i> Reset Password
                            </button>
                        </form>

                        <!-- Delete User -->
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-block"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus user ini? Tindakan ini tidak dapat dibatalkan.')">
                                <i class="fas fa-trash"></i> Hapus User
                            </button>
                        </form>
                        @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            Super Admin tidak dapat dihapus atau direset passwordnya.
                        </div>
                        @endif
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->

            <div class="col-md-8">
                <!-- User Activities -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Detail User</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 30%">ID User</th>
                                    <td>{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Role/Peran</th>
                                    <td>
                                        @if($user->role == 'admin')
                                        <span class="badge badge-success">
                                            <i class="fas fa-user-shield"></i> Administrator
                                        </span>
                                        <small class="text-muted d-block">Dapat mengelola data dan user</small>
                                        @elseif($user->role == 'superadmin')
                                        <span class="badge badge-danger">
                                            <i class="fas fa-crown"></i> Super Administrator
                                        </span>
                                        <small class="text-muted d-block">Akses penuh terhadap sistem</small>
                                        @else
                                        <span class="badge badge-primary">
                                            <i class="fas fa-user"></i> User Biasa
                                        </span>
                                        <small class="text-muted d-block">Akses terbatas untuk user</small>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status Verifikasi Email</th>
                                    <td>
                                        @if($user->email_verified_at)
                                        <span class="badge badge-success">
                                            <i class="fas fa-check-circle"></i> Terverifikasi
                                        </span>
                                        <small class="text-muted d-block">
                                            Diverifikasi pada: {{ $user->email_verified_at->format('d/m/Y H:i') }}
                                        </small>
                                        @else
                                        <span class="badge badge-warning">
                                            <i class="fas fa-clock"></i> Belum Diverifikasi
                                        </span>
                                        <small class="text-muted d-block">Email belum diverifikasi</small>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Foto Profil</th>
                                    <td>
                                        @if($user->profile_photo)
                                        <span class="badge badge-success">
                                            <i class="fas fa-image"></i> Tersedia
                                        </span>
                                        @if($user->profile_photo_original)
                                        <small class="text-muted d-block">
                                            File asli: {{ $user->profile_photo_original }}
                                        </small>
                                        @endif
                                        @if($user->profile_photo_uploaded_at)
                                        <small class="text-muted d-block">
                                            Diupload: {{ $user->profile_photo_uploaded_at->format('d/m/Y H:i') }}
                                        </small>
                                        @endif
                                        @else
                                        <span class="badge badge-secondary">
                                            <i class="fas fa-user-circle"></i> Menggunakan Default
                                        </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tanggal Bergabung</th>
                                    <td>
                                        {{ $user->created_at->format('d F Y, H:i') }}
                                        <small class="text-muted d-block">
                                            ({{ $user->created_at->diffForHumans() }})
                                        </small>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Terakhir Diupdate</th>
                                    <td>
                                        {{ $user->updated_at->format('d F Y, H:i') }}
                                        <small class="text-muted d-block">
                                            ({{ $user->updated_at->diffForHumans() }})
                                        </small>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card --> <!-- User Statistics -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Statistik User</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info info-box-icon-small"><i class="fas fa-id-card"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Identitas</span>
                                        <span class="info-box-number">
                                            @if($user->identitas && $user->identitas->status_verifikasi == 'terverifikasi')
                                            <span class="badge badge-success">Lengkap</span>
                                            @else
                                            <span class="badge badge-warning">Belum Ada</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-success info-box-icon-small"><i class="fas fa-users"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Orangtua</span>
                                        <span class="info-box-number">
                                            @php
                                            $orangtuaComplete = false;
                                            if($user->orangtua && $user->orangtua->count() > 0) {
                                            // Check if at least one parent has essential data filled
                                            foreach($user->orangtua as $orangtua) {
                                            if($orangtua->nama_lengkap && $orangtua->nik && $orangtua->no_hp_1) {
                                            $orangtuaComplete = true;
                                            break;
                                            }
                                            }
                                            }
                                            @endphp
                                            @if($orangtuaComplete)
                                            <span class="badge badge-success">Lengkap</span>
                                            @else
                                            <span class="badge badge-warning">Belum Ada</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-warning info-box-icon-small"><i class="fas fa-file"></i></span>
                                    <div class="info-box-content"> <span class="info-box-text">Dokumen</span>
                                        <span class="info-box-number">
                                            @if($user->dokumen && $user->dokumen->status_verifikasi === 'approved')
                                            <span class="badge badge-success">Lengkap</span>
                                            @else
                                            <span class="badge badge-warning">Belum Ada</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-primary info-box-icon-small"><i class="fas fa-money-bill-wave"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Bayar</span>
                                        <span class="info-box-number">
                                            @php
                                            // Daftar jenis pembayaran yang wajib
                                            $requiredPaymentTypes = ['pendaftaran', 'spp_bulanan', 'seragam', 'kitab', 'kegiatan'];

                                            // Cek pembayaran user yang sudah disetujui
                                            $approvedPayments = $user->pembayaran ? $user->pembayaran->where('status_verifikasi', 'approved')->pluck('jenis_pembayaran')->toArray() : [];

                                            // Cek apakah semua jenis pembayaran wajib sudah ada dan disetujui
                                            $allPaymentsComplete = !empty($approvedPayments) && count(array_intersect($requiredPaymentTypes, $approvedPayments)) === count($requiredPaymentTypes);
                                            @endphp
                                            @if($allPaymentsComplete)
                                            <span class="badge badge-success">Lengkap</span>
                                            @else
                                            <span class="badge badge-warning">Kurang</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</section>
@endsection

@push('css')
<!-- Admin Custom Components -->
<link rel="stylesheet" href="{{ asset('assets/css/admin/components.css') }}">
@endpush

@push('scripts')
<script>
    // Add any custom JavaScript for user show page
    $(document).ready(function() {
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endpush