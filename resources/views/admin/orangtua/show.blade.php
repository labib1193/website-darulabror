@extends('layouts.admin')

@section('title', 'Detail Data Orangtua - ')
@section('page-title', 'Detail Data Orangtua')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.orangtua.index') }}">Data Orangtua</a></li>
<li class="breadcrumb-item active">Detail Data</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detail Data Orangtua/Wali</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.orangtua.edit', $orangtua->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('admin.orangtua.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-primary mb-3"><i class="fas fa-user"></i> Informasi User</h5>
                        <table class="table table-borderless">
                            <tr>
                                <td width="150"><strong>Nama User:</strong></td>
                                <td>{{ $orangtua->user->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>{{ $orangtua->user->email }}</td>
                            </tr>
                            <tr>
                                <td><strong>Role:</strong></td>
                                <td><span class="badge badge-info">{{ ucfirst($orangtua->user->role) }}</span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-success mb-3"><i class="fas fa-info-circle"></i> Status & Hubungan</h5>
                        <table class="table table-borderless">
                            <tr>
                                <td width="150"><strong>Status:</strong></td>
                                <td><span class="badge badge-success">{{ $orangtua->status }}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Jenis Kelamin:</strong></td>
                                <td>{{ $orangtua->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <td><strong>Created:</strong></td>
                                <td>{{ $orangtua->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-secondary mb-3"><i class="fas fa-address-card"></i> Data Pribadi</h5>
                        <table class="table table-striped">
                            <tr>
                                <td width="150"><strong>No. KK:</strong></td>
                                <td>{{ $orangtua->no_kk }}</td>
                            </tr>
                            <tr>
                                <td><strong>NIK:</strong></td>
                                <td>{{ $orangtua->nik }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nama Lengkap:</strong></td>
                                <td>{{ $orangtua->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tempat Lahir:</strong></td>
                                <td>{{ $orangtua->tempat_lahir }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Lahir:</strong></td>
                                <td>{{ $orangtua->tanggal_lahir->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Usia:</strong></td>
                                <td>{{ $orangtua->tanggal_lahir->age }} tahun</td>
                            </tr>
                            <tr>
                                <td><strong>Pendidikan:</strong></td>
                                <td>{{ $orangtua->pendidikan_terakhir ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-secondary mb-3"><i class="fas fa-briefcase"></i> Data Pekerjaan & Kontak</h5>
                        <table class="table table-striped">
                            <tr>
                                <td width="150"><strong>Pekerjaan:</strong></td>
                                <td>{{ $orangtua->pekerjaan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Penghasilan:</strong></td>
                                <td>{{ $orangtua->penghasilan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>No. HP:</strong></td>
                                <td>
                                    <a href="tel:{{ $orangtua->no_hp_1 }}" class="text-success">
                                        <i class="fas fa-phone"></i> {{ $orangtua->no_hp_1 }}
                                    </a>
                                </td>
                            </tr>
                        </table>

                        <h5 class="text-secondary mb-3 mt-4"><i class="fas fa-map-marker-alt"></i> Data Alamat</h5>
                        <table class="table table-striped">
                            <tr>
                                <td width="150"><strong>Provinsi:</strong></td>
                                <td>{{ $orangtua->provinsi ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Kabupaten:</strong></td>
                                <td>{{ $orangtua->kabupaten ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Kecamatan:</strong></td>
                                <td>{{ $orangtua->kecamatan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Kode Pos:</strong></td>
                                <td>{{ $orangtua->kode_pos ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat Lengkap:</strong></td>
                                <td>{{ $orangtua->alamat_lengkap ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-6">
                        <small class="text-muted">
                            <i class="fas fa-calendar-plus"></i> Dibuat: {{ $orangtua->created_at->format('d/m/Y H:i') }}
                        </small>
                    </div>
                    <div class="col-md-6 text-right">
                        <small class="text-muted">
                            <i class="fas fa-calendar-edit"></i> Diupdate: {{ $orangtua->updated_at->format('d/m/Y H:i') }}
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection