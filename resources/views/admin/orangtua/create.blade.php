@extends('layouts.admin')

@section('title', 'Tambah Data Orangtua')
@section('page-title', 'Tambah Data Orangtua')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{ route('admin.orangtua.index') }}">Data Orangtua</a></li>
<li class="breadcrumb-item active">Tambah Data</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Tambah Data Orangtua/Wali</h3>
            </div>
            <form action="{{ route('admin.orangtua.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="user_id">User <span class="text-danger">*</span></label>
                        <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                            <option value="">Pilih User</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                            @endforeach
                        </select>
                        @error('user_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-lg-6">
                            <h6 class="text-secondary mb-3"><i class="fas fa-user"></i> Data Pribadi</h6>

                            <div class="form-group">
                                <label for="no_kk">No. KK <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('no_kk') is-invalid @enderror"
                                    id="no_kk" name="no_kk" value="{{ old('no_kk') }}" required>
                                @error('no_kk')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nik">NIK <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                    id="nik" name="nik" value="{{ old('nik') }}" required maxlength="16">
                                @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                    id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                                @error('nama_lengkap')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                <div class="d-flex gap-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_laki" value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="jk_laki">Laki-laki</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk_perempuan" value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }} required>
                                        <label class="form-check-label" for="jk_perempuan">Perempuan</label>
                                    </div>
                                </div>
                                @error('jenis_kelamin')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tempat_lahir">Tempat Lahir <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                            id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                                        @error('tempat_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                                        @error('tanggal_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
                                <input type="text" class="form-control @error('pendidikan_terakhir') is-invalid @enderror"
                                    id="pendidikan_terakhir" name="pendidikan_terakhir" value="{{ old('pendidikan_terakhir') }}">
                                @error('pendidikan_terakhir')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Status <span class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Ayah" {{ old('status') == 'Ayah' ? 'selected' : '' }}>Ayah</option>
                                    <option value="Ibu" {{ old('status') == 'Ibu' ? 'selected' : '' }}>Ibu</option>
                                    <option value="Kakak" {{ old('status') == 'Kakak' ? 'selected' : '' }}>Kakak</option>
                                    <option value="Adik" {{ old('status') == 'Adik' ? 'selected' : '' }}>Adik</option>
                                    <option value="Paman" {{ old('status') == 'Paman' ? 'selected' : '' }}>Paman</option>
                                    <option value="Bibi" {{ old('status') == 'Bibi' ? 'selected' : '' }}>Bibi</option>
                                    <option value="Kakek" {{ old('status') == 'Kakek' ? 'selected' : '' }}>Kakek</option>
                                    <option value="Nenek" {{ old('status') == 'Nenek' ? 'selected' : '' }}>Nenek</option>
                                    <option value="Sepupu" {{ old('status') == 'Sepupu' ? 'selected' : '' }}>Sepupu</option>
                                    <option value="Wali" {{ old('status') == 'Wali' ? 'selected' : '' }}>Wali</option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-lg-6">
                            <h6 class="text-secondary mb-3"><i class="fas fa-briefcase"></i> Data Pekerjaan & Kontak</h6>

                            <div class="form-group">
                                <label for="pekerjaan">Pekerjaan</label>
                                <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror"
                                    id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}">
                                @error('pekerjaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="penghasilan">Penghasilan</label>
                                <select class="form-control @error('penghasilan') is-invalid @enderror" id="penghasilan" name="penghasilan">
                                    <option value="">Pilih Range Penghasilan</option>
                                    <option value="< 1 juta" {{ old('penghasilan') == '< 1 juta' ? 'selected' : '' }}>
                                        < 1 juta</option>
                                    <option value="1-3 juta" {{ old('penghasilan') == '1-3 juta' ? 'selected' : '' }}>1-3 juta</option>
                                    <option value="3-5 juta" {{ old('penghasilan') == '3-5 juta' ? 'selected' : '' }}>3-5 juta</option>
                                    <option value="5-10 juta" {{ old('penghasilan') == '5-10 juta' ? 'selected' : '' }}>5-10 juta</option>
                                    <option value="> 10 juta" {{ old('penghasilan') == '> 10 juta' ? 'selected' : '' }}>> 10 juta</option>
                                </select>
                                @error('penghasilan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="no_hp_1">No. HP <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('no_hp_1') is-invalid @enderror"
                                    id="no_hp_1" name="no_hp_1" value="{{ old('no_hp_1') }}" required>
                                @error('no_hp_1')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <h6 class="text-secondary mb-3"><i class="fas fa-map-marker-alt"></i> Data Alamat</h6>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="provinsi">Provinsi</label>
                                        <input type="text" class="form-control @error('provinsi') is-invalid @enderror"
                                            id="provinsi" name="provinsi" value="{{ old('provinsi') }}">
                                        @error('provinsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kabupaten">Kabupaten</label>
                                        <input type="text" class="form-control @error('kabupaten') is-invalid @enderror"
                                            id="kabupaten" name="kabupaten" value="{{ old('kabupaten') }}">
                                        @error('kabupaten')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kecamatan">Kecamatan</label>
                                        <input type="text" class="form-control @error('kecamatan') is-invalid @enderror"
                                            id="kecamatan" name="kecamatan" value="{{ old('kecamatan') }}">
                                        @error('kecamatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kode_pos">Kode Pos</label>
                                        <input type="text" class="form-control @error('kode_pos') is-invalid @enderror"
                                            id="kode_pos" name="kode_pos" value="{{ old('kode_pos') }}" maxlength="5">
                                        @error('kode_pos')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat_lengkap">Alamat Lengkap</label>
                                <textarea class="form-control @error('alamat_lengkap') is-invalid @enderror"
                                    id="alamat_lengkap" name="alamat_lengkap" rows="3">{{ old('alamat_lengkap') }}</textarea>
                                @error('alamat_lengkap')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('admin.orangtua.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection