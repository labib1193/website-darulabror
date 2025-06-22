@extends('layouts.admin')

@section('title', 'Edit Identitas - ')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Identitas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.identitas.index') }}">Data Identitas</a></li>
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
                        <h3 class="card-title">Form Edit Identitas</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.identitas.index') }}" class="btn btn-secondary btn-sm">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <form action="{{ route('admin.identitas.update', $identitas->id) }}" method="POST">
                        @csrf
                        @method('PUT') <div class="card-body">
                            <div class="row">
                                <!-- Data Pribadi -->
                                <div class="col-md-6">
                                    <h5 class="text-primary mb-3"><i class="fas fa-id-card"></i> Data Pribadi</h5>

                                    <div class="form-group">
                                        <label for="nik">NIK <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                            id="nik" name="nik" value="{{ old('nik', $identitas->nik) }}" required>
                                        @error('nik')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="no_kk">No. KK</label>
                                        <input type="text" class="form-control @error('no_kk') is-invalid @enderror"
                                            id="no_kk" name="no_kk" value="{{ old('no_kk', $identitas->no_kk) }}">
                                        @error('no_kk')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="tempat_lahir">Tempat Lahir <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                            id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $identitas->tempat_lahir) }}" required>
                                        @error('tempat_lahir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $identitas->tanggal_lahir) }}" required>
                                        @error('tanggal_lahir')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="usia">Usia</label>
                                        <input type="number" class="form-control @error('usia') is-invalid @enderror"
                                            id="usia" name="usia" value="{{ old('usia', $identitas->usia) }}" min="1">
                                        @error('usia')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                                        <select class="form-control @error('jenis_kelamin') is-invalid @enderror"
                                            id="jenis_kelamin" name="jenis_kelamin" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki" {{ old('jenis_kelamin', $identitas->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('jenis_kelamin', $identitas->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="no_hp">No. HP <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                            id="no_hp" name="no_hp" value="{{ old('no_hp', $identitas->no_hp) }}" required>
                                        @error('no_hp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Data Alamat -->
                                <div class="col-md-6">
                                    <h5 class="text-primary mb-3"><i class="fas fa-home"></i> Data Alamat</h5>

                                    <div class="form-group">
                                        <label for="alamat_lengkap">Alamat Lengkap <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('alamat_lengkap') is-invalid @enderror"
                                            id="alamat_lengkap" name="alamat_lengkap" rows="3" required>{{ old('alamat_lengkap', $identitas->alamat_lengkap) }}</textarea>
                                        @error('alamat_lengkap')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="desa">Desa/Kelurahan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('desa') is-invalid @enderror"
                                            id="desa" name="desa" value="{{ old('desa', $identitas->desa) }}" required>
                                        @error('desa')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="kecamatan">Kecamatan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('kecamatan') is-invalid @enderror"
                                            id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $identitas->kecamatan) }}" required>
                                        @error('kecamatan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="kabupaten">Kabupaten/Kota <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('kabupaten') is-invalid @enderror"
                                            id="kabupaten" name="kabupaten" value="{{ old('kabupaten', $identitas->kabupaten) }}" required>
                                        @error('kabupaten')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="provinsi">Provinsi <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('provinsi') is-invalid @enderror"
                                            id="provinsi" name="provinsi" value="{{ old('provinsi', $identitas->provinsi) }}" required>
                                        @error('provinsi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="kode_pos">Kode Pos</label>
                                        <input type="text" class="form-control @error('kode_pos') is-invalid @enderror"
                                            id="kode_pos" name="kode_pos" value="{{ old('kode_pos', $identitas->kode_pos) }}">
                                        @error('kode_pos')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="pekerjaan">Pekerjaan</label>
                                        <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror"
                                            id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $identitas->pekerjaan) }}">
                                        @error('pekerjaan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Status Verifikasi -->
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <h5 class="text-primary mb-3"><i class="fas fa-check-circle"></i> Status Verifikasi</h5>
                                    <div class="form-group">
                                        <label for="status_verifikasi">Status Verifikasi</label>
                                        <select class="form-control @error('status_verifikasi') is-invalid @enderror"
                                            id="status_verifikasi" name="status_verifikasi">
                                            <option value="pending" {{ old('status_verifikasi', $identitas->status_verifikasi) == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="terverifikasi" {{ old('status_verifikasi', $identitas->status_verifikasi) == 'terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                                            <option value="ditolak" {{ old('status_verifikasi', $identitas->status_verifikasi) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                        @error('status_verifikasi')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Data
                            </button>
                            <a href="{{ route('admin.identitas.show', $identitas->id) }}" class="btn btn-info">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </a>
                            <a href="{{ route('admin.identitas.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection