@extends('layouts.admin')

@section('title', 'Detail Identitas')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Detail Identitas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.identitas.index') }}">Data Identitas</a></li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <!-- Alert Messages -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fas fa-times-circle"></i> {{ session('error') }}
        </div>
        @endif

        <div class="row">
            <!-- Detail Identitas -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-user"></i> Detail Identitas - {{ $identitas->user->name }}
                        </h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.identitas.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Data Pribadi -->
                            <div class="col-md-6">
                                <h5 class="text-primary"><i class="fas fa-id-card"></i> Data Pribadi</h5>
                                <table class="table table-sm">
                                    <tr>
                                        <th style="width: 40%">Nama Lengkap</th>
                                        <td>{{ $identitas->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $identitas->user->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>NIK</th>
                                        <td>{{ $identitas->nik ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>No. KK</th>
                                        <td>{{ $identitas->no_kk ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tempat Lahir</th>
                                        <td>{{ $identitas->tempat_lahir ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir</th>
                                        <td>{{ $identitas->tanggal_lahir ? $identitas->tanggal_lahir->format('d F Y') : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Usia</th>
                                        <td>{{ $identitas->usia ?? '-' }} tahun</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>{{ $identitas->jenis_kelamin ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>No. HP</th>
                                        <td>{{ $identitas->no_hp ?? '-' }}</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Data Keluarga & Alamat -->
                            <div class="col-md-6">
                                <h5 class="text-primary"><i class="fas fa-home"></i> Data Alamat</h5>
                                <table class="table table-sm">
                                    <tr>
                                        <th style="width: 40%">Alamat Lengkap</th>
                                        <td>{{ $identitas->alamat_lengkap ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Desa/Kelurahan</th>
                                        <td>{{ $identitas->desa ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kecamatan</th>
                                        <td>{{ $identitas->kecamatan ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kabupaten/Kota</th>
                                        <td>{{ $identitas->kabupaten ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Provinsi</th>
                                        <td>{{ $identitas->provinsi ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Pos</th>
                                        <td>{{ $identitas->kode_pos ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pekerjaan</th>
                                        <td>{{ $identitas->pekerjaan ?? '-' }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Data Orang Tua -->
                        @if($identitas->orangtua)
                        <div class="row mt-4">
                            <div class="col-12">
                                <h5 class="text-primary"><i class="fas fa-users"></i> Data Orang Tua</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="text-secondary">Data Ayah</h6>
                                        <table class="table table-sm">
                                            <tr>
                                                <th style="width: 40%">Nama Ayah</th>
                                                <td>{{ $identitas->orangtua->nama_ayah ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Pekerjaan Ayah</th>
                                                <td>{{ $identitas->orangtua->pekerjaan_ayah ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Penghasilan Ayah</th>
                                                <td>{{ $identitas->orangtua->penghasilan_ayah ?? '-' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="text-secondary">Data Ibu</h6>
                                        <table class="table table-sm">
                                            <tr>
                                                <th style="width: 40%">Nama Ibu</th>
                                                <td>{{ $identitas->orangtua->nama_ibu ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Pekerjaan Ibu</th>
                                                <td>{{ $identitas->orangtua->pekerjaan_ibu ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Penghasilan Ibu</th>
                                                <td>{{ $identitas->orangtua->penghasilan_ibu ?? '-' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Data Timestamp -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-clock"></i> Informasi Waktu
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted">
                                    <strong>Dibuat:</strong><br>
                                    {{ $identitas->created_at->format('d F Y, H:i') }}
                                </small>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted">
                                    <strong>Terakhir Diupdate:</strong><br>
                                    {{ $identitas->updated_at->format('d F Y, H:i') }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel Verifikasi -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title text-white">
                            <i class="fas fa-clipboard-check"></i> Status Verifikasi
                        </h3>
                    </div>
                    <div class="card-body">
                        <!-- Status Saat Ini -->
                        <div class="text-center mb-3">
                            <h4>Status Saat Ini:</h4>
                            @if($identitas->status_verifikasi == 'terverifikasi')
                            <span class="badge badge-success badge-lg">
                                <i class="fas fa-check-circle"></i> Terverifikasi
                            </span>
                            @elseif($identitas->status_verifikasi == 'pending')
                            <span class="badge badge-warning badge-lg">
                                <i class="fas fa-clock"></i> Pending
                            </span>
                            @elseif($identitas->status_verifikasi == 'ditolak')
                            <span class="badge badge-danger badge-lg">
                                <i class="fas fa-times-circle"></i> Ditolak
                            </span>
                            @else
                            <span class="badge badge-secondary badge-lg">
                                <i class="fas fa-question-circle"></i> Belum Diverifikasi
                            </span>
                            @endif
                        </div>

                        <!-- Info Verifikasi -->
                        @if($identitas->verified_at)
                        <div class="mb-3">
                            <small class="text-muted">
                                <strong>Diverifikasi pada:</strong><br>
                                {{ $identitas->verified_at->format('d F Y, H:i') }}
                            </small>
                            @if($identitas->verifiedBy)
                            <br>
                            <small class="text-muted">
                                <strong>Oleh:</strong> {{ $identitas->verifiedBy->name }}
                            </small>
                            @endif
                        </div>
                        @endif

                        <!-- Catatan Admin -->
                        @if($identitas->catatan_admin)
                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle"></i> Catatan Admin:</h6>
                            <p class="mb-0">{{ $identitas->catatan_admin }}</p>
                        </div>
                        @endif

                        <!-- Form Update Status dengan Catatan -->
                        <form action="{{ route('admin.identitas.updateStatus', $identitas->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="status_verifikasi">Ubah Status:</label>
                                <select name="status_verifikasi" id="status_verifikasi" class="form-control">
                                    <option value="pending" {{ $identitas->status_verifikasi == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="terverifikasi" {{ $identitas->status_verifikasi == 'terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                                    <option value="ditolak" {{ $identitas->status_verifikasi == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="catatan_admin">Catatan (opsional):</label>
                                <textarea name="catatan_admin" id="catatan_admin" class="form-control" rows="3" placeholder="Berikan catatan untuk user...">{{ $identitas->catatan_admin }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-save"></i> Update Status
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Panel Aksi -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-cogs"></i> Aksi Lainnya
                        </h3>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin.identitas.edit', $identitas->id) }}" class="btn btn-warning btn-block mb-2">
                            <i class="fas fa-edit"></i> Edit Data
                        </a>

                        <form action="{{ route('admin.identitas.destroy', $identitas->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <i class="fas fa-trash"></i> Hapus Data
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('css')
<style>
    .badge-lg {
        font-size: 1rem;
        padding: 0.5rem 1rem;
    }

    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
</style>
@endpush